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
	'subject' => "varchar(255) NOT NULL default ''",
	'alias' => "varbinary(128) NOT NULL default ''",
	'content' => "mediumtext NULL",
	'text' => "mediumtext NULL",
	'addFile' => "char(1) NOT NULL default ''",
	'files' => "blob NULL",
	'template' => "varchar(32) NOT NULL default ''",
	'sendText' => "char(1) NOT NULL default ''",
	'externalImages' => "char(1) NOT NULL default ''",
	'sender' => "varchar(128) NOT NULL default ''",
	'senderName' => "varchar(128) NOT NULL default ''",
	'sent' => "char(1) NOT NULL default ''",
	'date' => "varchar(10) NOT NULL default ''",
);

$this->arrKeys = array
(
	'id' => 'primary',
	'pid' => 'index',
);

$this->arrRelations = array
(
	'pid' => array
	(
		'table'=>'tl_newsletter_channel',
		'field'=>'id',
		'type'=>'belongsTo',
		'load'=>'eager',
	),
);
