<?php
require_once JOINT_SITE_REQUIRE_DIR."/application/core/RecordsController.php";

define("PATH_TO_MIGRATIONS", JOINT_SITE_REQUIRE_DIR."/migrations");

class controller_test extends RecordsController
{
    public $process_path = JOINT_SITE_EXEC_DIR.JOINT_SITE_APP_REF."/test";
    public $default_table = "migrations_log";

    function action_index()
    {
        global $app_log;
        //echo "action-index";

        //echo "<pre>";
        //print_r($app_log);
        //exit;
        if($this->records_process(JOINT_SITE_EXEC_DIR.JOINT_SITE_APP_REF."/test", "migrations_log", null))
        {
           // echo "process-ok";
        }else{
            //echo "process-fail";
        }
    }

    function action_mirationstest()
    {
        //$migrations_model = new model_migrations();
        //$migrations_model->connect_db();
        //if

        exit;
        $new_mirgation_test = new model_migrations();
        $new_mirgation_test->getRecordStructure();

        $test_migration_name = $new_mirgation_test->createGUID();
        //$new_mirgation_test->recordStructureFields->record["migration_log_id"]["curVal"]=$new_mirgation_test->createGUID();
        $new_mirgation_test->recordStructureFields->record["migration_name"]["curVal"] = $test_migration_name;
        $new_mirgation_test->recordStructureFields->record["try_date"]["curVal"] = date("Y-m-d H:i:s");

        //$cmd_1_text = "insert into migrations_log ".
        //    "values migration_log_id = 'wwww', ".
        //    "migration_name = 'test_migration_1', ".
        //    "try_date = '".date("Y-m-d H:i:s")."', ".
        //    "add_dat = '".date("Y-m-d H:i:s")."'";


        $cmd_1_text = "insert into migrations_log (migration_log_id, migration_name, try_date, add_dat) ".
            "values ('wwww', 'test_migration_1', '".date("Y-m-d H:i:s")."', ".date("Y-m-d H:i:s").")";

        if($new_mirgation_test->insertMigration(array("cmd_1" => $cmd_1_text))){
            //echo "insertMigration_ok";
        }else{
            //echo "insertMigration_fail: ".$new_mirgation_test->log_message;
        }

        $new_mirgation_test->copyRecord();
        $cmd_1_text = "update migrations_log set migration_log_id='1111'";
        $new_mirgation_test->recordStructureFields->record["try_date"]["curVal"] = date("Y-m-d H:i:s");
        if($new_mirgation_test->updateMigration(array("cmd_1" => $cmd_1_text))){
            echo "updateMigration_ok: ".$new_mirgation_test->log_message;
        }else{
            echo "updateMigration_fail: ".$new_mirgation_test->log_message;
        }

    }
}