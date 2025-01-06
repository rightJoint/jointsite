<?php


namespace JointApp\Controllers\Components;


use JointApp\Controllers\ModuleController;

class Controller_Components_MusicTracks extends ModuleController
{
    public string $processUri = '/siteman/musictracks';

    public string $moduleName = 'musictracks';

    const MUSIC_TRACKS_DIR = '/userdata/music/tracks';

    public function loadBindComponents(): void
    {
        $this->bindComponents = array(
            'musicalb' => [],
            'musictrackstoalb' => array(
                'relationships' => array(
                    'track_id' => 'track_id',
                ),
                'model' => 'JointApp\Models\Components\Model_Components_MusicTracksToAlb',
                'controller' => 'JointApp\Controllers\Components\Controller_Components_MusicTracksToAlb',
            ),
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
            'loadDate' => array(
                'format' => 'date',
                'search' => 1,
                'sort' => 1,
                'sortOrder' => 'DESC',
            ),
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
            'sortDate' => array(
                'format' => 'date',
                'search' => 1,
                'sort' => 1,
            ),
            /*
            'created_by' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
            ),
            */
            'accAlias' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
                'use_table_name' => 'users_dt',
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
            /*
            'created_by' => array(
                'format' => 'varchar',
            ),
            */
            'accAlias' => array(
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
                "file_options" => array(
                    "load_dir" => self::MUSIC_TRACKS_DIR,
                    "accept" => ".mp3",
                    'button' => true,
                ),
                "with_name" => "GUID",
                'curVal' => '',
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
                'format' => 'varchar',
                'curVal' => '',
                'readonly' => true,
            ),
            'created_alias' => array(
                'format' => 'varchar',
                'readonly' => true,
                'curVal' => '',
            ),
        );
    }

    public function prepareViewParams(): void
    {
        parent::prepareViewParams(); // TODO: Change the autogenerated stub
        if($this->view->type == 'new'){
            $this->view->editFields['loadDate']['curVal'] = date('Y-m-d');
            $this->view->editFields['sortDate']['curVal'] = date('Y-m-d');
        }
    }

    public function prepareViewFields(): void
    {
        $this->viewFields = array(
            'track_id' => array(
                'format' => 'varchar',
                'readonly' => true,
            ),
            'track_name' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'track_artist' => array(
                'format' => 'varchar',
                'readonly' => true,
            ),
            'track_file' => array(
                'format' => 'file',
                'readonly' => true,
                'file_options' => array(
                    'accept' => 'mp3',
                    'load_dir' => self::MUSIC_TRACKS_DIR.'/track_file',
                    'replaces' => ['track_file'],
                    'button' => false,
                ),
            ),
            'loadDate' => array(
                'format' => 'date',
                'readonly' => true,
            ),
            'sortDate' => array(
                'format' => 'date',
                'readonly' => true,
            ),
            'created_by' => array(
                'format' => 'varchar',
                'readonly' => true,
            ),
            'created_alias' => array(
                'format' => 'varchar',
                'readonly' => true,
            ),
        );
    }

}