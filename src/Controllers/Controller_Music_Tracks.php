<?php


namespace Src\Controllers;



use JointApp\Controllers\Records\RecordsController;

class Controller_Music_Tracks extends RecordsController
{
    public string $processUri = '/music/tracks';

    public string $moduleName = 'musictracks';

    const MUSIC_TRACKS_DIR = '/ddd-test/tracks';


    public function loadLangController():string
    {
        parent::loadLangController();
        $name = 'LangFiles_'.$this->langNs.'_Controllers_Music_Tracks';
        require_once $this->docRoot.'/LangFiles/Controllers/Music/'.$name.'.php';
        return $name;
    }


    public function prepareSearchFields(): void
    {
        $this->searchFields = array(
            'loadDate' => array(
                'format' => 'date',
                'sort' => 1,
                'sortOrder' => 'DESC',
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
            ),
            'sortDate' => array(
                'format' => 'date',
                'sort' => 1,
            ),
            'accAlias' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
                'use_table_name' => 'users_dt',
            ),
            'track_id' => array(
                'format' => 'varchar',
                'search' => 1,
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
            'accAlias' => array(
                'format' => 'varchar',
            ),
        );
    }
}