<?php

$this->arrMeta = array
(
	'engine' => 'MyISAM',
	'charset' => 'utf8',
);

$this->arrFields = array
(
	'id' => "int(10) unsigned NOT NULL auto_increment",
	'pid' => "int(10) unsigned NOT NULL default '0'",
	'tstamp' => "int(10) unsigned NOT NULL default '0'",
	'version' => "smallint(5) unsigned NOT NULL default '1'",
	'fromTable' => "varchar(255) NOT NULL default ''",
	'userid' => "int(10) unsigned NOT NULL default '0'",
	'username' => "varchar(64) NOT NULL default ''",
	'description' => "varchar(255) NOT NULL default ''",
	'editUrl' => "varchar(255) NOT NULL default ''",
	'active' => "char(1) NOT NULL default ''",
	'data' => "mediumblob NULL",
);

$this->arrKeys = array
(
	'id' => 'primary',
	'pid' => 'index',
	'fromTable' => 'index',
);

