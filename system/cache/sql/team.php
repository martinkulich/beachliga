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
	'club' => "int(10) unsigned NOT NULL default '0'",
	'league' => "int(10) unsigned NOT NULL default '0'",
	'player' => "int(10) unsigned NOT NULL default '0'",
	'coplayer' => "int(10) unsigned NOT NULL default '0'",
	'rank' => "integer NOT NULL default 0",
);

$this->arrKeys = array
(
	'id' => 'primary',
);

$this->arrRelations = array
(
	'pid' => array
	(
		'table'=>'tournament',
		'field'=>'id',
		'type'=>'belongsTo',
		'load'=>'lazy',
	),
	'club' => array
	(
		'table'=>'club',
		'field'=>'id',
		'type'=>'belongsTo',
		'load'=>'eager',
	),
	'league' => array
	(
		'table'=>'league',
		'field'=>'id',
		'type'=>'belongsTo',
		'load'=>'eager',
	),
	'player' => array
	(
		'table'=>'player',
		'field'=>'id',
		'type'=>'belongsTo',
		'load'=>'eager',
	),
	'coplayer' => array
	(
		'table'=>'player',
		'field'=>'id',
		'type'=>'belongsTo',
		'load'=>'eager',
	),
);
