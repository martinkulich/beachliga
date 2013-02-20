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
	'teams' => "blob NULL",
	'date' => "int(10) unsigned NULL",
	'start_at' => "int(10) unsigned NULL",
	'club' => "int(10) unsigned NOT NULL default '0'",
	'perex' => "text NOT NULL default ''",
	'summary' => "text NOT NULL default ''",
	'descrip' => "text NOT NULL default ''",
	'gallery' => "blob NULL",
	'preview' => "varchar(255) NOT NULL default ''",
);

$this->arrKeys = array
(
	'id' => 'primary',
);

$this->arrRelations = array
(
	'teams' => array
	(
		'table'=>'team',
		'field'=>'id',
		'type'=>'hasMany',
		'load'=>'lazy',
	),
	'club' => array
	(
		'table'=>'club',
		'field'=>'id',
		'type'=>'belongsTo',
		'load'=>'eager',
	),
);
