<?php


namespace JointApp\Controllers\Components;


use JointApp\Controllers\ModuleController;

class Controller_Components_KipPlan extends Controller_Components_KipTasks
{

    public string $moduleName = 'kipplan';

    public string $processUri = '/siteman/kipplan';

    public function loadBindComponents(): void
    {
        $this->bindComponents = array(
            "kiptasks" => [],
            "kipnotes" => [],
        );
    }

    public function loadLangController():string
    {
        parent::loadLangController();
        $name = 'LangFiles_'.$this->langNs.'_Controller_Components_KipPlan';
        require_once $this->docRoot.'/JointApp/LangFiles/Controllers/Components/'.$name.'.php';
        return $name;
    }

    public function prepareSearchFields(): void
    {
    }

    public function prepareEditFields(): void
    {

    }

    public function prepareListFields(): void
    {
        $this->listFields = array(
            'ordernum' => array(
                'format' => 'varchar',
            ),
            'fulltitle' => array(
                'format' => 'varchar',
            ),
            'status' => array(
                'format' => 'varchar',
            ),
        );
    }

    public function prepareViewFields(): void
    {

    }
}