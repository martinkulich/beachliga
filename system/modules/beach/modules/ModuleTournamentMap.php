<?php

namespace Contao;

class ModuleTournamentMap extends \Module_dlh_googlemaps
{

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'module_tournament_map';

    public function compile()
    {
        parent::compile();

        $tournamentId = \Input::get('id');
        $this->Template->tournament = TournamentModel::findByPk($tournamentId);
        if($this->Template->tournament)
        {
            $this->Template->club = $this->Template->tournament->getRelated('club');
        }

    }

}
