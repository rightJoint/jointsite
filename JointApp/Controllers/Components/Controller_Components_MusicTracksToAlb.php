<?php


namespace JointApp\Controllers\Components;


use http\Exception\InvalidArgumentException;
use JointApp\Controllers\ModuleController;

class Controller_Components_MusicTracksToAlb extends ModuleController
{
    public string $processUri = '/siteman/musictrackstoalb';
    public string $moduleName = 'musictrackstoalb';

    public function loadBindComponents(): void
    {
        $this->bindComponents = array(
            'musicalb' => [],
            'musictracks' => [],
        );
    }

    public function loadLangController():string
    {
        parent::loadLangController();
        $name = 'LangFiles_'.$this->langNs.'_Controller_Components_MusicTracksToAlb';
        require_once $this->docRoot.'/JointApp/LangFiles/Controllers/Components/'.$name.'.php';
        return $name;
    }

    public function prepareListFields(): void
    {
        $this->listFields = array(
            'btnDetail' => array(
                'replaces' => ['track_id', 'album_id'],
                'format' => 'link',
                'url' => 'track_id=track_id&album_id=album_id',
            ),
            'btnEdit' => array(
                'replaces' => ['track_id', 'album_id'],
                'format' => 'link',
                'url' => 'track_id=track_id&album_id=album_id',
            ),
            'btnDelete' => array(
                'replaces' => ['track_id', 'album_id'],
                'format' => 'link',
                'url' => 'track_id=track_id&album_id=album_id',
            ),
            'track_name' => array(
                'format' => 'varchar',
            ),
            'albumName' => array(
                'format' => 'varchar',
            ),
            /*
            'track_id' => array(
                'format' => 'varchar',
            ),

            'album_id' => array(
                'format' => 'varchar',
            ),
            */
            'comment' => array(
                'format' => 'text',
            ),
            'sortDate' => array(
                'format' => 'date',
            ),
            'mActive' => array(
                'format' => 'tinyint',
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

    public function prepareSearchFields(): void
    {
        $this->searchFields = array(
            'track_name' => array(
                'format' => 'varchar',
                'sort' => 1,
                'search' => 1,
                'use_table_name' => 'musicTracks'
            ),
            'albumName' => array(
                'format' => 'varchar',
                'sort' => 1,
                'search' => 1,
                'use_table_name' => 'musicAlb'
            ),
            /*
            'track_id' => array(
                'format' => 'varchar',
            ),

            'album_id' => array(
                'format' => 'varchar',
            ),

            'comment' => array(
                'format' => 'text',
                'sort' => 1,
                'search' => 1,
            ),
            */
            'sortDate' => array(
                'format' => 'date',
                'sort' => 1,
                //'search' => 1,
            ),
            'mActive' => array(
                'format' => 'tinyint',
                'sort' => 1,
                'search' => 1,
            ),
            /*
            'created_by' => array(
                'format' => 'varchar',
            ),
            */
            'accAlias' => array(
                'format' => 'varchar',
                'sort' => 1,
                'search' => 1,
                'use_table_name' => 'users_dt'
            ),
        );
    }

    public function prepareEditFields(): void
    {
        $this->editFields = array(
            'track_id' => array(
                'pri' => 1,
                'format' => 'findSelect',
                'returnKey' => 'track_name',
                'callBack_uri' => $this->processUri.'/filltrackname',
                'curVal' => '',
                'findVal' => '',
            ),
            'album_id' => array(
                'pri' => 1,
                'format' => 'findSelect',
                'returnKey' => 'albName',
                'callBack_uri' => $this->processUri.'/fillalbname',
                'curVal' => '',
                'findVal' => '',
            ),
            'comment' => array(
                'format' => 'text',
                'curVal' => '',
            ),
            'sortDate' => array(
                'format' => 'date',
                'curVal' => '',
            ),
            'mActive' => array(
                'format' => 'tinyint',
                'curVal' => '',
            ),
            'created_by' => array(
                'format' => 'hidden',
                'curVal' => '',
            ),
            'created_alias' => array(
                'format' => 'varchar',
                'custom' => true,
                'readonly' => true,
                'curVal' => '',
            ),
        );
    }


}