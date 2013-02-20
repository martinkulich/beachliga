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
	'sorting' => "int(10) unsigned NOT NULL default '0'",
	'tstamp' => "int(10) unsigned NOT NULL default '0'",
	'title' => "varchar(255) NOT NULL default ''",
	'alias' => "varbinary(128) NOT NULL default ''",
	'author' => "int(10) unsigned NOT NULL default '0'",
	'inColumn' => "varchar(32) NOT NULL default ''",
	'keywords' => "text NULL",
	'showTeaser' => "char(1) NOT NULL default ''",
	'teaserCssID' => "varchar(255) NOT NULL default ''",
	'teaser' => "text NULL",
	'printable' => "varchar(255) NOT NULL default ''",
	'cssID' => "varchar(255) NOT NULL default ''",
	'space' => "varchar(64) NOT NULL default ''",
	'published' => "char(1) NOT NULL default ''",
	'start' => "varchar(10) NOT NULL default ''",
	'stop' => "varchar(10) NOT NULL default ''",
);

$this->arrKeys = array
(
	'id' => 'primary',
	'pid' => 'index',
	'alias' => 'index',
);

$this->arrRelations = array
(
	'pid' => array
	(
		'table'=>'tl_page',
		'field'=>'id',
		'type'=>'belongsTo',
		'load'=>'lazy',
	),
	'author' => array
	(
		'table'=>'tl_user',
		'field'=>'id',
		'type'=>'hasOne',
		'load'=>'eager',
	),
);
