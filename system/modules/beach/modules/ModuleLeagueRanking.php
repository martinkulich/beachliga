<?php

namespace Contao;

class ModuleLeagueRankingPreview extends Module
{

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'module_league_rankingPreview';


    /**
     * Display a wildcard in the back end
     * @return string
     */
    public function generate()
    {
        if (TL_MODE == 'BE') {
            $objTemplate = new \BackendTemplate('be_wildcard');

            $objTemplate->wildcard = '### ŽEBŘÍČKY SOUTĚŽÍ - NÁHLED  ###';
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
        $this->Template->leagues = LeagueModel::findAll();
        if($this->Template->leagues)
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
