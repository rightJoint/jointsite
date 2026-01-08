<?php


namespace JointApp\Controllers\Components;


use JointApp\Controllers\ModuleController;
use JointApp\Models\Components\Model_Components_KipTasks;
use JointApp\Views\Records\RecordListView;

class Controller_Components_KipParticipators extends ModuleController
{

    public string $moduleName = 'kipparticipators';

    public string $processUri = '/siteman/kipparticipators';

    public function loadBindComponents(): void
    {
        $this->bindComponents = array(
            "kipnotes" => array(
                "relationships" => array(
                    "id" => "taskid",
                ),
                'model' => 'JointApp\Models\Components\Model_Components_KipNotes',
                'controller' => 'JointApp\Controllers\Components\Controller_Components_KipNotes'
            ),
        );
    }

    public function loadLangController():string
    {
        parent::loadLangController();
        $name = 'LangFiles_'.$this->langNs.'_Controller_Components_KipParticipators';
        require_once $this->docRoot.'/JointApp/LangFiles/Controllers/Components/'.$name.'.php';
        return $name;
    }
/*
    public function prepareSearchFields(): void
    {
        $this->searchFields = array(
            'object' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
            ),
            'system' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
            ),
            'subsystem' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
            ),
            'tasktype' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
            ),
            'created_date' => array(
                'format' => 'varchar',
                'search' => 0,
                'sort' => 1,
            ),
        );

    }*/

    public function prepareEditFields(): void
    {
        $this->editFields = array(
            'noteid' => array(
                'pri' => 1,
                'format' => 'varchar',
                'curVal' => '',
            ),
            'participator' => array(
                'pri' => 1,
                'format' => 'select',
                'filling' => $this->fillKipParticipators(),
            ),
        );
    }

    public function prepareListFields(): void
    {
        $this->listFields = array(
            'btnDelete' => array(
                'replaces' => ['noteid', 'participator'],
                'format' => 'link',
                'url' => 'noteid=noteid&participator=participator',
            ),
            'noteid' => array(
                'format' => 'hidden',
            ),
            'participator' => array(
                'format' => 'select',
                'filling' => $this->fillKipParticipators(),
            ),
        );
    }

    public function fillKipParticipators():array
    {
        $return = array(
            'electric' => 'электрик',
            'mechanic' => 'механик',
            'technology' => 'технолог',
            'laboratory' => 'лаборатория',
            'okt' => 'окт',
            'shift' => 'сменный',
            'energostroy' => 'энергострой',
            'ilyusha' => 'Ильюша',
        );
        return $return;

    }
}