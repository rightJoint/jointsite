<?php


namespace JointApp\Controllers\Components;


use JointApp\Controllers\ModuleController;

class Controller_Components_MusicTracks extends ModuleController
{
    public string $processUri = '/siteman/musictracks';

    public string $moduleName = 'musictracks';

    const MUSIC_TRACKS_DIR = '/musicData/tracklist';

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

    public function prepareEditFields(): void
    {
        $this->editFields = array(
            'track_id' => array(
                'pri' => 1,
                'format' => 'varchar',
                'curVal' => '',
                'readonly' => true,
            ),
            'track_name' => array(
                'format' => 'varchar',
                'curVal' => '',
                'accept' => '/.{1,}/'
            ),
            'track_artist' => array(
                'format' => 'varchar',
                'curVal' => '',
                'accept' => '/.{1,}/'
            ),
            'track_file' => array(
                "format" => "file",
                "fieldAliases" => array(
                    "en" => "play file",
                    "rus" => "Файл мелодии",
                ),
                "file_options" => array(
                    "load_dir" => self::MUSIC_TRACKS_DIR,
                    //"file_type" => "img",
                    "accept" => ".mp3",
                ),

                "with_name" => "GUID",
                'curVal' => '',
                /*
                'format' => 'varchar',
                'curVal' => '',
                */
            ),
            'loadDate' => array(
                'format' => 'date',
                'curVal' => '',
                'readonly' => true,
            ),
            'sortDate' => array(
                'format' => 'date',
                'curVal' => '',
                'accept' => '/.{1,}/'
            ),
            'created_by' => array(
                'format' => 'hidden',
                'curVal' => '',
                'readonly' => true,
            ),
            'created_alias' => array(
                'format' => 'varchar',
                'readonly' => true,
                'curVal' => '',
            ),
        );

        if($this->view->type == 'new'){
            $this->editFields['loadDate']['curVal'] = date('Y-m-d');
            $this->editFields['sortDate']['curVal'] = date('Y-m-d');
        }
    }

}