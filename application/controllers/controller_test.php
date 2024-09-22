<?php
require_once JOINT_SITE_REQUIRE_DIR."/application/core/RecordsController.php";
class controller_test extends RecordsController
{
    public $process_path = JOINT_SITE_EXEC_DIR.JOINT_SITE_APP_REF."/test";
    public $default_table = "migrations_log";

    function LoadModel_custom($action_name = null): string
    {
        if($action_name == "mirationstest"){
            require_once JOINT_SITE_REQUIRE_DIR."/application/models/migrations/model_migrations.php";
            require_once JOINT_SITE_REQUIRE_DIR."/application/models/migrations/model_migrations_log.php";
            return "model_migrations";
        }
        return parent::LoadModel_custom();
    }

    function action_testErr()
    {
        jointSite::throwErr("XXX", "xxx");
    }

    function action_index()
    {
        $this->records_process(JOINT_SITE_EXEC_DIR.JOINT_SITE_APP_REF."/test", "migrations_log", null);
    }

    function action_mirationstest()
    {
        define("PATH_TO_MIGRATIONS", JOINT_SITE_REQUIRE_DIR."/migrations");
        $migrations_model = new model_migrations();
        $migrations_model->getRecordStructure();
        //$migrations_model->glob_migration_files();
        //$commands = $migrations_model->parse_sql_file(PATH_TO_MIGRATIONS."/2024-05-21_17-55-12_test_music_tables.sql");
        //echo "<pre>";
        //print_r($commands);
        //exit;

        $exec_migr_result = $migrations_model->exec_migration(PATH_TO_MIGRATIONS."/2024-05-21_17-55-12_test_music_tables.sql");
        echo "<pre>";
        print_r($exec_migr_result);
        //'2024-05-20-migrations_tables.sql', '2024-05-21_17-55-12_test_music_tables.sql', '2024-05-21_17-58-07_test_music_records_tarcks.sql'





        //echo "action_mirationstest";
    }
}