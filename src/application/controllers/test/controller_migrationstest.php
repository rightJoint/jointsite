<?php
class controller_migrationstest extends RecordsController
{
    public $process_url = JOINT_SITE_EXEC_DIR.JOINT_SITE_APP_REF."/test/migrationstest";

    function LoadModel_custom($action_name = null): string
    {
        global $app_log;

        $load_model_custom_migrations_log = array(
            "try_name" => "model_migrations_log",
            "try_path" => JOINT_SITE_REQUIRE_DIR."/application/models/migrations/model_migrations_log.php",
            "loaded" => true,
            "custom" => true,
            "return_name" => false,
        );
        require_once $load_model_custom_migrations_log["try_path"];

        $app_log["load"]["model"][] = $load_model_custom_migrations_log;

        $load_model_custom_migrations = array(
            "try_name" => "model_migrations",
            "try_path" => JOINT_SITE_REQUIRE_DIR."/application/models/migrations/model_migrations.php",
            "loaded" => true,
            "custom" => true,
            "return_name" => "model_migrations",
        );
        require_once $load_model_custom_migrations["try_path"];
        $app_log["load"]["model"][] = $load_model_custom_migrations;

        $this->process_table = "migrations";
        return "model_migrations";
    }

    function action_checkConnectServerStatus()
    {
        $conn_status = $this->model->connect_database_status;
        if(!$this->model->connect_database_status){
            $this->view->view_data.= "check connect_database_status = fail<br>";
            if(!$this->model->connect_server_status){

                $this->view->view_data.= "connect_server_status = fail<br>";
            }else{
                $this->view->view_data.= "connect_server_status = ok<br>";
                $this->view->view_data.= "try create database<br>";
                if($this->model->query("CREATE DATABASE ".$this->model->conn_db." CHARACTER SET utf8 COLLATE utf8_general_ci")){
                    $conn_status = true;
                    $this->view->view_data.= "create database success<br>";
                }else{
                    $this->view->view_data.= "unknown err: "."CREATE DATABASE ".$this->model->conn_db." CHARACTER SET utf8 COLLATE utf8_general_ci"."<br>";
                }

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
        if($this->model->connect_database_status){

            $mirg_commands = $this->model->parse_sql_file(JOINT_SITE_REQUIRE_DIR."/migrations/2024-05-20-migrations_tables.sql");
            $this->model->pdo_query($mirg_commands[1]["query"]);
            $this->model->pdo_query($mirg_commands[1]["query"]);
            $this->view->view_data.= "migrations tables created";
        }else{
            $this->view->view_data.= "cant check migrations tables cause cant connect database<br>";
        }
        $this->view->generate();
    }

    function action_execNewMigrations()
    {
        $exec_res = $this->model->exec_new_migrations();
        if($exec_res["count_total"] == $exec_res["count_success"]){
            $this->view->view_data.= "execNewMigrations: Success, total count = ".$exec_res["count_total"];
        }else{
            $this->view->view_data.= "execNewMigrations: Fail, total count = ".$exec_res["count_total"].
                "success count = ".$exec_res["count_success"]." <br> ";
        }
        $this->view->generate();
    }
}