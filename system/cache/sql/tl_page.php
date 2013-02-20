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
	'type' => "varchar(32) NOT NULL default ''",
	'pageTitle' => "varchar(255) NOT NULL default ''",
	'language' => "varchar(2) NOT NULL default ''",
	'robots' => "varchar(32) NOT NULL default ''",
	'description' => "text NULL",
	'redirect' => "varchar(32) NOT NULL default ''",
	'jumpTo' => "int(10) unsigned NOT NULL default '0'",
	'url' => "varchar(255) NOT NULL default ''",
	'target' => "char(1) NOT NULL default ''",
	'dns' => "varchar(255) NOT NULL default ''",
	'staticFiles' => "varchar(255) NOT NULL default ''",
	'staticPlugins' => "varchar(255) NOT NULL default ''",
	'fallback' => "char(1) NOT NULL default ''",
	'adminEmail' => "varchar(255) NOT NULL default ''",
	'dateFormat' => "varchar(32) NOT NULL default ''",
	'timeFormat' => "varchar(32) NOT NULL default ''",
	'datimFormat' => "varchar(32) NOT NULL default ''",
	'createSitemap' => "char(1) NOT NULL default ''",
	'sitemapName' => "varchar(32) NOT NULL default ''",
	'useSSL' => "char(1) NOT NULL default ''",
	'autoforward' => "char(1) NOT NULL default ''",
	'protected' => "char(1) NOT NULL default ''",
	'groups' => "blob NULL",
	'includeLayout' => "char(1) NOT NULL default ''",
	'layout' => "int(10) unsigned NOT NULL default '0'",
	'mobileLayout' => "int(10) unsigned NOT NULL default '0'",
	'includeCache' => "char(1) NOT NULL default ''",
	'cache' => "int(10) unsigned NOT NULL default '0'",
	'includeChmod' => "char(1) NOT NULL default ''",
	'cuser' => "int(10) unsigned NOT NULL default '0'",
	'cgroup' => "int(10) unsigned NOT NULL default '0'",
	'chmod' => "varchar(255) NOT NULL default ''",
	'noSearch' => "char(1) NOT NULL default ''",
	'cssClass' => "varchar(64) NOT NULL default ''",
	'sitemap' => "varchar(32) NOT NULL default ''",
	'hide' => "char(1) NOT NULL default ''",
	'guests' => "char(1) NOT NULL default ''",
	'tabindex' => "smallint(5) unsigned NOT NULL default '0'",
	'accesskey' => "char(1) NOT NULL default ''",
	'published' => "char(1) NOT NULL default ''",
	'start' => "varchar(10) NOT NULL default ''",
	'stop' => "varchar(10) NOT NULL default ''",
);

$this->arrKeys = array
(
	'id' => 'primary',
	'pid' => 'index',
	'alias' => 'index',
	'type' => 'index',
);

$this->arrRelations = array
(
	'jumpTo' => array
	(
		'table'=>'tl_page',
		'field'=>'id',
		'type'=>'hasOne',
		'load'=>'lazy',
	),
	'groups' => array
	(
		'table'=>'tl_member_group',
		'field'=>'id',
		'type'=>'hasMany',
		'load'=>'lazy',
	),
	'layout' => array
	(
		'table'=>'tl_layout',
		'field'=>'id',
		'type'=>'hasOne',
		'load'=>'lazy',
	),
	'mobileLayout' => array
	(
		'table'=>'tl_layout',
		'field'=>'id',
		'type'=>'hasOne',
		'load'=>'lazy',
	),
	'cuser' => array
	(
		'table'=>'tl_user',
		'field'=>'id',
		'type'=>'hasOne',
		'load'=>'lazy',
	),
	'cgroup' => array
	(
		'table'=>'tl_user_group',
		'field'=>'id',
		'type'=>'hasOne',
		'load'=>'lazy',
	),
);
