<?php

use jointSite\Core\Records\RecordsController;

class controller_migrationslist extends RecordsController
{
    public $process_url = JOINT_SITE_APP_REF."/test/migrationstest/migrationsList";
    function LoadModel_custom($action_name = null): string
    {
        require_once JOINT_SITE_REQUIRE_DIR."/application/models/migrations/model_migrations.php";
        $this->process_table = "migrations";
        return "model_migrations";
    }
}