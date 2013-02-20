/*
 * ----------------------------- JSTORAGE -------------------------------------
 * Simple local storage wrapper to save data on the browser side, supporting
 * all major browsers - IE6+, Firefox2+, Safari4+, Chrome4+ and Opera 10.5+
 *
 * Copyright (c) 2010 - 2012 Andris Reinman, andris.reinman@gmail.com
 * Project homepage: www.jstorage.info
 *
 * Licensed under MIT-style license:
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

 (function(){
    var
        /* jStorage version */
        JSTORAGE_VERSION = "0.3.2",

        /* detect a dollar object or create one if not found */
        $ = window.jQuery || window.$ || (window.$ = {}),

        /* check for a JSON handling support */
        JSON = {
            parse:
                window.JSON && (window.JSON.parse || window.JSON.decode) ||
                String.prototype.evalJSON && function(str){return String(str).evalJSON();} ||
                $.parseJSON ||
                $.evalJSON,
            stringify:
                Object.toJSON ||
                window.JSON && (window.JSON.stringify || window.JSON.encode) ||
                $.toJSON
        };

    // Break if no JSON support was found
    if(!JSON.parse || !JSON.stringify){
        throw new Error("No JSON support found, include //cdnjs.cloudflare.com/ajax/libs/json2/20110223/json2.js to page");
    }

    var
        /* This is the object, that holds the cached values */
        _storage = {__jstorage_meta:{CRC32:{}}},

        /* Actual browser storage (localStorage or globalStorage['domain']) */
        _storage_service = {jStorage:"{}"},

        /* DOM element for older IE versions, holds userData behavior */
        _storage_elm = null,

        /* How much space does the storage take */
        _storage_size = 0,

        /* which backend is currently used */
        _backend = false,

        /* onchange observers */
        _observers = {},

        /* timeout to wait after onchange event */
        _observer_timeout = false,

        /* last update time */
        _observer_update = 0,

        /* pubsub observers */
        _pubsub_observers = {},

        /* skip published items older than current timestamp */
        _pubsub_last = +new Date(),

        /* Next check for TTL */
        _ttl_timeout,

        /**
         * XML encoding and decoding as XML nodes can't be JSON'ized
         * XML nodes are encoded and decoded if the node is the value to be saved
         * but not if it's as a property of another object
         * Eg. -
         *   $.jStorage.set("key", xmlNode);        // IS OK
         *   $.jStorage.set("key", {xml: xmlNode}); // NOT OK
         */
        _XMLService = {

            /**
             * Validates a XML node to be XML
             * based on jQuery.isXML function
             */
            isXML: function(elm){
                var documentElement = (elm ? elm.ownerDocument || elm : 0).documentElement;
                return documentElement ? documentElement.nodeName !== "HTML" : false;
            },

            /**
             * Encodes a XML node to string
             * based on http://www.mercurytide.co.uk/news/article/issues-when-working-ajax/
             */
            encode: function(xmlNode) {
                if(!this.isXML(xmlNode)){
                    return false;
                }
                try{ // Mozilla, Webkit, Opera
                    return new XMLSerializer().serializeToString(xmlNode);
                }catch(E1) {
                    try {  // IE
                        return xmlNode.xml;
                    }catch(E2){}
                }
                return false;
            },

            /**
             * Decodes a XML node from string
             * loosely based on http://outwestmedia.com/jquery-plugins/xmldom/
             */
            decode: function(xmlString){
                var dom_parser = ("DOMParser" in window && (new DOMParser()).parseFromString) ||
                        (window.ActiveXObject && function(_xmlString) {
                    var xml_doc = new ActiveXObject('Microsoft.XMLDOM');
                    xml_doc.async = 'false';
                    xml_doc.loadXML(_xmlString);
                    return xml_doc;
                }),
                resultXML;
                if(!dom_parser){
                    return false;
                }
                resultXML = dom_parser.call("DOMParser" in window && (new DOMParser()) || window, xmlString, 'text/xml');
                return this.isXML(resultXML)?resultXML:false;
            }
        },

        _localStoragePolyfillSetKey = function(){};


    ////////////////////////// PRIVATE METHODS ////////////////////////

    /**
     * Initialization function. Detects if the browser supports DOM Storage
     * or userData behavior and behaves accordingly.
     */
    function _init(){
        /* Check if browser supports localStorage */
        var localStorageReallyWorks = false;
        if("localStorage" in window){
            try {
                window.localStorage.setItem('_tmptest', 'tmpval');
                localStorageReallyWorks = true;
                window.localStorage.removeItem('_tmptest');
            } catch(BogusQuotaExceededErrorOnIos5) {
                // Thanks be to iOS5 Private Browsing mode which throws
                // QUOTA_EXCEEDED_ERRROR DOM Exception 22.
            }
        }

        if(localStorageReallyWorks){
            try {
                if(window.localStorage) {
                    _storage_service = window.localStorage;
                    _backend = "localStorage";
                    _observer_update = _storage_service.jStorage_update;
                }
            } catch(E3) {/* Firefox fails when touching localStorage and cookies are disabled */}
        }
        /* Check if browser supports globalStorage */
        else if("globalStorage" in window){
            try {
                if(window.globalStorage) {
                    _storage_service = window.globalStorage[window.location.hostname];
                    _backend = "globalStorage";
                    _observer_update = _storage_service.jStorage_update;
                }
            } catch(E4) {/* Firefox fails when touching localStorage and cookies are disabled */}
        }
        /* Check if browser supports userData behavior */
        else {
            _storage_elm = document.createElement('link');
            if(_storage_elm.addBehavior){

                /* Use a DOM element to act as userData storage */
                _storage_elm.style.behavior = 'url(#default#userData)';

                /* userData element needs to be inserted into the DOM! */
                document.getElementsByTagName('head')[0].appendChild(_storage_elm);

                try{
                    _storage_elm.load("jStorage");
                }catch(E){
                    // try to reset cache
                    _storage_elm.setAttribute("jStorage", "{}");
                    _storage_elm.save("jStorage");
                    _storage_elm.load("jStorage");
                }

                var data = "{}";
                try{
                    data = _storage_elm.getAttribute("jStorage");
                }catch(E5){}

                try{
                    _observer_update = _storage_elm.getAttribute("jStorage_update");
                }catch(E6){}

                _storage_service.jStorage = data;
                _backend = "userDataBehavior";
            }else{
                _storage_elm = null;
                return;
            }
        }

        // Load data from storage
        _load_storage();

        // remove dead keys
        _handleTTL();

        // create localStorage and sessionStorage polyfills if needed
        _createPolyfillStorage("local");
        _createPolyfillStorage("session");

        // start listening for changes
        _setupObserver();

        // initialize publish-subscribe service
        _handlePubSub();

        // handle cached navigation
        if("addEventListener" in window){
            window.addEventListener("pageshow", function(event){
                if(event.persisted){
                    _storageObserver();
                }
            }, false);
        }
    }

    /**
     * Create a polyfill for localStorage (type="local") or sessionStorage (type="session")
     *
     * @param {String} type Either "local" or "session"
     * @param {Boolean} forceCreate If set to true, recreate the polyfill (needed with flush)
     */
    function _createPolyfillStorage(type, forceCreate){
        var _skipSave = false,
            _length = 0,
            i,
            storage,
            storage_source = {};

            var rand = Math.random();

        if(!forceCreate && typeof window[type+"Storage"] != "undefined"){
            return;
        }

        // Use globalStorage for localStorage if available
        if(type == "local" && window.globalStorage){
            localStorage = window.globalStorage[window.location.hostname];
            return;
        }

        // only IE6/7 from this point on
        if(_backend != "userDataBehavior"){
            return;
        }

        // Remove existing storage element if available
        if(forceCreate && window[type+"Storage"] && window[type+"Storage"].parentNode){
            window[type+"Storage"].parentNode.removeChild(window[type+"Storage"]);
        }

        storage = document.createElement("button");
        document.getElementsByTagName('head')[0].appendChild(storage);

        if(type == "local"){
            storage_source = _storage;
        }else if(type == "session"){
            _sessionStoragePolyfillUpdate();
        }

        for(i in storage_source){

            if(storage_source.hasOwnProperty(i) && i != "__jstorage_meta" && i != "length" && typeof storage_source[i] != "undefined"){
                if(!(i in storage)){
                    _length++;
                }
                storage[i] = storage_source[i];
            }
        }

        // Polyfill API

        /**
         * Indicates how many keys are stored in the storage
         */
        storage.length = _length;

        /**
         * Returns the key of the nth stored value
         *
         * @param {Number} n Index position
         * @return {String} Key name of the nth stored value
         */
        storage.key = function(n){
            var count = 0, i;
            _sessionStoragePolyfillUpdate();
            for(i in storage_source){
                if(storage_source.hasOwnProperty(i) && i != "__jstorage_meta" && i!="length" && typeof storage_source[i] != "undefined"){
                    if(count == n){
                        return i;
                    }
                    count++;
                }
            }
        }

        /**
         * Returns the current value associated with the given key
         *
         * @param {String} key key name
         * @return {Mixed} Stored value
         */
        storage.getItem = function(key){
            _sessionStoragePolyfillUpdate();
            if(type == "session"){
                return storage_source[key];
            }
            return $.jStorage.get(key);
        }

        /**
         * Sets or updates value for a give key
         *
         * @param {String} key Key name to be updated
         * @param {String} value String value to be stored
         */
        storage.setItem = function(key, value){
            if(typeof value == "undefined"){
                return;
            }
            storage[key] = (value || "").toString();
        }

        /**
         * Removes key from the storage
         *
         * @param {String} key Key name to be removed
         */
        storage.removeItem = function(key){
            if(type == "local"){
                return $.jStorage.deleteKey(key);
            }

            storage[key] = undefined;

            _skipSave = true;
            if(key in storage){
                storage.removeAttribute(key);
            }
            _skipSave = false;
        }

        /**
         * Clear storage
         */
        storage.clear = function(){
            if(type == "session"){
                window.name = "";
                _createPolyfillStorage("session", true);
                return;
            }
            $.jStorage.flush();
        }

        if(type == "local"){

            _localStoragePolyfillSetKey = function(key, value){
                if(key == "length"){
                    return;
                }
                _skipSave = true;
                if(typeof value == "undefined"){
                    if(key in storage){
                        _length--;
                        storage.removeAttribute(key);
                    }
                }else{
                    if(!(key in storage)){
                        _length++;
                    }
                    storage[key] = (value || "").toString();
                }
                storage.length = _length;
                _skipSave = false;
            }
        }

        function _sessionStoragePolyfillUpdate(){
                if(type != "session"){
                    return;
                }
                try{
                    storage_source = JSON.parse(window.name || "{}");
                }catch(E){
                    storage_source = {};
                }
            }

        function _sessionStoragePolyfillSave(){
            if(type != "session"){
                return;
            }
            window.name = JSON.stringify(storage_source);
        };

        storage.attachEvent("onpropertychange", function(e){
            if(e.propertyName == "length"){
                return;
            }

            if(_skipSave || e.propertyName == "length"){
                return;
            }

            if(type == "local"){
                if(!(e.propertyName in storage_source) && typeof storage[e.propertyName] != "undefined"){
                    _length ++;
                }
            }else if(type == "session"){
                _sessionStoragePolyfillUpdate();
                if(typeof storage[e.propertyName] != "undefined" && !(e.propertyName in storage_source)){
                    storage_source[e.propertyName] = storage[e.propertyName];
                    _length++;
                }else if(typeof storage[e.propertyName] == "undefined" && e.propertyName in storage_source){
                    delete storage_source[e.propertyName];
                    _length--;
                }else{
                    storage_source[e.propertyName] = storage[e.propertyName];
                }

                _sessionStoragePolyfillSave();
                storage.length = _length;
                return;
            }

            $.jStorage.set(e.propertyName, storage[e.propertyName]);
            storage.length = _length;
        });

        window[type+"Storage"] = storage;
    }

    /**
     * Reload data from storage when needed
     */
    function _reloadData(){
        var data = "{}";

        if(_backend == "userDataBehavior"){
            _storage_elm.load("jStorage");

            try{
                data = _storage_elm.getAttribute("jStorage");
            }catch(E5){}

            try{
                _observer_update = _storage_elm.getAttribute("jStorage_update");
            }catch(E6){}

            _storage_service.jStorage = data;
        }

        _load_storage();

        // remove dead keys
        _handleTTL();

        _handlePubSub();
    }

    /**
     * Sets up a storage change observer
     */
    function _setupObserver(){
        if(_backend == "localStorage" || _backend == "globalStorage"){
            if("addEventListener" in window){
                window.addEventListener("storage", _storageObserver, false);
            }else{
                document.attachEvent("onstorage", _storageObserver);
            }
        }else if(_backend == "userDataBehavior"){
            setInterval(_storageObserver, 1000);
        }
    }

    /**
     * Fired on any kind of data change, needs to check if anything has
     * really been changed
     */
    function _storageObserver(){
        var updateTime;
        // cumulate change notifications with timeout
        clearTimeout(_observer_timeout);
        _observer_timeout = setTimeout(function(){

            if(_backend == "localStorage" || _backend == "globalStorage"){
                updateTime = _storage_service.jStorage_update;
            }else if(_backend == "userDataBehavior"){
                _storage_elm.load("jStorage");
                try{
                    updateTime = _storage_elm.getAttribute("jStorage_update");
                }catch(E5){}
            }

            if(updateTime && updateTime != _observer_update){
                _observer_update = updateTime;
                _checkUpdatedKeys();
            }

        }, 25);
    }

    /**
     * Reloads the data and checks if any keys are changed
     */
    function _checkUpdatedKeys(){
        var oldCrc32List = JSON.parse(JSON.stringify(_storage.__jstorage_meta.CRC32)),
            newCrc32List;

        _reloadData();
        newCrc32List = JSON.parse(JSON.stringify(_storage.__jstorage_meta.CRC32));

        var key,
            updated = [],
            removed = [];

        for(key in oldCrc32List){
            if(oldCrc32List.hasOwnProperty(key)){
                if(!newCrc32List[key]){
                    removed.push(key);
                    continue;
                }
                if(oldCrc32List[key] != newCrc32List[key] && String(oldCrc32List[key]).substr(0,2) == "2."){
                    updated.push(key);
                }
            }
        }

        for(key in newCrc32List){
            if(newCrc32List.hasOwnProperty(key)){
                if(!oldCrc32List[key]){
                    updated.push(key);
                }
            }
        }

        _fireObservers(updated, "updated");
        _fireObservers(removed, "deleted");
    }

    /**
     * Fires observers for updated keys
     *
     * @param {Array|String} keys Array of key names or a key
     * @param {String} action What happened with the value (updated, deleted, flushed)
     */
    function _fireObservers(keys, action){
        keys = [].concat(keys || []);
        if(action == "flushed"){
            keys = [];
            for(var key in _observers){
                if(_observers.hasOwnProperty(key)){
                    keys.push(key);
                }
            }
            action = "deleted";
        }
        for(var i=0, len = keys.length; i<len; i++){
            if(_observers[keys[i]]){
                for(var j=0, jlen = _observers[keys[i]].length; j<jlen; j++){
                    _observers[keys[i]][j](keys[i], action);
                }
            }
        }
    }

    /**
     * Publishes key change to listeners
     */
    function _publishChange(){
        var updateTime = (+new Date()).toString();

        if(_backend == "localStorage" || _backend == "globalStorage"){
            _storage_service.jStorage_update = updateTime;
        }else if(_backend == "userDataBehavior"){
            _storage_elm.setAttribute("jStorage_update", updateTime);
            _storage_elm.save("jStorage");
        }

        _storageObserver();
    }

    /**
     * Loads the data from the storage based on the supported mechanism
     */
    function _load_storage(){
        /* if jStorage string is retrieved, then decode it */
        if(_storage_service.jStorage){
            try{
                _storage = JSON.parse(String(_storage_service.jStorage));
            }catch(E6){_storage_service.jStorage = "{}";}
        }else{
            _storage_service.jStorage = "{}";
        }
        _storage_size = _storage_service.jStorage?String(_storage_service.jStorage).length:0;

        if(!_storage.__jstorage_meta){
            _storage.__jstorage_meta = {};
        }
        if(!_storage.__jstorage_meta.CRC32){
            _storage.__jstorage_meta.CRC32 = {};
        }
    }

    /**
     * This functions provides the "save" mechanism to store the jStorage object
     */
    function _save(){
        _dropOldEvents(); // remove expired events
        try{
            _storage_service.jStorage = JSON.stringify(_storage);
            // If userData is used as the storage engine, additional
            if(_storage_elm) {
                _storage_elm.setAttribute("jStorage",_storage_service.jStorage);
                _storage_elm.save("jStorage");
            }
            _storage_size = _storage_service.jStorage?String(_storage_service.jStorage).length:0;
        }catch(E7){/* probably cache is full, nothing is saved this way*/}
    }

    /**
     * Function checks if a key is set and is string or numberic
     *
     * @param {String} key Key name
     */
    function _checkKey(key){
        if(!key || (typeof key != "string" && typeof key != "number")){
            throw new TypeError('Key name must be string or numeric');
        }
        if(key == "__jstorage_meta"){
            throw new TypeError('Reserved key name');
        }
        return true;
    }

    /**
     * Removes expired keys
     */
    function _handleTTL(){
        var curtime, i, TTL, CRC32, nextExpire = Infinity, changed = false, deleted = [];

        clearTimeout(_ttl_timeout);

        if(!_storage.__jstorage_meta || typeof _storage.__jstorage_meta.TTL != "object"){
            // nothing to do here
            return;
        }

        curtime = +new Date();
        TTL = _storage.__jstorage_meta.TTL;

        CRC32 = _storage.__jstorage_meta.CRC32;
        for(i in TTL){
            if(TTL.hasOwnProperty(i)){
                if(TTL[i] <= curtime){
                    delete TTL[i];
                    delete CRC32[i];
                    delete _storage[i];
                    changed = true;
                    deleted.push(i);
                }else if(TTL[i] < nextExpire){
                    nextExpire = TTL[i];
                }
            }
        }

        // set next check
        if(nextExpire != Infinity){
            _ttl_timeout = setTimeout(_handleTTL, nextExpire - curtime);
        }

        // save changes
        if(changed){
            _save();
            _publishChange();
            _fireObservers(deleted, "deleted");
        }
    }

    /**
     * Checks if there's any events on hold to be fired to listeners
     */
    function _handlePubSub(){
        if(!_storage.__jstorage_meta.PubSub){
            return;
        }
        var pubelm,
            _pubsubCurrent = _pubsub_last;

        for(var i=len=_storage.__jstorage_meta.PubSub.length-1; i>=0; i--){
            pubelm = _storage.__jstorage_meta.PubSub[i];
            if(pubelm[0] > _pubsub_last){
                _pubsubCurrent = pubelm[0];
                _fireSubscribers(pubelm[1], pubelm[2]);
            }
        }

        _pubsub_last = _pubsubCurrent;
    }

    /**
     * Fires all subscriber listeners for a pubsub channel
     *
     * @param {String} channel Channel name
     * @param {Mixed} payload Payload data to deliver
     */
    function _fireSubscribers(channel, payload){
        if(_pubsub_observers[channel]){
            for(var i=0, len = _pubsub_observers[channel].length; i<len; i++){
                // send immutable data that can't be modified by listeners
                _pubsub_observers[channel][i](channel, JSON.parse(JSON.stringify(payload)));
            }
        }
    }

    /**
     * Remove old events from the publish stream (at least 2sec old)
     */
    function _dropOldEvents(){
        if(!_storage.__jstorage_meta.PubSub){
            return;
        }

        var retire = +new Date() - 2000;

        for(var i=0, len = _storage.__jstorage_meta.PubSub.length; i<len; i++){
            if(_storage.__jstorage_meta.PubSub[i][0] <= retire){
                // deleteCount is needed for IE6
                _storage.__jstorage_meta.PubSub.splice(i, _storage.__jstorage_meta.PubSub.length - i);
                break;
            }
        }

        if(!_storage.__jstorage_meta.PubSub.length){
            delete _storage.__jstorage_meta.PubSub;
        }

    }

    /**
     * Publish payload to a channel
     *
     * @param {String} channel Channel name
     * @param {Mixed} payload Payload to send to the subscribers
     */
    function _publish(channel, payload){
        if(!_storage.__jstorage_meta){
            _storage.__jstorage_meta = {};
        }
        if(!_storage.__jstorage_meta.PubSub){
            _storage.__jstorage_meta.PubSub = [];
        }

        _storage.__jstorage_meta.PubSub.unshift([+new Date, channel, payload]);

        _save();
        _publishChange();
    }


    /**
     * JS Implementation of MurmurHash2
     *
     *  SOURCE: https://github.com/garycourt/murmurhash-js (MIT licensed)
     *
     * @author <a href="mailto:gary.court@gmail.com">Gary Court</a>
     * @see http://github.com/garycourt/murmurhash-js
     * @author <a href="mailto:aappleby@gmail.com">Austin Appleby</a>
     * @see http://sites.google.com/site/murmurhash/
     *
     * @param {string} str ASCII only
     * @param {number} seed Positive integer only
     * @return {number} 32-bit positive integer hash
     */

    function murmurhash2_32_gc(str, seed) {
        var
            l = str.length,
            h = seed ^ l,
            i = 0,
            k;

        while (l >= 4) {
            k =
                ((str.charCodeAt(i) & 0xff)) |
                ((str.charCodeAt(++i) & 0xff) << 8) |
                ((str.charCodeAt(++i) & 0xff) << 16) |
                ((str.charCodeAt(++i) & 0xff) << 24);

            k = (((k & 0xffff) * 0x5bd1e995) + ((((k >>> 16) * 0x5bd1e995) & 0xffff) << 16));
            k ^= k >>> 24;
            k = (((k & 0xffff) * 0x5bd1e995) + ((((k >>> 16) * 0x5bd1e995) & 0xffff) << 16));

            h = (((h & 0xffff) * 0x5bd1e995) + ((((h >>> 16) * 0x5bd1e995) & 0xffff) << 16)) ^ k;

            l -= 4;
            ++i;
        }

        switch (l) {
            case 3: h ^= (str.charCodeAt(i + 2) & 0xff) << 16;
            case 2: h ^= (str.charCodeAt(i + 1) & 0xff) << 8;
            case 1: h ^= (str.charCodeAt(i) & 0xff);
                h = (((h & 0xffff) * 0x5bd1e995) + ((((h >>> 16) * 0x5bd1e995) & 0xffff) << 16));
        }

        h ^= h >>> 13;
        h = (((h & 0xffff) * 0x5bd1e995) + ((((h >>> 16) * 0x5bd1e995) & 0xffff) << 16));
        h ^= h >>> 15;

        return h >>> 0;
    }

    ////////////////////////// PUBLIC INTERFACE /////////////////////////

    $.jStorage = {
        /* Version number */
        version: JSTORAGE_VERSION,

        /**
         * Sets a key's value.
         *
         * @param {String} key Key to set. If this value is not set or not
         *              a string an exception is raised.
         * @param {Mixed} value Value to set. This can be any value that is JSON
         *              compatible (Numbers, Strings, Objects etc.).
         * @param {Object} [options] - possible options to use
         * @param {Number} [options.TTL] - optional TTL value
         * @return {Mixed} the used value
         */
        set: function(key, value, options){
            _checkKey(key);

            options = options || {};

            // undefined values are deleted automatically
            if(typeof value == "undefined"){
                this.deleteKey(key);
                return value;
            }

            if(_XMLService.isXML(value)){
                value = {_is_xml:true,xml:_XMLService.encode(value)};
            }else if(typeof value == "function"){
                return undefined; // functions can't be saved!
            }else if(value && typeof value == "object"){
                // clone the object before saving to _storage tree
                value = JSON.parse(JSON.stringify(value));
            }

            _storage[key] = value;

            _storage.__jstorage_meta.CRC32[key] = "2."+murmurhash2_32_gc(JSON.stringify(value));

            this.setTTL(key, options.TTL || 0); // also handles saving and _publishChange

            _localStoragePolyfillSetKey(key, value);

            _fireObservers(key, "updated");
            return value;
        },

        /**
         * Looks up a key in cache
         *
         * @param {String} key - Key to look up.
         * @param {mixed} def - Default value to return, if key didn't exist.
         * @return {Mixed} the key value, default value or null
         */
        get: function(key, def){
            _checkKey(key);
            if(key in _storage){
                if(_storage[key] && typeof _storage[key] == "object" && _storage[key]._is_xml) {
                    return _XMLService.decode(_storage[key].xml);
                }else{
                    return _storage[key];
                }
            }
            return typeof(def) == 'undefined' ? null : def;
        },

        /**
         * Deletes a key from cache.
         *
         * @param {String} key - Key to delete.
         * @return {Boolean} true if key existed or false if it didn't
         */
        deleteKey: function(key){
            _checkKey(key);
            if(key in _storage){
                delete _storage[key];
                // remove from TTL list
                if(typeof _storage.__jstorage_meta.TTL == "object" &&
                  key in _storage.__jstorage_meta.TTL){
                    delete _storage.__jstorage_meta.TTL[key];
                }

                delete _storage.__jstorage_meta.CRC32[key];
                _localStoragePolyfillSetKey(key, undefined);

                _save();
                _publishChange();
                _fireObservers(key, "deleted");
                return true;
            }
            return false;
        },

        /**
         * Sets a TTL for a key, or remove it if ttl value is 0 or below
         *
         * @param {String} key - key to set the TTL for
         * @param {Number} ttl - TTL timeout in milliseconds
         * @return {Boolean} true if key existed or false if it didn't
         */
        setTTL: function(key, ttl){
            var curtime = +new Date();
            _checkKey(key);
            ttl = Number(ttl) || 0;
            if(key in _storage){

                if(!_storage.__jstorage_meta.TTL){
                    _storage.__jstorage_meta.TTL = {};
                }

                // Set TTL value for the key
                if(ttl>0){
                    _storage.__jstorage_meta.TTL[key] = curtime + ttl;
                }else{
                    delete _storage.__jstorage_meta.TTL[key];
                }

                _save();

                _handleTTL();

                _publishChange();
                return true;
            }
            return false;
        },

        /**
         * Gets remaining TTL (in milliseconds) for a key or 0 when no TTL has been set
         *
         * @param {String} key Key to check
         * @return {Number} Remaining TTL in milliseconds
         */
        getTTL: function(key){
            var curtime = +new Date(), ttl;
            _checkKey(key);
            if(key in _storage && _storage.__jstorage_meta.TTL && _storage.__jstorage_meta.TTL[key]){
                ttl = _storage.__jstorage_meta.TTL[key] - curtime;
                return ttl || 0;
            }
            return 0;
        },

        /**
         * Deletes everything in cache.
         *
         * @return {Boolean} Always true
         */
        flush: function(){
            _storage = {__jstorage_meta:{CRC32:{}}};
            _createPolyfillStorage("local", true);
            _save();
            _publishChange();
            _fireObservers(null, "flushed");
            return true;
        },

        /**
         * Returns a read-only copy of _storage
         *
         * @return {Object} Read-only copy of _storage
        */
        storageObj: function(){
            function F() {}
            F.prototype = _storage;
            return new F();
        },

        /**
         * Returns an index of all used keys as an array
         * ['key1', 'key2',..'keyN']
         *
         * @return {Array} Used keys
        */
        index: function(){
            var index = [], i;
            for(i in _storage){
                if(_storage.hasOwnProperty(i) && i != "__jstorage_meta"){
                    index.push(i);
                }
            }
            return index;
        },

        /**
         * How much space in bytes does the storage take?
         *
         * @return {Number} Storage size in chars (not the same as in bytes,
         *                  since some chars may take several bytes)
         */
        storageSize: function(){
            return _storage_size;
        },

        /**
         * Which backend is currently in use?
         *
         * @return {String} Backend name
         */
        currentBackend: function(){
            return _backend;
        },

        /**
         * Test if storage is available
         *
         * @return {Boolean} True if storage can be used
         */
        storageAvailable: function(){
            return !!_backend;
        },

        /**
         * Register change listeners
         *
         * @param {String} key Key name
         * @param {Function} callback Function to run when the key changes
         */
        listenKeyChange: function(key, callback){
            _checkKey(key);
            if(!_observers[key]){
                _observers[key] = [];
            }
            _observers[key].push(callback);
        },

        /**
         * Remove change listeners
         *
         * @param {String} key Key name to unregister listeners against
         * @param {Function} [callback] If set, unregister the callback, if not - unregister all
         */
        stopListening: function(key, callback){
            _checkKey(key);

            if(!_observers[key]){
                return;
            }

            if(!callback){
                delete _observers[key];
                return;
            }

            for(var i = _observers[key].length - 1; i>=0; i--){
                if(_observers[key][i] == callback){
                    _observers[key].splice(i,1);
                }
            }
        },

        /**
         * Subscribe to a Publish/Subscribe event stream
         *
         * @param {String} channel Channel name
         * @param {Function} callback Function to run when the something is published to the channel
         */
        subscribe: function(channel, callback){
            channel = (channel || "").toString();
            if(!channel){
                throw new TypeError('Channel not defined');
            }
            if(!_pubsub_observers[channel]){
                _pubsub_observers[channel] = [];
            }
            _pubsub_observers[channel].push(callback);
        },

        /**
         * Publish data to an event stream
         *
         * @param {String} channel Channel name
         * @param {Mixed} payload Payload to deliver
         */
        publish: function(channel, payload){
            channel = (channel || "").toString();
            if(!channel){
                throw new TypeError('Channel not defined');
            }

            _publish(channel, payload);
        },

        /**
         * Reloads the data from browser storage
         */
        reInit: function(){
            _reloadData();
        }
    };

    // Initialize jStorage
    _init();

})();
/**
 * BackendRowTarget connects row to an operation
 * @author David Molineus <http://netzmacht.de>
 */
