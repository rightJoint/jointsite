<?php


namespace JointApp\Controllers\Components;


use JointApp\Controllers\ModuleController;

class Controller_Components_MusicTracks extends ModuleController
{
    public string $processUri = '/siteman/musictracks';

    public string $moduleName = 'musictracks';

    public function loadBindComponents(): void
    {
        $this->bindComponents = array(
            "musicalb" => [],
            "musictrackstoalb" => [],
        );
    }

    public function loadLangController():string
    {
        parent::loadLangController();
        $name = 'LangFiles_'.$this->langNs.'_Controller_Components_MusicTracks';
        require_once $this->docRoot.'/JointApp/LangFiles/Controllers/Components/'.$name.'.php';
        return $name;
    }

    public function prepareSearchFields(): void
    {
        $this->searchFields = array(
            'track_id' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
            ),
            'track_name' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
            ),
            'track_artist' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
            ),
            'track_file' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
            ),
            'loadDate' => array(
                'format' => 'date',
                'search' => 1,
                'sort' => 1,
            ),
            'sortDate' => array(
                'format' => 'date',
                'search' => 1,
                'sort' => 1,
            ),
            'created_by' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
            ),
        );
    }

    public function prepareListFields(): void
    {
        $this->listFields = array(
            'btnDetail' => array(
                'replaces' => ['track_id'],
                'format' => 'link',
                'url' => 'track_id=track_id',
            ),
            'btnEdit' => array(
                'replaces' => ['track_id'],
                'format' => 'link',
                'url' => 'track_id=track_id',
            ),
            'btnDelete' => array(
                'replaces' => ['track_id'],
                'format' => 'link',
                'url' => 'track_id=track_id',
            ),
            'track_id' => array(
                'format' => 'varchar',
            ),
            'track_name' => array(
                'format' => 'varchar',
            ),
            'track_artist' => array(
                'format' => 'varchar',
            ),
            'track_file' => array(
                'format' => 'varchar',
            ),
            'loadDate' => array(
                'format' => 'date',
            ),
            'sortDate' => array(
                'format' => 'date',
            ),
            'created_by' => array(
                'format' => 'varchar',
            ),
        );
    }


}