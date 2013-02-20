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
	'alias' => "varbinary(128) NOT NULL default ''",
	'jumpTo' => "int(10) unsigned NOT NULL default '0'",
	'sendViaEmail' => "char(1) NOT NULL default ''",
	'recipient' => "text NULL",
	'subject' => "varchar(255) NOT NULL default ''",
	'format' => "varchar(12) NOT NULL default ''",
	'skipEmpty' => "char(1) NOT NULL default ''",
	'storeValues' => "char(1) NOT NULL default ''",
	'targetTable' => "varchar(64) NOT NULL default ''",
	'method' => "varchar(12) NOT NULL default ''",
	'attributes' => "varchar(255) NOT NULL default ''",
	'formID' => "varchar(64) NOT NULL default ''",
	'tableless' => "char(1) NOT NULL default ''",
	'allowTags' => "char(1) NOT NULL default ''",
);

$this->arrKeys = array
(
	'id' => 'primary',
	'alias' => 'index',
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
