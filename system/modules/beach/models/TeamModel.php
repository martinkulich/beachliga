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

class TeamModel extends Model
{

    /**
     * Table name
     * @var string
     */
    protected static $strTable = 'team';

    public static function findByTournament($tournamentId)
    {
        $now = new \DateTime();
        $query = sprintf("select * from %s  where pid = '%s' order by rank DESC ", self::$strTable, $tournamentId);
        $objStatement = Database::getInstance()->prepare($query);
        $objResult = $objStatement->execute();
        return $objResult->numRows < 1 ? null : $objResult;
    }

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
}
