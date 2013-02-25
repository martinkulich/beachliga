<?php
//require dirname(__FILE__).'/../../modules/record_lookup/RecordLookup.php';
//require dirname(__FILE__).'/../../modules/record_lookup/RecordLookupDataContainer.php';

/**
 * Table team
 */
$GLOBALS['TL_DCA']['team'] = array
(

    // Config
    'config' => array
    (
        'dataContainer' => 'Table',
        'ptable' => 'tournament',
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
            'panelLayout'=>'filter, sort',
            'mode' => 4,
            'fields' => array('rank'),
            'headerFields' => array('date', 'club'),
            'child_record_callback' => array('team', 'listTeams'),
            'disableGrouping' => true,


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
                'label' => &$GLOBALS['TL_LANG']['team']['edit'],
                'href' => 'act=edit',
                'icon' => 'edit.gif',
//				'button_callback'     => array('team', 'editteam')
            ),
            'delete' => array
            (
                'label' => &$GLOBALS['TL_LANG']['team']['delete'],
                'href' => 'act=delete',
                'icon' => 'delete.gif',
                'attributes' => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
//				'button_callback'     => array('team', 'deleteteam')
            ),
        )
    ),

    // Palettes
    'palettes' => array
    (
        'default' => 'league; club; player, coplayer; rank',
    ),


    // Fields
    'fields' => array
    (
        'id' => array
        (
            'sql' => "int(10) unsigned NOT NULL auto_increment"
        ),
        'pid' => array
        (
            'label' => &$GLOBALS['TL_LANG']['team']['pid'],
            'inputType' => 'select',
            'foreignKey' => 'tournament.name',
            'exclude' => true,
            'sql' => "int(10) unsigned NOT NULL default '0'",
            'relation' => array('type' => 'belongsTo', 'load' => 'lazy')
        ),
        'tstamp' => array
        (
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'club' => array
        (
            'label' => &$GLOBALS['TL_LANG']['team']['club'],
            'inputType' => 'select',
            'foreignKey' => 'club.name',
            'eval' => array('mandatory' => true, 'chosen' => true, 'doNotCopy' => true, 'includeBlankOption' => true),
            'sql' => "int(10) unsigned NOT NULL default '0'",
            'relation' => array('type' => 'belongsTo', 'load' => 'eager'),
            'sorting'=>true,
            'filter'=>true,
        ),
        'league' => array
        (
            'label' => &$GLOBALS['TL_LANG']['team']['league'],
            'inputType' => 'select',
            'foreignKey' => 'league.name',
            'eval' => array('mandatory' => true, 'chosen' => true, 'doNotCopy' => true, 'includeBlankOption' => true),
            'sql' => "int(10) unsigned NOT NULL default '0'",
            'relation' => array('type' => 'belongsTo', 'load' => 'eager'),
            'sorting'=>true,
            'filter'=>true,
        ),
        'player' => array(
            'label' => &$GLOBALS['TL_LANG']['team']['player'],
            'inputType' => 'select',
            'foreignKey' => "player.concat(lastname, ' ', firstname)",
            'eval' => array('mandatory' => true, 'includeBlankOption' => true, 'chosen' => true),
            'sql' => "int(10) unsigned NOT NULL default '0'",
            'relation' => array('type' => 'belongsTo', 'load' => 'eager'),
            'sorting'=>true,
            'filter'=>true,
        ),
        'coplayer' => array(
            'label' => &$GLOBALS['TL_LANG']['team']['coplayer'],
            'inputType' => 'select',
            'foreignKey' => "player.concat(lastname, ' ', firstname)",
            'eval' => array('mandatory' => true, 'includeBlankOption' => true, 'chosen' => true),
            'sql' => "int(10) unsigned NOT NULL default '0'",
            'relation' => array('type' => 'belongsTo', 'load' => 'eager'),
            'sorting'=>true,
            'filter'=>true,
        ),
        'rank' => array
        (
            'label' => &$GLOBALS['TL_LANG']['team']['rank'],
            'inputType' => 'text',
            'eval' => array('mandatory' => false, 'rgxp' => 'digit'),
            'sql' => "integer NOT NULL default 0",
            'sorting'=>true,
        ),
    ),
);

class team extends Backend
{
    public function listTeams($row)
    {
        $club = ClubModel::findByPk($row['club']);
        $player = PlayerModel::findByPk($row['player']);
        $coplayer = PlayerModel::findByPk($row['coplayer']);
        $league =   LeagueModel::findByPk($row['league']);
        switch($row['rank'])
        {
            case 0:
                $ranking = '';
                break;
            case 1:
                $ranking = $row['rank'] . ' bod';
                break;
            case 2:
            case 3:
            case 4:
                $ranking = $row['rank'] . ' body';
                break;
            default:
                $ranking = $row['rank'] . ' bodů';
        }

        return sprintf("
            <table>
                <tr>
                    <td width='60px'>
                        %s
                    </td>
                    <td width='150px'>
                        %s %s
                    </td>
                    <td width='150px'>
                        %s %s
                    </td>
                    <td width='100px'>
                        %s
                    </td>
                    <td width='100px'>
                        %s
                    </td>
                 </tr>
            </table>",
            $ranking,
            $player->lastname,
            $player->firstname,
            $coplayer->lastname,
            $coplayer->firstname,
            $club->name,
            $league->age_category
        );
    }


}
