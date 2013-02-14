<?php

namespace Contao;

class ModuleLeagueRanking extends Module
{

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'module_league_ranking';


    /**
     * Display a wildcard in the back end
     * @return string
     */
    public function generate()
    {
        if (TL_MODE == 'BE') {
            $objTemplate = new \BackendTemplate('be_wildcard');

            $objTemplate->wildcard = '### ŽEBŘÍČEK SOUTĚŽE ###';
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
        $leagueId = \Input::get('id');
        $leagueId = 1;
        $this->Template->league = LeagueModel::findByPk($leagueId);
        if($this->Template->league)
        {
            $tournaments = array();
            $tournamentCollection = $this->Template->league->getTournaments();
            while($tournamentCollection->next())
            {
                $tournaments[] = $tournamentCollection->current();
            }


            $this->Template->tournaments = $tournaments;
        }
    }
}
