<?php

/**
 * Contao Open Source CMS
 * 
 * Copyright (C) 2005-2013 Leo Feyer
 * 
 * @package beach
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'Contao\Tournament'            => 'system/modules/beach/classes/Tournament.php',

//
//	// Elements
	'Contao\ContentTournamentGallery'     => 'system/modules/beach/elements/ContentTournamentGallery.php',

	// Models
	'Contao\ClubModel'       => 'system/modules/beach/models/ClubModel.php',
    'Contao\PlayerModel'       => 'system/modules/beach/models/PlayerModel.php',
    'Contao\TournamentModel'       => 'system/modules/beach/models/TournamentModel.php',
    'Contao\TeamModel'       => 'system/modules/beach/models/TeamModel.php',
    'Contao\LeagueModel'       => 'system/modules/beach/models/LeagueModel.php',

	// Modules
	'Contao\ModuleNextTournament'      => 'system/modules/beach/modules/ModuleNextTournament.php',
    'Contao\ModuleTournamentResults'      => 'system/modules/beach/modules/ModuleTournamentResults.php',
    'Contao\ModuleLastTournaments'      => 'system/modules/beach/modules/ModuleLastTournaments.php',
    'Contao\ModuleTournamentDetail'      => 'system/modules/beach/modules/ModuleTournamentDetail.php',
    'Contao\ModuleTournamentMap'      => 'system/modules/beach/modules/ModuleTournamentMap.php',
    'Contao\ModuleRankingPreview'      => 'system/modules/beach/modules/ModuleRankingPreview.php',
    'Contao\ModuleRanking'      => 'system/modules/beach/modules/ModuleRanking.php',
    'Contao\ModuleTournaments'      => 'system/modules/beach/modules/ModuleTournaments.php',
    'Contao\ModuleRules'      => 'system/modules/beach/modules/ModuleRules.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'module_next_tournament'      => 'system/modules/beach/templates',
    'module_league_ranking'      => 'system/modules/beach/templates',
    'module_tournament_results'      => 'system/modules/beach/templates',
    'module_league_ranking'      => 'system/modules/beach/templates',
    'module_last_tournaments'      => 'system/modules/beach/templates',
    'module_tournament_detail'      => 'system/modules/beach/templates',
    'module_tournament_map'      => 'system/modules/beach/templates',
    'module_ranking_preview'      => 'system/modules/beach/templates',
    'module_ranking'         => 'system/modules/beach/templates',
    'module_tournaments'      => 'system/modules/beach/templates',
    'module_rules'      => 'system/modules/beach/templates',

));
