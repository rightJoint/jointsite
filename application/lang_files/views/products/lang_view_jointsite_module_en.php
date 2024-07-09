<?php
class lang_view_jointsite_module_en extends lang_view_products_jointsite_en
{
    function __construct()
    {
        parent::__construct();

        $this->head["description"] = $this->head["h1"].". ".$this->head["title"];

        $this->product_custom["p1"] = "Record include controller, model and views to handle records ".
            "in database tables. All core-branches, as well as Record merge into main.";
        $this->product_deploy["install"]["checkout-branch"] = "main";
        $this->product_deploy["install"]["example-text"] = "Clone repository and checkout branch ".
            "(<strong>".$this->product_deploy["install"]["checkout-branch"]."</strong>)";

        $this->product_config["p1"] = "All general settings of this app are by default <span class='ex-conf'>/__config</span>. ";
        $this->product_config["p2"] = "Database connection settings are by default <span class='ex-conf'>/__config/db_conn.php</span>. ";
        $this->product_migration["p1"] = "Queries to create test tables and insert into data in dir <span class='ex-conf'>/migrations</span>";
        $this->prod_test = array(
            "p1" => "Exec migration <span class='ex-conf'>2024-05-21_rj-test-records</span>. ".
                "<a href='".JOINT_SITE_EXEC_DIR."/test/records' title='check Record on test'>check how Record work on test</a>. ".
                "In this example realized three custom tables for music gallery.",
        );
    }
}