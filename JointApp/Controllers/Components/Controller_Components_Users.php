<?php


namespace JointApp\Controllers\Components;


use JointApp\Controllers\ModuleController;
use JointApp\Models\Components\Model_Components_UsersToGroups;
use JointApp\Views\Records\RecordListView;

class Controller_Components_Users extends ModuleController
{

    public string $moduleName = 'users';

    public string $processUri = '/siteman/users';

    public function loadBindComponents(): void
    {
        $this->bindComponents = array(
            "userstogroups" => array(
                "relationships" => array(
                    "user_id" => "user_id",
                ),
                'model' => 'JointApp\Models\Components\Model_Components_UsersToGroups',
                'controller' => 'JointApp\Controllers\Components\Controller_Components_UsersToGroups'
            ),
            "groups" => [],
        );
    }

    public function loadLangController():string
    {
        parent::loadLangController();
        $name = 'LangFiles_'.$this->langNs.'_Controller_Components_Users';
        require_once $this->docRoot.'/JointApp/LangFiles/Controllers/Components/'.$name.'.php';
        return $name;
    }

    public function prepareSearchFields(): void
    {
        $this->searchFields = array(
            'user_id' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
            ),
            'accLogin' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
            ),
            'accAlias' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
            ),
            /*'pw_hash' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
            ),
            'vldCode' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
            ),*/
            'regDate' => array(
                'format' => 'datetime',
                'search' => 1,
                'sort' => 1,
            ),
            'netWork' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
            ),
            'validDate' => array(
                'format' => 'datetime',
                'search' => 1,
                'sort' => 1,
            ),/*
            'photoLink' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
            ),*/
            'eMail' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
            ),
            'birthDay' => array(
                'format' => 'date',
                'search' => 1,
                'sort' => 1,
            ),
            'socProf' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
            ),
            'blackList' => array(
                'format' => 'tinyint',
                'search' => 1,
                'sort' => 1,
            ),
            'created_by' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
            ),
            'is_admin' => array(
                'format' => 'tinyint',
                'search' => 1,
                'sort' => 1,
            ),
            'send_ntf' => array(
                'format' => 'tinyint',
                'search' => 1,
                'sort' => 1,
            ),
            'pref_lang' => array(
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
                'replaces' => ['user_id'],
                'format' => 'link',
                'url' => 'user_id=user_id',
            ),
            'btnEdit' => array(
                'replaces' => ['user_id'],
                'format' => 'link',
                'url' => 'user_id=user_id',
            ),
            'btnDelete' => array(
                'replaces' => ['user_id'],
                'format' => 'link',
                'url' => 'user_id=user_id',
            ),
            'user_id' => array(
                'format' => 'varchar',
                'max_length' => 5,
            ),
            'accLogin' => array(
                'format' => 'varchar',
            ),
            'accAlias' => array(
                'format' => 'varchar',
            ),
            //'pw_hash' => array(
            //    'format' => 'varchar',
            //),
            //'vldCode' => array(
            //    'format' => 'varchar',
            //    'max_length' => 10,
            //),
            'regDate' => array(
                'format' => 'datetime',
            ),
            'netWork' => array(
                'format' => 'varchar',
            ),
            'validDate' => array(
                'format' => 'datetime',
            ),
            'photoLink' => array(
                'format' => 'varchar',
            ),
            'eMail' => array(
                'format' => 'varchar',
            ),
            'birthDay' => array(
                'format' => 'date',
            ),
            'socProf' => array(
                'format' => 'varchar',
            ),
            'blackList' => array(
                'format' => 'tinyint',
            ),
            //'created_by' => array(
            //    'format' => 'varchar',
            //),
            'created_user' => array(
                'format' => 'varchar',
            ),
            'is_admin' => array(
                'format' => 'tinyint',
            ),
            'send_ntf' => array(
                'format' => 'tinyint',
            ),
            'pref_lang' => array(
                'format' => 'varchar',
            ),
        );
    }

}