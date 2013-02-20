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

/*
---
description:     ContextMenu

authors:
  - David Walsh (http://davidwalsh.name)

license:
  - MIT-style license

requires:
  core/1.2.1:   '*'
  more/1.2.1:   'Fx.*'

provides:
  - ContextMenu
...
*/
DavidWalshContextMenu = new Class({

    //implements
    Implements: [Options,Events],

    //options
    options: {
        actions: {},
        menu: 'contextmenu',
        labels: [],
        stopEvent: true,
        targets: 'body',
        trigger: 'contextmenu',
        offsets: { x:0, y:0 },
        onShow: function(){ return this;},
        onHide: function(){ return this; },
        onClick: function(){ return this;},
        fadeSpeed: 200
    },

    //initialization
    initialize: function(options) {
        //set options
        this.setOptions(options);

        //option diffs menu
        this.menu = this.parseNodes(this.options.labels, this.options.menu).inject(document.body);
        
        this.targets = $$(this.options.targets);

        //fx
        this.fx = new Fx.Tween(this.menu, { property: 'opacity', duration:this.options.fadeSpeed });

        //hide and begin the listener
        this.hide().startListener();

        //hide the menu
        this.menu.setStyles({ position:'absolute',top:'-900000px',display:'block' });
    },

    //get things started
    startListener: function() {
        /* all elemnts */
        this.targets.each(function(el) {
            /* show the menu */
            el.addEvent(this.options.trigger,function(e) {
                //enabled?
                if(!this.options.disabled) {
                    //prevent default, if told to
                    if(this.options.stopEvent) { e.stop(); }
                    //record this as the trigger
                    this.options.element = document.id(el);
                    //position the menu
                    
                    this.menu.setStyles({
                        top: (e.page.y + this.options.offsets.y),
                        left: (e.page.x + this.options.offsets.x),
                        position: 'absolute',
                        'z-index': '2000'
                    });
                    //show the menu
                    this.show();
                }
            }.bind(this));
        },this);

        //hide on body click
        document.id(document.body).addEvent('click', function() {
            this.hide();
        }.bind(this));
    },
    
    // takes a nodes array and turns it into a <ul>
    parseNodes: function(nodes,id) { 
    var ul = new Element('ul');
    if(id != undefined)ul.setProperty('id', id);
    for(var i=0; i<nodes.length; i++) {
        ul.appendChild(this.parseNode(nodes[i]));
    }
    return ul;
},

// takes a node object and turns it into a <li>
    parseNode: function (node) { 
   var li = new Element('li');
   if(node.href == undefined)node.href = void(0);
   var new_a = new Element('a', {'href' : node.href, 'class' : node.clas, 'text' : node.title}).inject(li);
   new_a.addEvent('click',function(e) {
                if(!new_a.hasClass('disabled') && node.href != undefined) {
                    this.execute(node.href.split('#')[1],document.id(this.options.element));
                    this.fireEvent('click',[new_a,e]);
            }
            }.bind(this));
   if(node.nodes) li.grab(this.parseNodes(node.nodes));
    return li;
},
    
    //show menu
    show: function() {
        this.fx.start(1);
        this.fireEvent('show');
        this.shown = true;
        return this;
    },

    //hide the menu
    hide: function() {
        if(this.shown)
        {        	
            this.fx.start(0);
            this.fireEvent('hide');
            this.shown = false;
        }      
    },

    //disable an item
    disableItem: function(item) {
        this.menu.getElements('a[href$=' + item + ']').addClass('disabled');
        return this;
    },

    //enable an item
    enableItem: function(item) {
        this.menu.getElements('a[href$=' + item + ']').removeClass('disabled');
        return this;
    },

    //diable the entire menu
    disable: function() {
        this.options.disabled = true;
        return this;
    },

    //enable the entire menu
    enable: function() {
        this.options.disabled = false;
        return this;
    },

    //execute an action
    execute: function(action,element) {
        if(this.options.actions[action]) {
            this.options.actions[action](element,this);
        }
        return this;
    }

});

/**
 * BackendImprovedContextMenu is based on Mootools ContextMenu of David Walsh which is
 * licensed by a MIT style license
 */
