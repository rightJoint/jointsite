<?php


namespace Src\Controllers;



use JointApp\Controllers\Records\RecordsController;

class Controller_Music_Alb extends RecordsController
{
    public string $processUri = '/music/albums';

    public string $moduleName = 'musicAlb';

    const MUSIC_ALB_DIR = '/ddd-test/albCovers';

    public function loadLangController():string
    {
        parent::loadLangController();
        $name = 'LangFiles_'.$this->langNs.'_Controllers_Music_Alb';
        require_once $this->docRoot.'/LangFiles/Controllers/Music/'.$name.'.php';
        return $name;
    }

    public function prepareListFields(): void
    {
        $this->listFields = array(
            'album_id' => array(
                'format' => 'hidden',
            ),
            'albumName' => array(
                'format' => 'varchar',
            ),
            'albumAlias' => array(
                'format' => 'varchar',
            ),
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
            'dateOfCr' => array(
                'format' => 'date',
                'sort' => 1,
            ),
        );
    }
}