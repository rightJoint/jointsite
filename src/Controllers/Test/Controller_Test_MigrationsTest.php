<?php

namespace Src\Controllers\Test;

use JointApp\Controllers\Records\RecordsController;


class Controller_Test_MigrationsTest extends RecordsController
{
    public $process_url = "/test/migrations";
    public $process_table = "migrations";

    function action_index()
    {

    }

    function checkConnectServerStatus()
    {

        $contentBefore = '';
        if(!$this->model->connect_database_status){
            $contentBefore.='check connect_database_status = fail<br>';
            if($this->model->checkDatabase()){
                $contentBefore.='set up connection = success<br>';
            }else
            {
                $contentBefore.='unknown err: '.$this->model->log_message;
            }
        }else{
            $contentBefore.='connect_server_status = ok<br>';
        }

        if($this->model->connect_database_status){
            $contentBefore.='final connect_database_status = ok';
        }else{
            $contentBefore.='final connect_database_status = fail';
        }
        $this->view->putPageContentBefore($contentBefore);
    }

    function createMigrationsTables()
    {
        if($this->model->checkMigrationsTables()){
            $this->view->putPageContentBefore('migrations tables created');
        }else{
            $this->view->putPageContentBefore('cant check migrations tables cause cant connect database');
        }
    }

    function execNewMigrations()
    {

        //$this->model->pdoQuery("drop database ".$this->model->conn_db);
        //echo $this->model->log_message;
        //exit;
        $exec_res = $this->model->exec_new_migrations();
        if($exec_res["result"] == true){
            $this->view->putPageContentBefore('execNewMigrations: Success, total count = '.$exec_res['count_total']);
        }elseif(($exec_res["count_total"] != $exec_res["count_success"]) and $exec_res["result"] == false){
            $this->view->putPageContentBefore('execNewMigrations: Fail, total count = '.$exec_res['count_total'].
                'success count = '.$exec_res['count_success']);
        }else{
            $this->view->putPageContentBefore('execNewMigrations: Fail, db conn problem '.$exec_res['count_total'].' vs '.$exec_res['count_success']);
        }
    }


}