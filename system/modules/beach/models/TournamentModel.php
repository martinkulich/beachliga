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

class TournamentModel extends Model
{

    /**
     * Table name
     * @var string
     */
    protected static $strTable = 'tournament';

    public static function findNextTournament()
    {
        $now = new \DateTime();
        $query = sprintf("select * from %s  where FROM_UNIXTIME(date) >= '%s' order by date ASC ", self::$strTable, $now->format('Y-m-d'));
        $objStatement = Database::getInstance()->prepare($query);
        $objStatement->limit(1);
        $objResult = $objStatement->execute();

        return $objResult->numRows < 1 ? null : new static($objResult);
    }

    public function hasResults()
    {
        $hasResults = false;
        foreach ($this->getTeams() as $team) {
            if ($team->rank > 0) {
                $hasResults = true;
                break;
            }
        }

        return $hasResults;
    }

    public function getTeams($orderBy = null)
    {
        if (is_null($orderBy)) {
            $orderBy = 'rank DESC';

        }
        $teams = array();
        $teamCollection = \TeamModel::findBy('pid', $this->id, array('order' => $orderBy));
        if ($teamCollection) {
            while ($teamCollection->next()) {
                $teams[] = $teamCollection->current();
            }
        }

        return $teams;
    }

    public static function getLastTournaments($count = 3)
    {
        $now = new \DateTime();
        $query = sprintf("select * from %s  where FROM_UNIXTIME(date) <= '%s' order by date DESC ", self::$strTable, $now->format('Y-m-d'));
        $objStatement = Database::getInstance()->prepare($query);
        $objStatement->limit($count);
        $objResult = $objStatement->execute();

        $tournaments = array();
        if ($objResult->numRows > 0) {

            $objResult = static::postFind($objResult);
            while ($tournament = $objResult->next()) {
                $tournaments[] = new self($tournament);
            }

        }
        return $tournaments;
    }

    public function __get($strKey)
    {
        switch ($strKey) {
            case 'date':
                $value = new \DateTime(date('Y-m-d', parent::__get($strKey)));
                break;
            default:
                $value = parent::__get($strKey);
        }

        return $value;
    }
}
