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
	'firstname' => "varchar(64) NOT NULL default ''",
	'lastname' => "varchar(64) NOT NULL default ''",
	'birthday' => "int(10) unsigned NULL",
);

$this->arrKeys = array
(
	'id' => 'primary',
);

