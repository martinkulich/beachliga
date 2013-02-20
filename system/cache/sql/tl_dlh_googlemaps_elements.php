<?php

$this->arrMeta = array
(
	'engine' => 'MyISAM',
	'charset' => 'utf8',
);

$this->arrFields = array
(
	'title' => "varchar(255) NOT NULL default ''",
	'type' => "varchar(32) NOT NULL default ''",
	'singleCoords' => "varchar(64) NOT NULL default ''",
	'markerType' => "varchar(32) NOT NULL default ''",
	'markerAction' => "varchar(255) NOT NULL default ''",
	'multiCoords' => "blob NULL",
	'markerShowTitle' => "char(1) NOT NULL default ''",
	'overlaySRC' => "varchar(255) NOT NULL default ''",
	'iconSRC' => "varchar(255) NOT NULL default ''",
	'iconSize' => "varchar(255) NOT NULL default ''",
	'iconAnchor' => "varchar(255) NOT NULL default ''",
	'hasShadow' => "char(1) NOT NULL default ''",
	'shadowSRC' => "varchar(255) NOT NULL default ''",
	'shadowSize' => "varchar(255) NOT NULL default ''",
	'strokeColor' => "varchar(6) NOT NULL default ''",
	'strokeOpacity' => "varchar(255) NOT NULL default ''",
	'strokeWeight' => "varchar(64) NOT NULL default ''",
	'fillColor' => "varchar(6) NOT NULL default ''",
	'fillOpacity' => "varchar(255) NOT NULL default ''",
	'radius' => "varchar(64) NOT NULL default ''",
	'bounds' => "varchar(255) NOT NULL default ''",
	'zIndex' => "int(10) unsigned NOT NULL default '0'",
	'popupInfoWindow' => "char(1) NOT NULL default ''",
	'useRouting' => "char(1) NOT NULL default ''",
	'routingAddress' => "varchar(255) NOT NULL default ''",
	'infoWindow' => "text NULL",
	'infoWindowAnchor' => "varchar(255) NOT NULL default ''",
	'url' => "varchar(255) NOT NULL default ''",
	'target' => "char(1) NOT NULL default ''",
	'linkTitle' => "varchar(255) NOT NULL default ''",
	'parameter' => "text NULL",
	'published' => "char(1) NOT NULL default ''",
	'sorting' => "int(10) unsigned NOT NULL default '0'",
	'id' => "int(10) unsigned NOT NULL auto_increment",
	'pid' => "int(10) unsigned NOT NULL default '0'",
	'tstamp' => "int(10) unsigned NOT NULL default '0'",
);

$this->arrKeys = array
(
	'id' => 'primary',
	'pid' => 'index',
);

