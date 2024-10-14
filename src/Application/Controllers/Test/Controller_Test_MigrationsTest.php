<?php

namespace JointSite\Controllers\Test;

use JointSite\Core\Records\RecordsController;

class Controller_Test_MigrationsTest extends RecordsController
{
    public $process_url = JOINT_SITE_APP_REF."/test/migrationstest";
    public $process_table = "migrations";

    function action_index()
    {
        $this->view->generate();
    }

    function action_checkConnectServerStatus()
    {
        if(!$this->model->connect_database_status){
            $this->view->view_data.= "check connect_database_status = fail<br>";
            if($this->model->check_database()){
                $this->view->view_data.= "set up connection = success<br>";
            }else
            {
                $this->view->view_data.= "unknown err: ".$this->model->log_message."<br>";
            }
        }else{
            $this->view->view_data.= "connect_server_status = ok<br>";
        }

        if($this->model->connect_database_status){
            $this->view->view_data.= "final connect_database_status = ok<br>";
        }else{
            $this->view->view_data.= "final connect_database_status = fail<br>";
        }

        $this->view->generate();
    }

    function action_createMigrationsTables()
    {
        if($this->model->checkMigrationsTables()){
            $this->view->view_data.= "migrations tables created";
        }else{
            $this->view->view_data.= "cant check migrations tables cause cant connect database<br>";
        }
        $this->view->generate();
    }

    function action_execNewMigrations()
    {

        //$this->model->pdo_query("drop database ".$this->model->conn_db);
        //echo $this->model->log_message;
        //exit;
        $exec_res = $this->model->exec_new_migrations();
        if($exec_res["result"] == true){
            $this->view->view_data.= "execNewMigrations: Success, total count = ".$exec_res["count_total"];
        }elseif(($exec_res["count_total"] != $exec_res["count_success"]) and $exec_res["result"] == false){
            $this->view->view_data.= "execNewMigrations: Fail, total count = ".$exec_res["count_total"].
                "success count = ".$exec_res["count_success"]." <br> ";
        }else{
            $this->view->view_data.= "execNewMigrations: Fail, db conn problem ".$exec_res["count_total"]." vs ".$exec_res["count_success"]." <br> ";
        }
        $this->view->generate();
    }


}