function BackendImprovedRowTarget()
{
	var self = this;
	
	/**
	 * prevent that operation themselve propagate the event to the row
	 * 
	 * @param string target
	 */
	self.stopPropagation = function(target)
	{
		$$(target).addEvent('click', function(e) 
		{
			e.stopPropagation();
		});
	}
	
	
	/**
	 * connect a row to the target
	 * 
	 * @param string target
	 */
	self.connect = function(target, disableTips)
	{
		var row = $$(target);
		
		// connect row to target
		row.addEvent('click', function(e)
		{
			var link = this.getElement('.beit_target, .beit_fallback');
		
			if(link)
			{
				window.location.href = link.getProperty('href');
			}
		});
		
		// wrap image only with a span
		document.getElements('.tl_listing li > .tl_right > img').each(function(el) {
			if(el.isVisible()) {
				var span = new Element('span');
				span.inject(el, 'before');
				el.inject(span);	
			}
		});
		
		// add tips to the row
		if(disableTips == undefined || !disableTips)
		{
			for(i= 0; i < row.length; i++) 
			{
				addTips(row[i]);
			}			
		}
		
		// kee track of ajax changes
		window.addEvent('ajax_change', function(e) {
			var newRows = $$(target);
			
			newRows.each(function(element) 
			{
				if(!row.contains(element))
				{
					element.addEvent('click', function(e)
					{
						var link = this.getElement('.beit_target, .beit_fallback');
					
						if(link)
						{
							window.location.href = link.getProperty('href');
						}
					});
					
					addTips(element);
				}
			}.bind(this));
			
			row = newRows;
		}.bind(this));
	}
	
	/**
	 * handle contao mootools tips which are created in Contao 3
	 */
	var addTips = function(el)
	{
		if(typeof Tips.BackendRow == 'undefined') {
			return;
		}
		
		var link = el.getElement('.beit_target, .beit_fallback');

		if(link)
		{
			el.set('title', link.retrieve('tip:title', link.get('title')));
			new Tips.BackendRow(el, { 
				offset: {
					x: link.getPosition(el).x, 
					y: link.getPosition(el).y + 25
				},
				fixed: false,
				parentClass: el.getProperty('class')
			});
		}
	}
}

