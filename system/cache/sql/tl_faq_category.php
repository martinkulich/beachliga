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
	'title' => "varchar(255) NOT NULL default ''",
	'headline' => "varchar(255) NOT NULL default ''",
	'jumpTo' => "int(10) unsigned NOT NULL default '0'",
	'allowComments' => "char(1) NOT NULL default ''",
	'notify' => "varchar(16) NOT NULL default ''",
	'sortOrder' => "varchar(12) NOT NULL default ''",
	'perPage' => "smallint(5) unsigned NOT NULL default '0'",
	'moderate' => "char(1) NOT NULL default ''",
	'bbcode' => "char(1) NOT NULL default ''",
	'requireLogin' => "char(1) NOT NULL default ''",
	'disableCaptcha' => "char(1) NOT NULL default ''",
);

$this->arrKeys = array
(
	'id' => 'primary',
);

$this->arrRelations = array
(
	'jumpTo' => array
	(
		'table'=>'tl_page',
		'field'=>'id',
		'type'=>'hasOne',
		'load'=>'eager',
	),
);
