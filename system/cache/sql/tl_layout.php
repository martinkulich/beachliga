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
	'name' => "varchar(255) NOT NULL default ''",
	'rows' => "varchar(8) NOT NULL default ''",
	'headerHeight' => "varchar(255) NOT NULL default ''",
	'footerHeight' => "varchar(255) NOT NULL default ''",
	'cols' => "varchar(8) NOT NULL default ''",
	'widthLeft' => "varchar(255) NOT NULL default ''",
	'widthRight' => "varchar(255) NOT NULL default ''",
	'sections' => "blob NULL",
	'sPosition' => "varchar(32) NOT NULL default ''",
	'framework' => "varchar(255) NOT NULL default ''",
	'stylesheet' => "blob NULL",
	'external' => "blob NULL",
	'orderExt' => "text NULL",
	'newsfeeds' => "blob NULL",
	'calendarfeeds' => "blob NULL",
	'modules' => "blob NULL",
	'template' => "varchar(64) NOT NULL default ''",
	'doctype' => "varchar(32) NOT NULL default ''",
	'webfonts' => "varchar(255) NOT NULL default ''",
	'cssClass' => "varchar(255) NOT NULL default ''",
	'onload' => "varchar(255) NOT NULL default ''",
	'head' => "text NULL",
	'addJQuery' => "char(1) NOT NULL default ''",
	'jSource' => "varchar(16) NOT NULL default ''",
	'jquery' => "text NULL",
	'addMooTools' => "char(1) NOT NULL default ''",
	'mooSource' => "varchar(16) NOT NULL default ''",
	'mootools' => "text NULL",
	'analytics' => "varchar(64) NOT NULL default ''",
	'script' => "text NULL",
	'static' => "char(1) NOT NULL default ''",
	'width' => "varchar(255) NOT NULL default ''",
	'align' => "varchar(32) NOT NULL default ''",
);

$this->arrKeys = array
(
	'id' => 'primary',
);

$this->arrRelations = array
(
	'pid' => array
	(
		'table'=>'tl_theme',
		'field'=>'id',
		'type'=>'belongsTo',
		'load'=>'eager',
	),
	'stylesheet' => array
	(
		'table'=>'tl_style_sheet',
		'field'=>'id',
		'type'=>'hasMany',
		'load'=>'lazy',
	),
);
