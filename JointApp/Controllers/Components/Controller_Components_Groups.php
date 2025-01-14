<?php


namespace JointApp\Controllers\Components;


use JointApp\Controllers\ModuleController;
use JointApp\Models\Components\Model_Components_UsersToGroups;
use JointApp\Views\Records\RecordListView;

class Controller_Components_Groups extends ModuleController
{

    public string $moduleName = 'groups';

    public string $processUri = '/siteman/groups';

    public function loadBindComponents(): void
    {
        $this->bindComponents = array(
            "userstogroups" => array(
                "relationships" => array(
                    "user_id" => "user_id",
                ),
            ),
            "users" => [],
        );
    }

    public function loadLangController():string
    {
        parent::loadLangController();
        $name = 'LangFiles_'.$this->langNs.'_Controller_Components_Groups';
        require_once $this->docRoot.'/JointApp/LangFiles/Controllers/Components/'.$name.'.php';
        return $name;
    }

    public function prepareEditFields(): void
    {
        $this->editFields = array(
            'group_id' => array(
                'format' => 'varchar',
                'curVal'=>'',
                'pri'=>1,
                'readonly' => true,
            ),
            'groupAlias_en' => array(
                'format' => 'varchar',
                'curVal' => '',
                'accept' => '/.{1,}/'
            ),
            'groupAlias_ru' => array(
                'format' => 'varchar',
                'curVal' => '',
                'accept' => '/.{1,}/'
            ),
            'activeFlag' => array(
                'format' => 'tinyint',
                'curVal' => false,
            ),
            'created_by' => array(
                'format' => 'hidden',
                'curVal' => '',
                'readonly' => true,
            ),
            'createdUser' => array(
                'format' => 'varchar',
                'curVal' => '',
                'readonly' => true,
            )

        );
    }

    public function prepareSearchFields(): void
    {
        $this->searchFields = array(
            'group_id' => array(
                'search' => 1,
                'sort' => 1,
                'format' => 'varchar',
            ),
            'groupAlias_en' => array(
                'search' => 1,
                'sort' => 1,
                'format' => 'varchar',
            ),
            'groupAlias_ru' => array(
                'search' => 1,
                'sort' => 1,
                'format' => 'varchar',
            ),
            'activeFlag' => array(
                'search' => 1,
                'sort' => 1,
                'format' => 'tinyint',
            ),

            'created_by' => array(
                'search' => 1,
                'sort' => 1,
                'format' => 'varchar',
            ),
            /*
            'createdUser' => array(
                'search' => 1,
                'sort' => 1,
                'format' => 'varchar',
            ),
            */
        );
    }

    public function prepareListFields(): void
    {
        $this->prepareListButtons();
        $this->listFields['group_id'] = ['format' => 'varchar'];
        $this->listFields['groupAlias_en'] = ['format' => 'varchar'];
        $this->listFields['groupAlias_ru'] = ['format' => 'varchar'];
        $this->listFields['activeFlag'] = ['format' => 'tinyint'];
        $this->listFields['created_by'] = ['format' => 'varchar'];
    }


}