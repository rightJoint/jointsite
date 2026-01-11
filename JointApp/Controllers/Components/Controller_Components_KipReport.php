<?php


namespace JointApp\Controllers\Components;


use JointApp\Controllers\ModuleController;
use JointApp\JointAppQueryBuilder;

class Controller_Components_KipReport extends Controller_Components_KipTasks
{

    public string $moduleName = 'kipreport';

    public string $processUri = '/siteman/kipreport';

    public function loadBindComponents(): void
    {
        $this->bindComponents = array(
            "kipplan" => [],
            "kiptasks" => [],
            "kipnotes" => [],
        );
    }

    public function loadLangController():string
    {
        parent::loadLangController();
        $name = 'LangFiles_'.$this->langNs.'_Controller_Components_KipReport';
        require_once $this->docRoot.'/JointApp/LangFiles/Controllers/Components/'.$name.'.php';
        return $name;
    }

    public function prepareSearchFields(): void
    {
        $this->searchFields = array(
            'date_from' => array(
                'format' => 'date',
                'search' => 1,
                'sort' => 0,
            ),
            'date_to' => array(
                'format' => 'date',
                'search' => 1,
                'sort' => 0,
            ),
        );
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

    public function getListRecords():array
    {

        $qBuilderCount = new JointAppQueryBuilder();

        $qBuilderList = clone ($qBuilderCount);
        $qBuilderCount
            ->order('')
            ->limit('');

        return array(
            'count' => $this->model->countRecords($qBuilderCount),
            'list' => $this->model->listRecords($qBuilderList),
        );
    }

    public function controllerFilterBody($bodyParams = []):void
    {
        if(isset($bodyParams['applyFilterRec'])){
            $this->applyFilterRecord = $bodyParams['applyFilterRec'];
        }
    }
}