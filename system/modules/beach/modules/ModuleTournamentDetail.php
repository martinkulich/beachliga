<?php

namespace Contao;

use Contao\TournamentModel;

class ModuleTournamentDetail extends Module
{

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'module_tournament_detail';


    /**
     * Display a wildcard in the back end
     * @return string
     */
    public function generate()
    {
        if (TL_MODE == 'BE') {
            $objTemplate = new \BackendTemplate('be_wildcard');

            $objTemplate->wildcard = '### DETAIL TURNAJE ###';
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
        $tournamentId = \Input::get('id');
        $this->Template->tournament = TournamentModel::findByPk($tournamentId);

        if ($this->Template->tournament) {
            $this->Template->tournamentClub = $this->Template->tournament->getRelated('club');
            $this->Template->showResults = $this->Template->tournament->hasResults();
            $orderBy = $this->Template->showResults ? 'rank DESC' : 'tstamp ASC';

            $this->Template->leagues = $this->Template->tournament->getLeagues();

        }
    }
}
