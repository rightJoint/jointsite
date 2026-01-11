<?php


namespace JointApp\Controllers\Components;


use JointApp\Controllers\ModuleController;
use JointApp\JointAppQueryBuilder;

class Controller_Components_KipReport extends Controller_Components_KipTasks
{

    public string $moduleName = 'kipreport';

    public string $processUri = '/siteman/kipreport';

    private string $date_from = '';
    private string $date_to = '';

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
                'curVal' => $this->date_from,
            ),
            'date_to' => array(
                'format' => 'date',
                'search' => 1,
                'sort' => 0,
                'curVal' => $this->date_to,
            ),
        );
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


    public function updateModelRecordFromRequest():void
    {
        if(isset($this->requestParams['date_from'])){
            $this->date_from = $this->requestParams['date_from'];
        }else{
            $this->date_from = date('Y-m-d', strtotime(' - 7 days'));
        }
        if(isset($this->requestParams['date_to'])){
            $this->date_to = $this->requestParams['date_to'];
        }else{
            $this->date_to = date('Y-m-d');
        }
        $this->model->record['date_from']['curVal'] = $this->date_from;
        $this->model->record['date_to']['curVal'] = $this->date_to;
    }

    public function filterWhere():JointAppQueryBuilder
    {
        $qBuilder = new JointAppQueryBuilder();

        $qBuilder->where('created_date <="'.$this->date_to.' 23:59:59" and '.
            'created_date >= "'.$this->date_from.'"');
        return $qBuilder;
    }

    public function controllerFilterBody($bodyParams = []):void
    {
        if(isset($bodyParams['applyFilterRec'])){
            $this->applyFilterRecord = $bodyParams['applyFilterRec'];
        }
        if(isset($bodyParams['date_from'])){
            $this->date_from = $bodyParams['date_from'];
        }else{
            $this->date_from = date('Y-m-d', strtotime(' - 7 days'));
        }
        if(isset($bodyParams['date_to'])){
            $this->date_to = $bodyParams['date_to'];
        }else{
            $this->date_to = date('Y-m-d');
        }
    }

}