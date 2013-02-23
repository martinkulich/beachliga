<?php
$this->loadDataContainer('club');
/**
 * Table tournament
 */
$GLOBALS['TL_DCA']['tournament'] = array
(

    // Config
    'config' => array
    (
        'dataContainer' => 'Table',
        'ctable'        => array('team'),
        'switchToEdit'  => true,
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
            'mode' => 2,
            'fields' => array('date'),
            'flag' => 1,
            'disableGrouping' => true,
        ),
        'label' => array
        (
            'fields' => array('date', 'club'),
            'format' => '%s %s',
            'label_callback' => array('tournament', 'formatDate')
        ),


        'operations' => array
        (
            'edit' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tournament']['edit'],
                'href'                => 'act=edit',
                'icon'                => 'edit.gif',
                'attributes'          => 'class="contextmenu"'
            ),
            'teams' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tournament']['teams'],
                'href'                => 'table=team',
                'icon'                => 'mgroup.gif',
                'attributes'          => 'class="contextmenu"'
            ),
            'delete' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tournament']['delete'],
                'href' => 'act=delete',
                'icon' => 'delete.gif',
                'attributes' => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
//				'button_callback'     => array('tournament', 'deletetournament')
            ),
        )
    ),

    // Palettes
    'palettes' => array
    (
        'default' => 'date, start_at; club; perex, descrip; summary; gallery, preview',
    ),


    // Fields
    'fields' => array
    (
        'id' => array
        (
            'sql' => "int(10) unsigned NOT NULL auto_increment"
        ),
        'tstamp' => array
        (
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'date' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tournament']['date'],
            'inputType' => 'text',
            'eval' => array('rgxp' => 'date', 'mandatory' => true, 'doNotCopy' => true, 'datepicker' => true, 'tl_class' => 'w50 wizard'),
            'sql' => "int(10) unsigned NULL"
        ),
        'start_at' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tournament']['start_at'],
            'inputType' => 'text',
            'eval' => array('rgxp' => 'time', 'mandatory' => true),
            'sql' => "int(10) unsigned NULL"
        ),
        'club' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tournament']['club'],
            'inputType' => 'select',
            'foreignKey' => 'club.name',
            'eval' => array('mandatory' => true, 'chosen' => true, 'doNotCopy' => true, 'includeBlankOption' => true),
            'sql' => "int(10) unsigned NOT NULL default '0'",
            'relation' => array('type' => 'belongsTo', 'load' => 'eager')
        ),
        'perex' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tournament']['perex'],
            'inputType'               => 'textarea',
            'eval'                    => array('mandatory'=>false),
            'sql'                     => "text NOT NULL default ''"
        ),
        'summary' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tournament']['summary'],
            'inputType'               => 'textarea',
            'eval'                    => array('mandatory'=>false),
            'sql'                     => "text NOT NULL default ''"
        ),
        'descrip' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tournament']['descrip'],
            'inputType'               => 'textarea',
            'eval'                    => array('mandatory'=>false),
            'sql'                     => "text NOT NULL default ''"
        ),
        'gallery' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tournament']['gallery'],
            'inputType'               => 'fileTree',
            'eval'                    => array('multiple'=>true, 'fieldType'=>'checkbox', 'files'=>true, 'mandatory'=>false),
            'sql'                     => "blob NULL"
        ),
        'preview' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tournament']['preview'],
            'inputType'               => 'fileTree',
            'eval'                    => array('fieldType'=>'radio', 'filesOnly'=>true, 'mandatory'=>false),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),

    )
);

class tournament extends Backend
{
    public function formatDate($row, $label)
    {
        $date = date('d.m.Y',$row['date']);

        $club = ClubModel::findByPk($row['club']);

        return sprintf('%s %s', $date, $club->name);
    }

}

