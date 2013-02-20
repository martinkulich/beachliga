<?php

namespace Contao;

class ModuleLastTournaments extends Module
{

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'module_last_tournaments';


    /**
     * Display a wildcard in the back end
     * @return string
     */
    public function generate()
    {
        if (TL_MODE == 'BE') {
            $objTemplate = new \BackendTemplate('be_wildcard');

            $objTemplate->wildcard = '### POSLEDNÍ TURNAJE ###';
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
        $this->Template->tournaments = TournamentModel::getLastTournaments();
        $this->Template->limit = 3;
    }
}
