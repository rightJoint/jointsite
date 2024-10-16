<?php

namespace JointSite\Controllers;

use JointSite\Core\Records\RecordsController;

class Controller_Test extends \JointSite\Core\Records\RecordsController
{
    public $process_url = "/test/records";
    public $process_table = "migrations";

    function action_index()
    {
        $this->view->generate();
    }

    function action_records()
    {
        if($view_data = $this->model->pdoQuery("SHOW TABLES")){
            global $request;

            $tableName = null;
            if(isset($request["routes_ns"][3]) and $request["routes_ns"][3]!= null){
                $tableName = $request["routes_ns"][3];
            }elseif ($table_row = $view_data->fetch()){
                $tr_key = key($table_row);
                $tableName =  $table_row[$tr_key];
                //one more query cause fetch
                $view_data = $this->model->query("SHOW TABLES");
            }

            if($tableName){
                $this->process_url.="/".$tableName;
                $this->process_table = $tableName;
                $this->view->process_url = $this->process_url;
                $this->view->view_data = $view_data;
                $this->view->tableName = $tableName;
                $this->view_data = $this->view->printSelectTblPanel();
                $this->model->tableName = $tableName;
                $this->model->getRecordStructure();
                parent::action_index();
            }else{
                $this->logger->emergency("no tables in database", $this->logger->logger_context);
            }
        }else{
            $this->logger->emergency("cant find tables or database", $this->logger->logger_context);
        }

    }
}