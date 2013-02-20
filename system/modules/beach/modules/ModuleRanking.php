<?php

namespace Contao;


class ModuleRanking extends Module
{

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'module_ranking';


    /**
     * Display a wildcard in the back end
     * @return string
     */
    public function generate()
    {
        if (TL_MODE == 'BE') {
            $objTemplate = new \BackendTemplate('be_wildcard');

            $objTemplate->wildcard = '### ŽEBŘÍČKY ###';
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
        $leagues = \LeagueModel::findAll();
        $tournaments = \TournamentModel::getTournaments();
        $teams = \TeamModel::findAll();

        $ranking = array();
        foreach ($teams as $team) {
            $ranking[$team->league][$team->coplayer][$team->pid] = $team->rank;
            $ranking[$team->league][$team->player][$team->pid] = $team->rank;

            if (isset($ranking[$team->league][$team->player]['all'])) {
                $ranking[$team->league][$team->coplayer]['all'] = 0;
            }
            if (isset($ranking[$team->league][$team->coplayer]['all'])) {
                $ranking[$team->league][$team->coplayer]['all'] = 0;
            }

            $ranking[$team->league][$team->coplayer]['all'] += $team->rank;
            $ranking[$team->league][$team->player]['all'] += $team->rank;
        }


        $this->Template->ranking = $ranking;
        $this->Template->leagues = $leagues;
        $this->Template->tournaments = $tournaments;

    }
}
