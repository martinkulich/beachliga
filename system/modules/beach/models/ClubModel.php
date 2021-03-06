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


class ClubModel extends Model
{

	/**
	 * Table name
	 * @var string
	 */
	protected static $strTable = 'club';

    public function __toString()
    {
        return $this->name;
    }
}
