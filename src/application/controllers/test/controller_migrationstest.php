<?php
class controller_migrationstest extends RecordsController
{
    public $process_url = JOINT_SITE_EXEC_DIR.JOINT_SITE_APP_REF."/test/migrationstest";

    function LoadModel_custom($action_name = null): string
    {
        require_once JOINT_SITE_REQUIRE_DIR."/application/models/migrations/model_migrations_log.php";
        require_once JOINT_SITE_REQUIRE_DIR."/application/models/migrations/model_migrations.php";

        $this->process_table = "migrations";
        return "model_migrations";
    }

    function action_checkConnectServerStatus()
    {
        $conn_status = $this->model->connect_database_status;
        if(!$this->model->connect_database_status){
            $this->view->view_data.= "check connect_database_status = fail<br>";
            if($this->model->check_database()){
                $this->view->view_data.= "set up connection = success<br>";
            }else
            {
                $this->view->view_data.= "unknown err: "."CREATE DATABASE ".$this->model->conn_db." CHARACTER SET utf8 COLLATE utf8_general_ci"."<br>";
            }
        }else{
            $this->view->view_data.= "connect_server_status = ok<br>";
        }

        if($conn_status){
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

    function action_migrationsList()
    {
        $process_migr_controller = new RecordsController("model_migrations",
            "View", "index");
        $process_migr_controller->process_url = JOINT_SITE_EXEC_DIR.JOINT_SITE_APP_REF."/test/migrationstest/migrationsList";;
        $process_migr_controller->records_process();
    }

    function action_migrationsLog()
    {
        $process_migr_controller = new RecordsController("model_migrations_log",
            "View", "index");
        $process_migr_controller->process_url = JOINT_SITE_EXEC_DIR.JOINT_SITE_APP_REF."/test/migrationstest/migrationsLog";;
        $process_migr_controller->records_process();
    }

    function action_execNewMigrations()
    {
        //echo "jjjjj";
        //exit;
        //$this->model->pdo_query("drop database ".$this->model->conn_db);
       // echo $this->model->log_message;
        //exit;
        $exec_res = $this->model->exec_new_migrations();
        if($exec_res["result"] == true){
            $this->view->view_data.= "execNewMigrations: Success, total count = ".$exec_res["count_total"];
        }elseif(($exec_res["count_total"] != $exec_res["count_success"]) and $exec_res["result"] == false){
            $this->view->view_data.= "execNewMigrations: Fail, total count = ".$exec_res["count_total"].
                "success count = ".$exec_res["count_success"]." <br> ";
        }else{
            $this->view->view_data.= "execNewMigrations: Fail, db conn problem".$exec_res["count_total"]." vs ".$exec_res["count_success"]." <br> ";
        }
        $this->view->generate();
    }


}