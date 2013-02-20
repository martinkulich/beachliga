<?php

$this->arrMeta = array
(
	'engine' => 'MyISAM',
	'charset' => 'utf8',
);

$this->arrFields = array
(
	'title' => "varchar(255) NOT NULL default ''",
	'center' => "varchar(64) NOT NULL default ''",
	'geocoderAddress' => "varchar(255) NOT NULL default ''",
	'geocoderCountry' => "varchar(2) NOT NULL default '1'",
	'mapSize' => "varchar(255) NOT NULL default ''",
	'zoom' => "int(10) unsigned NOT NULL default '0'",
	'mapTypeId' => "varchar(16) NOT NULL default ''",
	'mapTypesAvailable' => "varchar(255) NOT NULL default ''",
	'staticMapNoscript' => "char(1) NOT NULL default '1'",
	'sensor' => "char(1) NOT NULL default '1'",
	'useMapTypeControl' => "char(1) NOT NULL default '1'",
	'mapTypeControlStyle' => "varchar(16) NOT NULL default ''",
	'mapTypeControlPos' => "varchar(16) NOT NULL default ''",
	'useNavigationControl' => "char(1) NOT NULL default '1'",
	'navigationControlStyle' => "varchar(16) NOT NULL default ''",
	'navigationControlPos' => "varchar(16) NOT NULL default ''",
	'streetViewControl' => "char(1) NOT NULL default '1'",
	'disableDoubleClickZoom' => "char(1) NOT NULL default '1'",
	'scrollwheel' => "char(1) NOT NULL default '1'",
	'draggable' => "char(1) NOT NULL default '1'",
	'useScaleControl' => "char(1) NOT NULL default '1'",
	'scaleControlPos' => "varchar(16) NOT NULL default ''",
	'parameter' => "text NULL",
	'id' => "int(10) unsigned NOT NULL auto_increment",
	'tstamp' => "int(10) unsigned NOT NULL default '0'",
);

$this->arrKeys = array
(
	'id' => 'primary',
);

