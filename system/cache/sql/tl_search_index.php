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
	'word' => "varbinary(64) NOT NULL default ''",
	'relevance' => "smallint(5) unsigned NOT NULL default '0'",
	'language' => "varchar(2) NOT NULL default ''",
);

$this->arrKeys = array
(
	'id' => 'primary',
	'pid' => 'index',
	'word' => 'index',
);

