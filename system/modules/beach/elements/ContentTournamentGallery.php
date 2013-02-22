<?php

namespace Contao;

use Contao\TournamentModel;

class ContentTournamentGallery extends \ContentGallery
{
    /**
     * Return if there are no files
     * @return string
     */
    public function generate()
    {

        $tournamentId = \Input::get('id');
        $tournament = TournamentModel::findByPk($tournamentId);
        $this->multiSRC = deserialize($tournament->gallery);
        // Return if there are no files
        if (!is_array($this->multiSRC) || empty($this->multiSRC)) {
            return '';
        }
        // Check for version 3 format
        if (!is_numeric($this->multiSRC[0])) {
            return '<p class="error">' . $GLOBALS['TL_LANG']['ERR']['version2format'] . '</p>';
        }

        // Get the file entries from the database
        $this->objFiles = \FilesModel::findMultipleByIds($this->multiSRC);
        if ($this->objFiles === null) {
            return '';
        }

        return parent::generate();
    }


    /**
     * Generate the content element
     */
    protected function compile()
    {
        $this->sortBy = 'date_asc';
        $this->perRow = 3;
        $this->fullsize = true;
        $this->size = serialize(array(
            260,
            160,
            'center_center',
        ));
        $this->imagemargin = serialize(array(
            'bottom'=>5,
            'left'=>5,
            'right'=>5,
            'top'=>5,
            'unit'=>'px',
        ));
        parent::compile();
    }
}
