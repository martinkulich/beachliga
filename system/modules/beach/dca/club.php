<?php

/**
 * Table club
 */
$GLOBALS['TL_DCA']['club'] = array
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
				'label'               => &$GLOBALS['TL_LANG']['club']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif',
//				'button_callback'     => array('club', 'editclub')
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['club']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
//				'button_callback'     => array('club', 'deleteclub')
			),
		)
	),

	// Palettes
	'palettes' => array
	(
		'default'                     => 'name;  {address}, city, street, street_number, zip; {gps coordinations}, latitude, longitude; {contacts}, phone, email, web'
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
			'label'                   => &$GLOBALS['TL_LANG']['club']['name'],
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>64),
			'sql'                     => "varchar(64) NOT NULL default ''"
		),
        'city' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['club']['city'],
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>64),
            'sql'                     => "varchar(64) NOT NULL default ''"
        ),
        'street' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['club']['street'],
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>64),
            'sql'                     => "varchar(64) NOT NULL default ''"
        ),
        'street_number' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['club']['street_number'],
            'inputType'               => 'text',
            'eval'                    => array( 'maxlength'=>64),
            'sql'                     => "varchar(64) NOT NULL default ''"
        ),
        'zip' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['club']['zip'],
            'inputType'               => 'text',
            'eval'                    => array( 'maxlength'=>64),
            'sql'                     => "varchar(64) NOT NULL default ''"
        ),
        'latitude' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['club']['latitude'],
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>64),
            'sql'                     => "varchar(64) NOT NULL default ''"
        ),
        'longitude' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['club']['longitude'],
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>64),
            'sql'                     => "varchar(64) NOT NULL default ''"
        ),
        'phone' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['club']['phone'],
            'inputType'               => 'text',
            'eval'                    => array( 'maxlength'=>64),
            'sql'                     => "varchar(64) NOT NULL default ''"
        ),
        'email' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['club']['email'],
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>64, 'rgxp'=>'email'),
            'sql'                     => "varchar(64) NOT NULL default ''"
        ),
        'web' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['club']['web'],
            'inputType'               => 'text',
            'eval'                    => array( 'maxlength'=>64, 'rgxp'=>'url'),
            'sql'                     => "varchar(64) NOT NULL default ''"
        ),
	)
);