var BackendImprovedContextMenu = new Class(
{
    Extends: DavidWalshContextMenu,


	/**
	 * override initialize because we need to start context menu later
	 */
	initialize:	function(options)
	{
		this.options.targets = '';
		this.options.hideActions = false;
		
        //set options
        this.setOptions(options);

        //option diffs menu
        this.menu = this.generateEmptyMenu(this.options.menu).inject(document.body);    

        //fx
        this.fx = new Fx.Tween(this.menu, { property: 'opacity', duration:this.options.fadeSpeed });

        //hide and begin the listener
        this.hide();

        //hide the menu
        this.menu.setStyles({ position:'absolute',top:'-900000px',display:'block' });
        
        // kill Contao 2.11 context menu of edit action
        $$('a.contextmenu').each(function(el) {
        	el.removeEvents();
        });
	},
	
	
	/**
	 * get things started 
	 */
    generate: function() 
    {
    	this.targets = $$(this.options.targets);
    	
    	this.menuButton = new Element('a');
    	this.menuButton.addClass('beit_ContextMenuToggler');
		new Element('img').setProperty('src', 'system/modules/be_improved_theme/assets/menu.png').inject(this.menuButton);
		
        /* all elemnts */
        this.targets.each(function(el) {
        	this.handleTarget(el);
        }, this);
        
        window.addEvent('ajax_change', function(e) {
        	newTargets = $$(this.options.targets);
        	
        	newTargets.each(function(target) {
        		if(!this.targets.contains(target)) {
        			this.handleTarget(target);
        		}
        	}, this);
        	
        }.bind(this));

        //hide on body click
        document.id(document.body).addEvent('click', function() {
            this.hide();
        }.bind(this));
        
        // fix issue that context menu could overlay click area if it is hidden
        this.addEvent('hide', function() {
        	this.menu.setStyles({ position:'absolute',top:'-900000px',display:'block' });
        	$$('.beit_hover').each(function(el) {
        		el.removeClass('beit_hover');
    		});
        }.bind(this));        
    },
    
    
    /**
     * add another target for context menu
     */
    addTarget: function(target)
    {
    	if(this.options.targets == '')
    	{
    		this.options.targets = target;
    	}
    	else
    	{
    		this.options.targets = this.options.targets + ', ' + target;
    	}
    },
 
 
    /**
	 * generate empty menu
	 * @param string id
	 */
    generateEmptyMenu: function(id) 
    { 
	    var ul = new Element('ul');
	    if(id != undefined) ul.setProperty('id', id);
	    ul.addClass('beit_contextMenu');
	    return ul;
	},
	
	
	/**
	 * handle target of context menu
	 * @param Element
	 */
	handleTarget : function(el)
	{
		// hide buttons
    	el.getElements('.tl_right_nowrap, .tl_right, .tl_content_right').each(function(operations) {       		
    		if(!this.options.hideActions)
    		{
    			if(operations.getChildren().length < 2)
    			{
    				return;    				
    			}
    			
    			operations.getChildren().each(function(child) {
	    			var href = child.getProperty('href');
	    			
	    			// do not hide past buttons
	    			if(href == undefined || (!href.test('act=cut') && !child.getElement('img').getProperty('src').test('pasteafter.gif')))
	    			{
	    				child.hide();        				
	    			}
	        	});
	        	
	        	var newButton = this.menuButton.clone();	        	
	        	newButton.addEvent('click', function(e) {
	        		e.stopPropagation();
	        		el.fireEvent(this.options.trigger, e);
	        	}.bind(this));
	        	
	        	var pos = 'bottom';
	        	
	        	if($$('.header_clipboard').length > 0) {
	        		pos = 'top';
	        	}

	        	operations.appendText(' ');
	        	newButton.inject(operations, pos);    			
    		}
    	}, this);
    	
    	
        /* show the menu */
        el.addEvent(this.options.trigger, function(e) 
        {
            //enabled?
            if(!this.options.disabled && el.getElement('.beit_ContextMenuToggler') != undefined) {
            	el.addClass('beit_hover');
            	
            	if(!this.options.hideActions)
            	{
            		el.getElement('.beit_ContextMenuToggler').addClass('beit_hover');            		
            	}            	
            	
                //prevent default, if told to
                if(this.options.stopEvent) { e.stop(); }
                //record this as the trigger
                this.options.element = document.id(el);
                //position the menu
                
                this.parseRowNodes(el);
                
                var xPos = e.page.x + this.options.offsets.x;
                var parentPos = el.getPosition().x + el.getSize().x;

                if ((this.menu.getSize().x + xPos) > parentPos)
                {
                	this.menu.setStyle('left', parentPos - this.menu.getSize().x - this.options.offsets.x - 10);
                }
                else
                {
                	this.menu.setStyle('left', xPos);
                }
                                    
                this.menu.setStyles({
                    top: (e.page.y + this.options.offsets.y),                       
                    position: 'absolute',
                    'z-index': '2000'
                });
                //show the menu
                this.show();
            }
        }.bind(this));
	},
	
	
	/**
	 * parse row nodes
	 * @param Element 
	 */
	parseRowNodes: function(row)
	{
		var operations = row.getElement('.tl_right_nowrap, .tl_right, .tl_content_right');
		var elements = operations.getChildren();
		
		//empty menu
		this.menu.empty();
		
		elements.each(function(origin) {
			// do not agg toggler itself and disabled icons to context menu
			if(origin.hasClass('beit_ContextMenuToggler') || origin.get('tag') != 'a') {
				return;
			}
			
			var li = new Element('li');
			
			// create copy, so original will not be deleted
			node = origin.clone();
			node.show();
			// remove invisible class for edit header icon of contao
			node.removeClass('invisible');
			
			// handle links
			node.addEvent('click',function(e) {
                if(!node.hasClass('disabled') && node.href != undefined) {
                    this.fireEvent('click',[node,e]);
            	}
          	}.bind(this));
	          
			if(node.getElement('img') != undefined && node.getElement('img').getProperty('alt') != undefined)
			{
				var title = new Element('span');
			
				title.set('html', node.getElement('img').getProperty('alt'));
				title.inject(node);				
			}
			
			node.inject(li);		
			li.inject(this.menu);		
		}, this);
	},

});

