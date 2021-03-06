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


class PlayerModel extends Model
{

	/**
	 * Table name
	 * @var string
	 */
	protected static $strTable = 'player';

    public function __toString()
    {
        return $this->lastname.' '.$this->firstname;
    }

}
