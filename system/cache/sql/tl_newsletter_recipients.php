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
	'email' => "varchar(255) NOT NULL default ''",
	'active' => "char(1) NOT NULL default ''",
	'addedOn' => "varchar(10) NOT NULL default ''",
	'ip' => "varchar(64) NOT NULL default ''",
	'token' => "varchar(32) NOT NULL default ''",
);

$this->arrKeys = array
(
	'id' => 'primary',
	'pid' => 'index',
	'email' => 'index',
);

$this->arrRelations = array
(
	'pid' => array
	(
		'table'=>'tl_newsletter_channel',
		'field'=>'id',
		'type'=>'belongsTo',
		'load'=>'lazy',
	),
);
