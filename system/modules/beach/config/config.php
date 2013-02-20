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
$GLOBALS['TL_CTE']['beach']['tournament_gallery'] = 'ContentTournamentGallery';


/**
 * Front end modules
 */
$GLOBALS['FE_MOD']['beach'] = array(
    'next_tournament' => 'ModuleNextTournament',
    'tournament_results' => 'ModuleTournamentResults',
    'league_ranking' => 'ModuleLeagueRanking',
    'last_tournaments' => 'ModuleLastTournaments',
    'tournament_detail' => 'ModuleTournamentDetail',
    'tournament_map' => 'ModuleTournamentMap',
    'ranking_preview' => 'ModuleRankingPreview',
    'ranking' => 'ModuleRanking',
    'tournaments' => 'ModuleTournaments',
    'rules' => 'ModuleRules',
);


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
