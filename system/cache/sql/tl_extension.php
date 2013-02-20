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
	'title' => "varchar(64) NOT NULL default ''",
	'folder' => "varchar(48) NOT NULL default ''",
	'author' => "varchar(128) NOT NULL default ''",
	'copyright' => "varchar(128) NOT NULL default ''",
	'package' => "varchar(64) NOT NULL default ''",
	'license' => "varchar(64) NOT NULL default ''",
	'addBeMod' => "char(1) NOT NULL default ''",
	'beClasses' => "varchar(255) NOT NULL default ''",
	'beTables' => "varchar(255) NOT NULL default ''",
	'beTemplates' => "varchar(255) NOT NULL default ''",
	'addFeMod' => "char(1) NOT NULL default ''",
	'feClasses' => "varchar(255) NOT NULL default ''",
	'feTables' => "varchar(255) NOT NULL default ''",
	'feTemplates' => "varchar(255) NOT NULL default ''",
	'addLanguage' => "char(1) NOT NULL default ''",
	'languages' => "varchar(255) NOT NULL default ''",
);

$this->arrKeys = array
(
	'id' => 'primary',
);