/**
 * create modified tip class which only show tip if not a children 
 * fired the tip. Need this to handles icon tips inside the row
 * 
 * it's a contao 3 feature, so let's check if Tips.Contao exists
*/

if(typeof Tips.Contao != 'undefined')
{
	Tips.BackendRow = new Class(
	{
		Extends: Tips.Contao,
	
		elementEnter: function(event, element) {
			var tag = event.target.get('tag');
	
			if(tag != 'a' && tag != 'img') {
				this.options.fixed = true;
				this.parent(event, element);
			}
			else {
				this.fireEvent('mouseleave', event);
			}
		},
	
		elementMove: function(event, element) {
			var tag = event.target.get('tag');
			if(tag == 'a' || tag == 'img') {
				clearTimeout(this.timer);
				this.hide(element);
			}
		}
	});	
}

// fix limit toggler to NOT propagate events
window.addEvent('load', function(e) {
	$$('.limit_toggler').each(function(element) {
		element.addEvent('click', function(e) {
			e.stopPropagation();
		});
	});
})

/**
 * BackendImprovedSearchWidget implements search input field, used for the BackendImprovedTree view
 * It provides events for handling search inputs
 * 
 * @author David Molineus <http://www.netzmacht.de>
 */
var BackendImprovedSearchWidget = new Class({
	
	Implements:	[Options,Events],
	
	options: {
		containerClass : 'beit_search_widget',
		inputClass: 'beit_search tl_text',
		resetClass: 'beit_reset',
		inject: '.tl_folder_top .tl_right',
		injectPosition: 'after',
		minLength: 3,
		accessKey: 'w',
		triggerEvent: 'keyup',
		stopPropagation: true,
		visible: true,
	},
	
	
	/**
	 * initialization creates required elements and register events 
	 * @param options
	 */
	initialize: function(options)
	{
		this.setOptions(options);
		
		// create container
		this.container = new Element('div');
		this.container.addClass(this.options.containerClass);
		this.container.inject(document.getElement(this.options.inject), this.options.injectPosition);
		
		// create input
		this.input = new Element('input');
		this.input.addClass(this.options.inputClass);
		this.input.setProperty('accesskey', this.options.accessKey);
		this.input.inject(this.container);
		
		// create clear button
		this.resetBtn = new Element('img');
		this.resetBtn.setProperty('src', 'system/themes/default/images/close.gif');
		this.resetBtn.addClass(this.options.resetClass);
		this.resetBtn.inject(this.container);
				
		// register events		
		this.input.addEvent(this.options.triggerEvent, function(e) {
			this.search(e);
		}.bind(this));
		
		// reset if escape key is pressed
		this.input.addEvent('keyup', function(e) {
			if(e.key == 'esc') {
				this.hide();
			}
		}.bind(this));
		
		// listen to access key
		window.addEvent('keydown', function(e) {			
			if(e.alt && e.key == this.options.accessKey)
			{
				this.show();
			}
		}.bind(this));
		
		// hide on reset button click
		this.resetBtn.addEvent('click', function(e) {
			this.hide();
		}.bind(this));
		
		// stop propagation
		if(this.options.stopPropagation)
		{
			this.container.addEvent('click', function(e) {
				e.stopPropagation();
			});
		}
		
		if(!this.options.visible)
		{
			this.hide();
		}
	},
	
	
	/**
	 * show the widget and fire show event
	 */
	show: function()
	{
		this.shown = true;
		this.container.show();
		this.input.focus();
		this.fireEvent('show');
	},
	
	
	/**
	 * hide the widget an fire hide event
	 */
	hide: function()
	{
		this.shown = false;
		this.container.hide();
		this.fireEvent('hide');
	},
	
	
	/**
	 * empty search field and fire reset event
	 */
	reset: function()
	{
		this.set('value', '');
		this.fireEvent('reset');
	},
	
	
	/**
	 * handle search request will fire the change event and set param to true if min length is reached
	 */
	search: function(e)
	{
		this.fireEvent('change', [e,(this.get('value').length >= this.options.minLength)]);
	},
	
	
	/**
	 * delegete get method to input field 
	 * @param {Object} key
	 */
	get: function(key)
	{
		return this.input.get(key);
	},


	/**
	 * delegate set method to input field 
 	 * @param {Object} key
 	 * @param {Object} value
	 */
	set: function(key, value)
	{
		this.input.set(key, value);
	},
	
});

