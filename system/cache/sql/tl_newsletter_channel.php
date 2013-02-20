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
	'jumpTo' => "int(10) unsigned NOT NULL default '0'",
	'useSMTP' => "char(1) NOT NULL default ''",
	'smtpHost' => "varchar(64) NOT NULL default ''",
	'smtpUser' => "varchar(128) NOT NULL default ''",
	'smtpPass' => "varchar(32) NOT NULL default ''",
	'smtpEnc' => "varchar(3) NOT NULL default ''",
	'smtpPort' => "smallint(5) unsigned NOT NULL default '0'",
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
