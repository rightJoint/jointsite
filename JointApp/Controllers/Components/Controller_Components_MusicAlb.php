<?php


namespace JointApp\Controllers\Components;


use JointApp\Controllers\Controller;
use JointApp\Controllers\ModuleController;
use JointApp\Factories\ModelFactory;
use JointApp\Models\Components\Model_Components_MusicTracksToAlb;
use JointApp\Models\Components\Model_Components_User;
use JointApp\Models\Model_Pdo;
use JointApp\Views\Records\RecordListView;
use JointApp\Views\WebView;

class Controller_Components_MusicAlb extends ModuleController
{
    public string $processUri = '/siteman/musicalb';

    public string $moduleName = 'musicalb';

    const MUSIC_ALB_DIR = '/ddd-test/albCovers';

    public function loadBindComponents(): void
    {
        $this->bindComponents = array(
            'musictrackstoalb' => array(
                'relationships' => array(
                    'album_id' => 'album_id',
                ),
                'model' => 'JointApp\Models\Components\Model_Components_MusicTracksToAlb',
                'controller' => 'JointApp\Controllers\Components\Controller_Components_MusicTracksToAlb',
            ),
            'musictracks' => [],
        );
    }

    public function loadLangController():string
    {
        parent::loadLangController();
        $name = 'LangFiles_'.$this->langNs.'_Controller_Components_MusicAlb';
        require_once $this->docRoot.'/JointApp/LangFiles/Controllers/Components/'.$name.'.php';
        return $name;
    }

    public function prepareListFields(): void
    {
        $this->listFields = array(
            'btnDetail' => array(
                'replaces' => ['album_id'],
                'format' => 'link',
                'url' => 'album_id=album_id',
            ),
            'btnEdit' => array(
                'replaces' => ['album_id'],
                'format' => 'link',
                'url' => 'album_id=album_id',
            ),
            'btnDelete' => array(
                'replaces' => ['album_id'],
                'format' => 'link',
                'url' => 'album_id=album_id',
            ),
            'album_id' => array(
                'format' => 'hidden',
            ),
            'albumName' => array(
                'format' => 'varchar',
            ),
            'albumAlias' => array(
                'format' => 'varchar',
            ),
            /*
            'metaDescr' => array(
                'format' => 'varchar',
            ),
            */
            'dateOfCr' => array(
                'format' => 'date',
            ),
            'albumImg' => array(
                'format' => 'file',
                'file_options' => array(
                    "load_dir" => self::MUSIC_ALB_DIR,
                    "file_type" => "img",
                ),
            ),
            'refreshDate' => array(
                'format' => 'date',
            ),
            'activeFlag' => array(
                'format' => 'tinyint',
            ),
            'robIndex' => array(
                'format' => 'tinyint',
            ),
            'accAlias' => array(
                'format' => 'varchar',
            ),
        );
    }

    public function prepareEditFields(): void
    {
        $this->editFields = array(
            'album_id' => array(
                'pri' => 1,
                'format' => 'varchar',
                'curVal' => '',
                'readonly' => true,
            ),
            'albumName' => array(
                'format' => 'varchar',
                'curVal' => '',
                'accept' => '/.{1,}/'
            ),
            'albumAlias' => array(
                'format' => 'varchar',
                'curVal' => '',
                'accept' => '/.{1,}/'
            ),
            'metaDescr' => array(
                'format' => 'varchar',
                'curVal' => '',
            ),
            'dateOfCr' => array(
                'format' => 'date',
                'curVal' => '',
            ),
            'albumImg' => array(
                'format' => 'file',
                'file_options' => array(
                    "load_dir" => self::MUSIC_ALB_DIR,
                    'file_type' => 'img',
                    'accept' => '.jpg, .jpeg, .bmp, .git, .png',
                    'button' => true,
                ),
                'with_name' => 'GUID',
                'curVal' => '',
            ),
            'activeFlag' => array(
                'format' => 'tinyint',
                'curVal' => '',
            ),
            'refreshDate' => array(
                'format' => 'date',
                'curVal' => '',
            ),
            'robIndex' => array(
                'format' => 'tinyint',
                'curVal' => '',
            ),
            'created_by' => array(
                'format' => 'hidden',
                'curVal' => '',
            ),
            'accAlias' => array(
                'format' => 'varchar',
                'curVal' => '',
                'readonly' => 1,
            ),
        );
    }

    public function prepareSearchFields(): void
    {
        $this->searchFields = array(
            'album_id' => array(
                'format' => 'hidden',
                'sort' => 1,
                'search' => 1,
            ),
            'albumName' => array(
                'format' => 'varchar',
                'sort' => 1,
                'search' => 1,
            ),
            'albumAlias' => array(
                'format' => 'varchar',
                'sort' => 1,
                'search' => 1,
            ),
            'accAlias' => array(
                'format' => 'varchar',
                'sort' => 1,
                'search' => 1,
                'use_table_name' => 'users_dt'
            ),
            'dateOfCr' => array(
                'format' => 'date',
                'sort' => 1,
                'search' => 1,
            ),
            'refreshDate' => array(
                'format' => 'date',
                'sort' => 1,
                'search' => 1,
            ),
            /*
            'metaDescr' => array(
                'format' => 'varchar',
                'sort' => 1,
                'search' => 1,
            ),
            */

            'activeFlag' => array(
                'format' => 'tinyint',
                'sort' => 1,
                'search' => 1,
            ),

            'robIndex' => array(
                'format' => 'tinyint',
                'sort' => 1,
                'search' => 1,
            ),
        );
    }

    public function prepareViewFields(): void
    {
        $this->viewFields = array(
            'album_id' => array(
                'format' => 'varchar',
                'readonly' => 1,
            ),
            'albumName' => array(
                'format' => 'varchar',
                'readonly' => 1,
            ),
            'albumAlias' => array(
                'format' => 'varchar',
                'readonly' => 1,
            ),
            'metaDescr' => array(
                'format' => 'varchar',
                'readonly' => 1,
            ),
            'dateOfCr' => array(
                'format' => 'date',
                'readonly' => 1,
            ),
            'albumImg' => array(
                'format' => 'file',
                'file_options' => array(
                    'accept' => '.jpg, .jpeg, .bmp, .git, .png',
                    'load_dir' => self::MUSIC_ALB_DIR,
                    'replaces' => ['albumImg'],
                    'file_type' => 'img',
                    'button' => false,
                ),
                'readonly' => 1,
            ),
            'activeFlag' => array(
                'format' => 'tinyint',
                'readonly' => 1,
            ),
            'refreshDate' => array(
                'format' => 'date',
                'readonly' => 1,
            ),
            'robIndex' => array(
                'format' => 'tinyint',
                'readonly' => 1,
            ),
            'created_by' => array(
                'format' => 'varchar',
                'readonly' => 1,
            ),
        );
    }

    public function prepareViewParams(): void
    {
        parent::prepareViewParams(); // TODO: Change the autogenerated stub
        if($this->view->type == 'new'){
            $this->view->editFields['dateOfCr']['curVal'] = date('Y-m-d');
        }
    }
}