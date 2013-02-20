<?php

$this->arrMeta = array
(
	'engine' => 'MyISAM',
	'charset' => 'utf8',
);

$this->arrFields = array
(
	'id' => "int(10) unsigned NOT NULL auto_increment",
	'tstamp' => "int(10) unsigned NOT NULL default '0'",
	'name' => "varchar(64) NOT NULL default ''",
	'city' => "varchar(64) NOT NULL default ''",
	'street' => "varchar(64) NOT NULL default ''",
	'street_number' => "varchar(64) NOT NULL default ''",
	'zip' => "varchar(64) NOT NULL default ''",
	'latitude' => "varchar(64) NOT NULL default ''",
	'longitude' => "varchar(64) NOT NULL default ''",
	'phone' => "varchar(64) NOT NULL default ''",
	'email' => "varchar(64) NOT NULL default ''",
	'web' => "varchar(64) NOT NULL default ''",
);

$this->arrKeys = array
(
	'id' => 'primary',
	'name' => 'index',
);

