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
	'invisible' => "char(1) NOT NULL default ''",
	'selector' => "varchar(255) NOT NULL default ''",
	'category' => "varchar(32) NOT NULL default ''",
	'comment' => "varchar(255) NOT NULL default ''",
	'size' => "char(1) NOT NULL default ''",
	'width' => "varchar(64) NOT NULL default ''",
	'height' => "varchar(64) NOT NULL default ''",
	'minwidth' => "varchar(64) NOT NULL default ''",
	'minheight' => "varchar(64) NOT NULL default ''",
	'maxwidth' => "varchar(64) NOT NULL default ''",
	'maxheight' => "varchar(64) NOT NULL default ''",
	'positioning' => "char(1) NOT NULL default ''",
	'trbl' => "varchar(128) NOT NULL default ''",
	'position' => "varchar(32) NOT NULL default ''",
	'floating' => "varchar(32) NOT NULL default ''",
	'clear' => "varchar(32) NOT NULL default ''",
	'overflow' => "varchar(32) NOT NULL default ''",
	'display' => "varchar(32) NOT NULL default ''",
	'alignment' => "char(1) NOT NULL default ''",
	'margin' => "varchar(128) NOT NULL default ''",
	'padding' => "varchar(128) NOT NULL default ''",
	'align' => "varchar(32) NOT NULL default ''",
	'verticalalign' => "varchar(32) NOT NULL default ''",
	'textalign' => "varchar(32) NOT NULL default ''",
	'background' => "char(1) NOT NULL default ''",
	'bgcolor' => "varchar(64) NOT NULL default ''",
	'bgimage' => "varchar(255) NOT NULL default ''",
	'bgposition' => "varchar(32) NOT NULL default ''",
	'bgrepeat' => "varchar(32) NOT NULL default ''",
	'shadowsize' => "varchar(128) NOT NULL default ''",
	'shadowcolor' => "varchar(64) NOT NULL default ''",
	'gradientAngle' => "varchar(32) NOT NULL default ''",
	'gradientColors' => "varchar(128) NOT NULL default ''",
	'border' => "char(1) NOT NULL default ''",
	'borderwidth' => "varchar(128) NOT NULL default ''",
	'borderstyle' => "varchar(32) NOT NULL default ''",
	'bordercolor' => "varchar(64) NOT NULL default ''",
	'borderradius' => "varchar(128) NOT NULL default ''",
	'bordercollapse' => "varchar(32) NOT NULL default ''",
	'borderspacing' => "varchar(64) NOT NULL default ''",
	'font' => "char(1) NOT NULL default ''",
	'fontfamily' => "varchar(255) NOT NULL default ''",
	'fontsize' => "varchar(64) NOT NULL default ''",
	'fontcolor' => "varchar(64) NOT NULL default ''",
	'lineheight' => "varchar(64) NOT NULL default ''",
	'fontstyle' => "varchar(255) NOT NULL default ''",
	'whitespace' => "char(1) NOT NULL default ''",
	'texttransform' => "varchar(32) NOT NULL default ''",
	'textindent' => "varchar(64) NOT NULL default ''",
	'letterspacing' => "varchar(64) NOT NULL default ''",
	'wordspacing' => "varchar(64) NOT NULL default ''",
	'list' => "char(1) NOT NULL default ''",
	'liststyletype' => "varchar(32) NOT NULL default ''",
	'liststyleimage' => "varchar(255) NOT NULL default ''",
	'own' => "text NULL",
);

$this->arrKeys = array
(
	'id' => 'primary',
	'pid' => 'index',
	'selector' => 'index',
);

$this->arrRelations = array
(
	'pid' => array
	(
		'table'=>'tl_style_sheet',
		'field'=>'id',
		'type'=>'belongsTo',
		'load'=>'lazy',
	),
);
