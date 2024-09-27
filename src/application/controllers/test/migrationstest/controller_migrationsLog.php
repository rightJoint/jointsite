<?php
class controller_migrationsLog extends RecordsController
{
    public $process_url = JOINT_SITE_EXEC_DIR.JOINT_SITE_APP_REF."/test/migrationstest/migrationsLog";
    function LoadModel_custom($action_name = null): string
    {
        require_once JOINT_SITE_REQUIRE_DIR."/application/models/migrations/model_migrations_log.php";
        $this->process_table = "migrations_log";
        return "model_migrations_log";
        //return parent::LoadModel_custom($action_name); // TODO: Change the autogenerated stub
    }

    function LoadView_custom($action_name = null): string
    {
        if($action_name == "detailview"){
            require_once JOINT_SITE_REQUIRE_DIR."/application/views/migrations/view_migrationLog_detail.php";
            return "view_migrationLog_detail";
        }
        return "";
    }
}