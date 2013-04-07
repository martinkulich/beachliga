<?php

/**
 * Table player
 */
$GLOBALS['TL_DCA']['player'] = array
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
			)
		)
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 2,
			'fields'                  => array('lastname', 'firstname'),
			'flag'                    => 1,
            'disableGrouping'         =>true,
            'panelLayout'=>'sort, search, limit',
		),
		'label' => array
		(
			'fields'                  => array('lastname', 'firstname', 'club'),
			'format'                  => '%s %s %s',
            'label_callback' => array('player', 'labelCallback')
		),

        'global_operations' => array
        (
            'all' => array
            (
                'label' => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href' => 'act=select',
                'class' => 'header_edit_all',
                'attributes' => 'onclick="Backend.getScrollOffset()" accesskey="e"'
            )
        ),

		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['player']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif',
//				'button_callback'     => array('player', 'editplayer')
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['player']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
//				'button_callback'     => array('player', 'deleteplayer')
			),
		)
	),

	// Palettes
	'palettes' => array
	(
		'default'                     => 'firstname, lastname; birthday; {contacts}, phone, email; club',
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

		'firstname' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['player']['firstname'],
			'inputType'               => 'text',
            'search'                  => true,
            'filter'                  => true,
            'sorting'                  => true,
			'eval'                    => array('mandatory'=>true, 'maxlength'=>64),
			'sql'                     => "varchar(64) NOT NULL default ''"
		),
        'lastname' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['player']['lastname'],
            'inputType'               => 'text',
            'search'                  => true,
            'filter'                  => true,
            'sorting'                  => true,
            'eval'                    => array('mandatory'=>true, 'maxlength'=>64),
            'sql'                     => "varchar(64) NOT NULL default ''"
        ),
        'birthday' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['player']['birthday'],
            'inputType'               => 'text',
            'eval'                    => array('rgxp'=>'date', 'mandatory'=>true, 'doNotCopy'=>true, 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
            'sql'                     => "int(10) unsigned NULL"
        ),
        'phone' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['player']['phone'],
            'inputType'               => 'text',
            'eval'                    => array( 'maxlength'=>64),
            'sql'                     => "varchar(64) NOT NULL default ''"
        ),
        'email' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['player']['email'],
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>64, 'rgxp'=>'email'),
            'sql'                     => "varchar(64) NOT NULL default ''"
        ),
        'club' => array
        (
            'label' => &$GLOBALS['TL_LANG']['player']['club'],
            'inputType' => 'select',
            'foreignKey' => 'club.name',
            'eval' => array('mandatory' => true, 'chosen' => true, 'doNotCopy' => true, 'includeBlankOption' => true),
            'sql' => "int(10) unsigned NOT NULL default '0'",
            'relation' => array('type' => 'belongsTo', 'load' => 'eager')
        ),
	)
);


class player extends Backend
{
    public function labelCallback($row)
    {
        $club = ClubModel::findByPk($row['club']);
        return sprintf('%s %s %s', $row['lastname'], $row['firstname'], $club->name);
    }


}


