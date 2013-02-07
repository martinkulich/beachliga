<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (C) 2005-2013 Leo Feyer
 *
 * @package Comments
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Add content element
 */
//$GLOBALS['TL_CTE']['includes']['comments'] = 'ContentComments';


/**
 * Front end modules
 */
//$GLOBALS['FE_MOD']['application']['comments'] = 'ModuleComments';


/**
 * Back end modules
 */
array_insert($GLOBALS['BE_MOD']['beach'], 1, array
    (
        'club' => array
        (
            'tables' => array('club'),
        ),
        'league' => array
        (
            'tables' => array('league'),
        ),

        'tournament' => array
        (
            'tables' => array('tournament', 'team'),
        ),
        'player' => array
        (
            'tables' => array('player'),
        ),
    )
);
