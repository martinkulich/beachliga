<?php

$this->arrMeta = array
(
	'engine' => 'MyISAM',
	'charset' => 'utf8',
);

$this->arrFields = array
(
	'id' => "int(10) unsigned NOT NULL auto_increment",
	'name' => "varchar(32) NOT NULL default ''",
	'value' => "varchar(32) NOT NULL default ''",
);

$this->arrKeys = array
(
	'id' => 'primary',
	'name' => 'unique',
);

