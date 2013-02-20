<?php

namespace Contao;
use Contao\TournamentModel;

class ModuleTournaments extends Module
{

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'module_tournaments';


    /**
     * Display a wildcard in the back end
     * @return string
     */
    public function generate()
    {
        if (TL_MODE == 'BE') {
            $objTemplate = new \BackendTemplate('be_wildcard');

            $objTemplate->wildcard = '### TURNAJE ###';
            $objTemplate->title = $this->headline;
            $objTemplate->id = $this->id;
            $objTemplate->link = $this->name;
            $objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

            return $objTemplate->parse();
        }


        return parent::generate();
    }

    /**
     * Generate the module
     */
    protected function compile()
    {
        $this->Template->pastTournaments = \TournamentModel::getTournaments('past');
        $this->Template->futureTournaments = \TournamentModel::getTournaments('future');
    }
}
