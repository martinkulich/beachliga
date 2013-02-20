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
	'source' => "varchar(32) NOT NULL default ''",
	'parent' => "int(10) unsigned NOT NULL default '0'",
	'date' => "varchar(64) NOT NULL default ''",
	'name' => "varchar(64) NOT NULL default ''",
	'email' => "varchar(255) NOT NULL default ''",
	'website' => "varchar(128) NOT NULL default ''",
	'comment' => "text NULL",
	'addReply' => "char(1) NOT NULL default ''",
	'author' => "int(10) unsigned NOT NULL default '0'",
	'reply' => "text NULL",
	'published' => "char(1) NOT NULL default ''",
	'ip' => "varchar(64) NOT NULL default ''",
	'notified' => "char(1) NOT NULL default ''",
);

$this->arrKeys = array
(
	'id' => 'primary',
	'source' => 'index',
	'parent' => 'index',
);

$this->arrRelations = array
(
	'author' => array
	(
		'table'=>'tl_user',
		'field'=>'id',
		'type'=>'belongsTo',
		'load'=>'eager',
	),
);
