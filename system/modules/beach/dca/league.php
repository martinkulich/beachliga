<?php

/**
 * Table league
 */
$GLOBALS['TL_DCA']['league'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary',
				'name' => 'index',
			)
		)
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 2,
			'fields'                  => array('name'),
			'flag'                    => 12,
            'disableGrouping'=>true,
		),
		'label' => array
		(
			'fields'                  => array('name'),
			'format'                  => '%s',
		),


		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['league']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif',
//				'button_callback'     => array('league', 'editLeague')
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['league']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
//				'button_callback'     => array('league', 'deleteLeague')
			),
		)
	),

	// Palettes
	'palettes' => array
	(
		'default'                     => 'name; {rules}, age_category, serve, receive, net_height, court_dimensions, ball, number_of_players, other_rules'
	),


	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),

		'name' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['league']['name'],
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>64),
			'sql'                     => "varchar(64) NOT NULL default ''"
		),
        'age_category' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['league']['age_category'],
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>false, 'maxlength'=>256),
            'sql'                     => "varchar(256) NOT NULL default ''"
        ),
        'serve' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['league']['serve'],
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>false, 'maxlength'=>256),
            'sql'                     => "varchar(256) NOT NULL default ''"
        ),
        'receive' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['league']['receive'],
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>false, 'maxlength'=>256),
            'sql'                     => "varchar(256) NOT NULL default ''"
        ),
        'court_dimensions' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['league']['court_dimensions'],
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>false, 'maxlength'=>256),
            'sql'                     => "varchar(256) NOT NULL default ''"
        ),
        'ball' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['league']['ball'],
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>false, 'maxlength'=>256),
            'sql'                     => "varchar(256) NOT NULL default ''"
        ),
        'number_of_players' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['league']['number_of_players'],
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>false, 'rgxp'=>'digit'),
            'sql'                     => "integer NOT NULL default 2"
        ),
        'other_rules' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['league']['other_rules'],
            'inputType'               => 'textarea',
            'eval'                    => array('mandatory'=>false),
            'sql'                     => "text NOT NULL default ''"
        ),
	)
);

