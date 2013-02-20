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
	'age_category' => "varchar(256) NOT NULL default ''",
	'class' => "varchar(256) NOT NULL default ''",
	'rules' => "text NOT NULL default ''",
);

$this->arrKeys = array
(
	'id' => 'primary',
	'name' => 'index',
);

