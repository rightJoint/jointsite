<?php


namespace JointApp\Controllers\Components;


use JointApp\Controllers\ModuleController;

class Controller_Components_KipNotes extends ModuleController
{

    public string $moduleName = 'kipnotes';

    public string $processUri = '/siteman/kipnotes';

    public function loadBindComponents(): void
    {
        $this->bindComponents = array(
            "kiptasks" => [],
            "kipparticipators" => array(
                "relationships" => array(
                    "id" => "noteid",
                ),
                'model' => 'JointApp\Models\Components\Model_Components_KipParticipators',
                'controller' => 'JointApp\Controllers\Components\Controller_Components_KipParticipators'
            ),
        );
    }

    public function loadLangController():string
    {
        parent::loadLangController();
        $name = 'LangFiles_'.$this->langNs.'_Controller_Components_KipNotes';
        require_once $this->docRoot.'/JointApp/LangFiles/Controllers/Components/'.$name.'.php';
        return $name;
    }

    public function prepareListFields(): void
    {
        $this->listFields = array(
            'btnDetail' => array(
                'replaces' => ['id'],
                'format' => 'link',
                'url' => 'id=id',
            ),
            'btnEdit' => array(
                'replaces' => ['id'],
                'format' => 'link',
                'url' => 'id=id',
            ),
            'btnDelete' => array(
                'replaces' => ['id'],
                'format' => 'link',
                'url' => 'id=id',
            ),
            'id' => array(
                'format' => 'hidden',
            ),
            'title' => array(
                'format' => 'varchar',
            ),
            'created_date' => array(
                'format' => 'date',
            ),
            'created_by' => array(
                'format' => 'hidden',
            ),
            'created_name' => array(
                'format' => 'varchar',
            ),
            'descr' => array(
                'format' => 'hidden',
                'max_length' => 10,
            ),
        );
    }

    public function prepareEditFields(): void
    {
        $this->editFields = array(
            'id' => array(
                'pri' => 1,
                'format' => 'hidden',
                'curVal' => '',
            ),
            'title' => array(
                'format' => 'varchar',
                'curVal' => '',
            ),
            'descr' => array(
                'format' => 'tinymce',
                'id' => 'descr',
                'curVal' => '',
                'style' => array(
                    'class' => 'wd100',
                ),
            ),
            'created_date' => array(
                'format' => 'varchar',
                'curVal' => '',
            ),
            'created_by' => array(
                'format' => 'hidden',
                'curVal' => '',
            ),
            'taskid' => array(
                'format' => 'hidden',
                'curVal' => '',
                /*'format' => 'select',
                'filling' => $this->fillKipPriority(),*/
            ),
            'created_name' => array(
                'format' => 'varchar',
                'curVal' => '',
                /*'format' => 'select',
                'filling' => $this->fillKipTaskStatus(),*/
            ),
            'tasktitle' => array(
                'format' => 'varchar',
                'curVal' => '',
                /*'format' => 'select',
                'filling' => $this->fillKipTaskStatus(),*/
            ),
        );
    }

    public function prepareSearchFields(): void
    {
        $this->searchFields = array(
            'created_date' => array(
                'format' => 'varchar',
                'search' => 0,
                'sort' => 1,
                'sortOrder' => 'DESC',
            ),
            'title' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
            ),
        );

    }

    public function updateEditFieldsFromRecord():bool
    {
        parent::updateEditFieldsFromRecord();

        if(empty($this->editFields['created_date']['curVal'])){
            $this->editFields['created_date']['curVal'] = date('Y-m-d H:i:s');
            $this->editFields['title']['curVal'] = 'Работы';
            $this->editFields['created_name']['format'] = 'hidden';
        }

        return 1;
    }
}