<?php

namespace Contao;


class ModuleTournamentResults extends Module
{

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'module_tournament_results';


    /**
     * Display a wildcard in the back end
     * @return string
     */
    public function generate()
    {
        if (TL_MODE == 'BE') {
            $objTemplate = new \BackendTemplate('be_wildcard');

            $objTemplate->wildcard = '### VÝSLEDKY TURNAJE ###';
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
        $tournamentId = 1;
        $this->Template->tournament = TournamentModel::findByPk($tournamentId);
        if($this->Template->tournament)
        {
            $teams = array();
            $teamsCollection = $this->Template->tournament->getTeams();
            while($teamsCollection->next())
            {
                $teams[] = $teamsCollection->current();
            }


            $this->Template->teams = $teams;
        }
    }
}
