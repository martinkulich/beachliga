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
	'username' => "varchar(64) NOT NULL default ''",
	'name' => "varchar(255) NOT NULL default ''",
	'email' => "varchar(255) NOT NULL default ''",
	'language' => "varchar(2) NOT NULL default ''",
	'backendTheme' => "varchar(32) NOT NULL default ''",
	'uploader' => "varchar(32) NOT NULL default ''",
	'showHelp' => "char(1) NOT NULL default ''",
	'thumbnails' => "char(1) NOT NULL default ''",
	'useRTE' => "char(1) NOT NULL default ''",
	'useCE' => "char(1) NOT NULL default ''",
	'password' => "varchar(128) NOT NULL default ''",
	'pwChange' => "char(1) NOT NULL default ''",
	'admin' => "char(1) NOT NULL default ''",
	'groups' => "blob NULL",
	'inherit' => "varchar(12) NOT NULL default ''",
	'modules' => "blob NULL",
	'themes' => "blob NULL",
	'pagemounts' => "blob NULL",
	'alpty' => "blob NULL",
	'filemounts' => "blob NULL",
	'fop' => "blob NULL",
	'forms' => "blob NULL",
	'formp' => "blob NULL",
	'disable' => "char(1) NOT NULL default ''",
	'start' => "varchar(10) NOT NULL default ''",
	'stop' => "varchar(10) NOT NULL default ''",
	'session' => "blob NULL",
	'dateAdded' => "int(10) unsigned NOT NULL default '0'",
	'lastLogin' => "int(10) unsigned NOT NULL default '0'",
	'currentLogin' => "int(10) unsigned NOT NULL default '0'",
	'loginCount' => "smallint(5) unsigned NOT NULL default '3'",
	'locked' => "int(10) unsigned NOT NULL default '0'",
	'calendars' => "blob NULL",
	'calendarp' => "blob NULL",
	'calendarfeeds' => "blob NULL",
	'calendarfeedp' => "blob NULL",
	'faqs' => "blob NULL",
	'faqp' => "blob NULL",
	'news' => "blob NULL",
	'newp' => "blob NULL",
	'newsfeeds' => "blob NULL",
	'newsfeedp' => "blob NULL",
	'newsletters' => "blob NULL",
	'newsletterp' => "blob NULL",
);

$this->arrKeys = array
(
	'id' => 'primary',
	'username' => 'unique',
	'email' => 'index',
);

$this->arrRelations = array
(
	'groups' => array
	(
		'table'=>'tl_user_group',
		'field'=>'id',
		'type'=>'belongsToMany',
		'load'=>'lazy',
	),
);
