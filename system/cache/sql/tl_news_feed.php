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
	'title' => "varchar(255) NOT NULL default ''",
	'alias' => "varbinary(128) NOT NULL default ''",
	'language' => "varchar(32) NOT NULL default ''",
	'archives' => "blob NULL",
	'format' => "varchar(32) NOT NULL default ''",
	'source' => "varchar(32) NOT NULL default ''",
	'maxItems' => "smallint(5) unsigned NOT NULL default '0'",
	'feedBase' => "varchar(255) NOT NULL default ''",
	'description' => "text NULL",
);

$this->arrKeys = array
(
	'id' => 'primary',
	'alias' => 'index',
);

