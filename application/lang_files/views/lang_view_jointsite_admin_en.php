<?php
class lang_view_jointsite_admin_en extends lang_view_products_jointsite_en
{
    function __construct()
    {
        parent::__construct();

        $this->head["description"] = $this->head["h1"].". ".$this->head["title"];

        $this->product_custom["p1"] = "Controller handle required models and view to possibility run admin at another url ".
            ", see <a href='#product-test'>test example.</a>";
        $this->product_custom["h3-2"] = $this->product_custom["h3-1"];
        $this->product_deploy["install"]["checkout-branch"] = "admin";

        $this->product_deploy["install"]["example-text"] = "clone repository and checkout branch ".
            "(<strong>".$this->product_deploy["install"]["checkout-branch"]."</strong>)";

        $this->product_config["p1"] = "By default admin config to run into another app at address <span class='ex-conf'>/mirror</span>. ".
            "To use admin as site, set up config the same below.";

        $this->product_config["p2"] = "As well to run as site we need to set up run dir in ".
            " в <span class='ex-conf'>index.php</span>";
        $this->product_config["example-text-2"] = "run app as site (index.php)";

        $this->product_config["mirror_dir"] = "";
        $this->product_config["mirror_base"] = "";

        $this->product_config["p3"] = "Admin menu at site set up on test address, to set up menu on address <span class='ex-conf'>/admin</span>, ".
            "write out <span class='ex-conf'>SiteView.php</span> in code function <span class='ex-conf'>print_admin_menu</span>";
        $this->product_config["example-text-3"] = "Set up admin menu address <span class='ex-conf'>/admin</span>";

        $this->product_config["p4"] = "Another admin directory settings are <span class='ex-conf'>/__config/admin_conf.php</span>. ";
        $this->product_config["p5"] = "By default admin set up at address <span class='ex-conf'>/test/phpmysqladmin</span>. ";
        $this->product_config["p6"] = "Admin users data store in dir <span class='ex-conf'>/__config/adminUsers.txt</span>, ".
            "Use login annd password to get in <span class='ex-conf'>admin</span>, ";
        $this->product_migration["p1"] = "To be able use migrations in admin, first migration ".
            "<span class='ex-conf'>/migrations/2024-05-20-migrations_tables.sql</span> to create table, needs to make ".
            "by hand. Its able at address <span class='ex-conf'>/admin/tables</span> or <span class='ex-conf'>/admin/sql</span>";
        $this->product_migration["p2"] = "Implemented functionality to edit and add queries to sql files, ".
            " monitoring migrations by logs.";
        $this->prod_test = array(
            "p1" => "Admin available at address <a href='".JOINT_SITE_EXEC_DIR."/admin'>".JOINT_SITE_EXEC_DIR."/admin</a>".
                " and test <a href='".JOINT_SITE_EXEC_DIR."/test/phpmysqladmin' title='check Admin at test'>".
                JOINT_SITE_EXEC_DIR."/test/phpmysqladmin</a>.",
        );
    }


}