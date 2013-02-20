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
 * Run in a custom namespace, so the class can be replaced
 */
namespace Contao;

use Contao\PlayerModel;

class LeagueModel extends Model
{

    /**
     * Table name
     * @var string
     */
    protected static $strTable = 'league';

    public static function findAll(array $arrOptions = array())
    {
        $objectCollection = parent::findAll($arrOptions);
        $objects = array();
        if ($objectCollection) {
            while ($objectCollection->next()) {
                $objects[] = $objectCollection->current();
            }
        }

        return $objects;
    }

    public function getPlayers($limit = null)
    {
        $query = sprintf("
            select
              p.*,
              sum(t.rank) as rank
            from player p
            join team t on t.player = p.id or t.coplayer = p.id
            where t.league = %s
            group by p.id
            ORDER BY sum(t.rank) DESC
            %s
            ",
            $this->id,
            $limit ? ' limit '.$limit : null
        );

        $objStatement = Database::getInstance()->prepare($query);
        $objResult = $objStatement->execute();

        $players = array();
        if ($objResult->numRows > 0) {

            $objResult = static::postFind($objResult);
            while ($player = $objResult->next()) {
                $playerObject = new \PlayerModel($player);
                $players[] = $playerObject;
            }

        }

        return $players;
    }

    public function getClubs($limit = null)
    {
        $query = sprintf("
            select
              c.*,
              sum(t.rank) as rank
            from club c
            join team t on t.club = c.id
            where t.league = %s
            group by c.id
            ORDER BY sum(t.rank) DESC
            %s
            ",
            $this->id,
            $limit ? ' limit '.$limit : null
        );

        $objStatement = Database::getInstance()->prepare($query);
        $objResult = $objStatement->execute();

        $clubs = array();
        if ($objResult->numRows > 0) {

            $objResult = static::postFind($objResult);
            while ($club = $objResult->next()) {
                $clubObject = new \ClubModel($club);
                $clubs[] = $clubObject;
            }

        }

        return $clubs;
    }

    public function getTeams(TournamentModel $tournament = null, $limit = null)
    {
        $teams = array();
        if (null === $tournament) {
            $teamsCollection = \TeamModel::findBy('league', $this->id, array('order' => 'rank DESC'));
            while ($team = $teamsCollection->next()) {
                $teams[] = new TeamModel($team);
            }

        } else {
            $query = sprintf("
            select  *
            from team
            where league = %s
            AND pid = %s
            ORDER BY %s
            ",
                $this->id,
                $tournament->id,
                $tournament->hasResults() ? 'rank DESC' : 'tstamp ASC'
            );
            $objStatement = Database::getInstance()->prepare($query);
            if ($limit) {
                $objStatement->setLimit($limit);
            }
            $objResult = $objStatement->execute();

            $teams = array();
            if ($objResult->numRows > 0) {

                $objResult = static::postFind($objResult);
                while ($team = $objResult->next()) {
                    $teams[] = new TeamModel($team);
                }

            }
        }

        return $teams;
    }

}