/**
 * BackendImprovedTree toggles rows in trees like the article tree
 * 
 * @author David Molineus <http://www.netzmacht.de>
 * @package be_improved_theme
 */
var BackendImprovedTree = new Class(
{
	
	Implements:	[Options],
	
	options: {
		enableStorage: true,
		enableToggling: true,
		enableSearch: true,
		storageKey: 'beit:hidden',
		storageSearchKey: 'beit:search',
		storagePrefix: '',
		table: 'default',
		toggleOnStart: true,
		toggleIcon: ['', ''],
		targets: [],
	},
	
	
	/**
	 * initialization
	 * @param Object
	 */
	initialize: function(options)
	{
		this.setOptions(options);
		this.targets = $$(this.options.targets);
		this.options.storageKey = this.options.storagePrefix + this.options.storageKey + ':' + this.options.table + ':';
		this.options.storageSearchKey = this.options.storagePrefix + this.options.storageSearchKey + ':' + this.options.table;
		
		if(this.targets.length == 0)
		{
			return;
		}
		
		var top = document.getElement('.tl_folder_top .tl_right');
		
		if(top.getChildren().length == 0)
		{
			top.set('text', '');
		}
		
		if(this.options.enableToggling)
		{
			this.initializeToggling();
		}
		
		if(this.options.enableSearch)
		{
			this.initializeSearch();
		}
	},
	
	
	/**
	 * initialize search filter 
	 */
	initializeSearch: function()
	{
		var input = new BackendImprovedSearchWidget({ visible: false });
		var root = document.getElement('.tl_folder_top .tl_right');
		
		var a = new Element('a');
		var img = new Element('img').setProperty('src', 'system/modules/be_improved_theme/assets/search.png');
		
		img.inject(a);
		root.appendText(' ', 'top');
		a.inject(root, 'top');
		
		a.addEvent('click', function(e) {
			e.stopPropagation();
			root.hide();
			input.show();
		});
		
		input.addEvent('show', function(e) {
			input.search(e);
			root.hide();
		});
		
		input.addEvent('hide', function(e) {
			root.show();
		});
		
		input.addEvent('click', function(e) {
			input.hide();
			e.stopPropagation();
		});
		
		input.addEvent('change', function(e, search) {
			var value = input.get('value');
			
			if(search)
			{
				this.eachTarget(function(target) {
					this.searchChildren(target, value);	
				}.bind(this), true);
			}
			else {
				$$('.beit_search_result').each(function(el) {
					el.removeClass('beit_search_result');
				});
				
				$$('.beit_search_hidden').each(function(el) {
					el.removeClass('beit_search_hidden');
				});
				
				value = '';
			}
			
			if(this.options.enableStorage) {
				$.jStorage.set(this.options.storageSearchKey, value);	
			}
		}.bind(this));
		
		input.addEvent('hide', function(e) {
			$$('.beit_search_result').each(function(el) {
				el.removeClass('beit_search_result');
			});
			
			$$('.beit_search_hidden').each(function(el) {
				el.removeClass('beit_search_hidden');
			});
			
			$.jStorage.set(this.options.storageSearchKey, '');
		}.bind(this));
		

		// initialize search if storage is set
		if(this.options.enableStorage && $.jStorage.get(this.options.storageSearchKey) != '' && $.jStorage.get(this.options.storageSearchKey) != undefined) {
			
			input.set('value', $.jStorage.get(this.options.storageSearchKey));
			input.search();
			input.show();
		}
	},
	
	/**
	 * initialize toggling
	 */
	initializeToggling: function()
	{		
		var a = new Element('a');
		var top = document.getElement('.tl_folder_top .tl_right');
		var img = new Element('img').setProperty('src', 'system/modules/be_improved_theme/assets/toggle.png');

		a.set('text', this.options.toggleIcon[0] + ' ');
		
		if(this.options.toggleIcon[1] != undefined) {
			a.set('title', this.options.toggleIcon[1]);	
		}
		
		img.inject(a);
		
		if(top.getChildren().length > 0)
		{
			top.appendText(' ', 'top');
			a.inject(top, 'top');			
		}
		else{			
			a.inject(top);
		}

		a.addEvent('click', function(e) {
			e.stopPropagation();
			var hide = $$('.beit_hidden').length == 0;
		
			this.eachTarget(function(target) {
				this.toggleChildren(target, false, false, hide);
			}.bind(this));	
		}.bind(this));
		
		this.startToggler();
	},
	
	
	/**
	 * walk trough each target, neccessary for suporting FileTree
	 * @param function for every target
	 * @param additional child option for
	 */
	eachTarget: function(func, children)
	{
		this.targets.each(function(target) {
			func(target);
		});
	},
	
	
	/**
	 * 
	 */
	searchChildren: function(element, value, stop)
	{
		var found = false;
		
		if(element.length > 1)
		{
			element.each(function(child) {
				if(this.searchChildren(child, value)) {
					found = true;
				}
			}.bind(this));
		}
		else
		{
			var text = element.get('text');
			
			if(stop == undefined && !stop) {
				this.getChildren(element).each(function(child) {
					if(this.searchChildren(child, value, true)) {
						found = true;
					}
				}.bind(this));
			}
			
			found = found || text.test(value, 'i');
			this.setSearchState(element, found);
			
			this.getChildren(element).each(function(child) {
				this.setSearchState(child, found);
			}.bind(this));			
		}
		
		return found;
	},
	
	
	/**
	 * start the toggler
	 */
	startToggler: function()
	{
		// handle ajax changes
		window.addEvent('ajax_change', function(e) 
		{			
			newTargets = $$(this.options.targets);
			
			newTargets.each(function(target) 
			{				
				if(!this.targets.contains(target)) 
				{
					this.initializeTarget(target, !this.options.toggleOnStart);
				}
			}.bind(this));		
			
			this.targets = newTargets;
		}.bind(this));
		
		// only toggle if no search request was made
		var search = $$('.tl_panel input.active');

		// hide child rows if more than 3 parents are found
		if(search != undefined && search.length > 0 && this.targets.length <= 3) 
		{
			this.options.toggleOnStart = false;
		}
		
		// initialize at the beginning
		this.initializeTarget(this.targets, !this.options.toggleOnStart);
	},
	
	
	/**
	 * initialize the target
	 * @param object
	 * @param bool
	 */
	initializeTarget: function(target, prevent)
	{
		if(!prevent)
		{
			this.toggleChildren(target, false, true);
		}
		
		if(target.length != undefined)
		{
			target.each(function(child) {
				this.createRowToggleIcon(child);
			}.bind(this));
		}
		else
		{
			this.createRowToggleIcon(target);
		}
		
		var self = this;	
		target.addEvent('click', function(e) 
		{
			self.toggleChildren(this, e);						
		});
	},
	
	
	/**
	 * toggle children
	 * @param object
	 * @param Event
	 * @param fetch from storage
	 */
	toggleChildren: function(el, e, storage, value)
	{
		if(e) {
			e.stopPropagation();
		}

		if(el.length > 1) {
			el.each(function(child) {
				this.toggleChildren(child, e, storage, value);				
			}.bind(this));
		}
		else if(storage && this.options.enableStorage)
		{
			var node = this.getNodeId(el);
			
			if(node != 0)
			{
				if(!$.jStorage.get(this.options.storageKey + node, true))
				{
					return;
				}
			}				
		}

		var elements = this.getChildren(el);
		var state;
		
		elements.each(function(element) 
		{
			if(value != undefined)
			{
				if(value) {
					element.addClass('beit_hidden');
				}
				else {
					element.removeClass('beit_hidden');
				}
			}
			else
			{
				element.toggleClass('beit_hidden');				
			}			
			state = element.hasClass('beit_hidden');
		});

		if(this.options.enableStorage && state != undefined)
		{
			var node = this.getNodeId(el);

			if(node != 0)
			{
				$.jStorage.set(this.options.storageKey + node, state);
			}
		}
	},
	
	
	/**
	 * get node id for storage purposes
	 * 
	 * @param object
	 * @return int|string
	 */
	getNodeId: function(element)
	{
		var z = element.getElements('.tl_left > a');
		var node = 0;
		var href;
					
		for(var i=0; i < z.length; i++)
		{
			href = z[i].getProperty('href');
			node = new String(href).match('node=([^&]*)');
			
			if(node != undefined)
			{
				node = node[1];
				break;
			}
		}
		
		return node;
	},
	
	
	/**
	 * 
	 */
	createRowToggleIcon: function(target, element)
	{	
		if(element == undefined)
		{
			var right = target.getElement('.tl_right');
		}
		else {
			var right = element.getElement('.tl_right');
		}
		
		var a = right.getElement('.beit_toggle');
		var img;
		
		if(a == undefined) {
			a = new Element('a');
			img = new Element('img');
			
			img.inject(a);
			a.addClass('beit_toggle');
			right.appendText(' ');
			a.inject(right);
		}
		else {
			img = a.getElement('img');			
		}

		if(target != undefined && this.getChildren(target).length > 0)
		{
			img.setProperty('src', 'system/modules/be_improved_theme/assets/toggle.png');
			a.removeClass('beit_empty');			
		}
		else {
			img.setProperty('src', 'system/modules/be_improved_theme/assets/empty.png');
			a.addClass('beit_empty');
		}
	},
	
	
	/**
	 * set search state
	 * @param Element
	 * @param bool
	 */
	setSearchState: function(element, found)
	{
		if(found)
		{
			element.addClass('beit_search_result');
			element.removeClass('beit_search_hidden');
		}
		else
		{
			element.removeClass('beit_search_result');
			element.addClass('beit_search_hidden');
		}
	},
	
});

/**
 * BackendImprovedFileTree toggles rows in the article tree
 * 
 * @author David Molineus <http://www.netzmacht.de>
 * @package be_improved_theme
 */
var BackendImprovedArticleTree = new Class({
	
	Extends: BackendImprovedTree,
	
	/**
	 * initialize article toggle set default options
	 */
	initialize: function(options)
	{
		this.options.targets = '.tl_listing.tl_tree_xtnd li.tl_folder';
		this.options.breakClasses = ['tl_folder', 'parent'];
		this.parent(options);
	},
	
	/**
	 * get children elements until break class is found
	 * @param Element
	 * @return Array
	 */
	getChildren: function(element)
	{
		var doBreak = false;
		var elements = element.getAllNext();
		var filtered = new Array();
		
		for(var i=0; i< elements.length; i++) 
		{
			element = elements[i];

			for (var j = 0; j < this.options.breakClasses.length; j++) 
			{					
				if (element.hasClass(this.options.breakClasses[j])) {
					doBreak = true;
					break;
				}
			}
			
			if(doBreak)
			{
				break;
			}
			
			filtered.push(element);
		}
				
		return filtered;
	},
	 
});

