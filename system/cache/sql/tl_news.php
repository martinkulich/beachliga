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
	'headline' => "varchar(255) NOT NULL default ''",
	'alias' => "varbinary(128) NOT NULL default ''",
	'author' => "int(10) unsigned NOT NULL default '0'",
	'date' => "int(10) unsigned NOT NULL default '0'",
	'time' => "int(10) unsigned NOT NULL default '0'",
	'subheadline' => "varchar(255) NOT NULL default ''",
	'teaser' => "text NULL",
	'addImage' => "char(1) NOT NULL default ''",
	'singleSRC' => "varchar(255) NOT NULL default ''",
	'alt' => "varchar(255) NOT NULL default ''",
	'size' => "varchar(64) NOT NULL default ''",
	'imagemargin' => "varchar(128) NOT NULL default ''",
	'imageUrl' => "varchar(255) NOT NULL default ''",
	'fullsize' => "char(1) NOT NULL default ''",
	'caption' => "varchar(255) NOT NULL default ''",
	'floating' => "varchar(12) NOT NULL default ''",
	'addEnclosure' => "char(1) NOT NULL default ''",
	'enclosure' => "blob NULL",
	'source' => "varchar(12) NOT NULL default ''",
	'jumpTo' => "int(10) unsigned NOT NULL default '0'",
	'articleId' => "int(10) unsigned NOT NULL default '0'",
	'url' => "varchar(255) NOT NULL default ''",
	'target' => "char(1) NOT NULL default ''",
	'cssClass' => "varchar(255) NOT NULL default ''",
	'noComments' => "char(1) NOT NULL default ''",
	'featured' => "char(1) NOT NULL default ''",
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
		'table'=>'tl_news_archive',
		'field'=>'id',
		'type'=>'belongsTo',
		'load'=>'eager',
	),
	'author' => array
	(
		'table'=>'tl_user',
		'field'=>'id',
		'type'=>'hasOne',
		'load'=>'eager',
	),
	'jumpTo' => array
	(
		'table'=>'tl_page',
		'field'=>'id',
		'type'=>'belongsTo',
		'load'=>'lazy',
	),
);
