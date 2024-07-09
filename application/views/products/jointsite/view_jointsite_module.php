<?php
class view_jointsite_module extends View_Products_JointSite
{
    public $current_branch = "module";

    function LoadViewLang($request = null)
    {
        parent::LoadViewLang($request = null); // TODO: Change the autogenerated stub
        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR."/application/lang_files/views".
            "/products/lang_view_jointsite_module_".$_SESSION[JS_SAIK]["lang"].".php";
        return "lang_view_jointsite_module_".$_SESSION[JS_SAIK]["lang"];
    }

    function prod_about()
    {

    }

    function prod_deploy_server()
    {

    }

    function prod_deploy_migrations()
    {
        parent::prod_deploy_migrations(); // TODO: Change the autogenerated stub
        echo "<div class='example'>".
            "<div class='example-code'>".
            "CREATE DATABASE test_db CHARACTER SET utf8 COLLATE utf8_general_ci".
            "</div>".
            "<div class='example-text'>".
            "можно выполнить запрос для создания базы данных <span class='ex-conf'>test_db</span> в админке <span class='ex-conf'>/admin/sql</span>".
            "</div>".
            "</div>";

    }



    function print_prod_branches()
    {
        $this->print_branch("module");
        //parent::print_prod_branches(); // TODO: Change the autogenerated stub
    }

    function prod_deploy_config()
    {
        echo "<h3>".$this->lang_map->product_config["h3"]."</h3>".
            "<p>".
            $this->lang_map->product_config["p1"].
            "</p>";
        echo $this->prod_deploy_config_ex();
        echo "<p>".
            $this->lang_map->product_config["p3"].
            "</p>".
            "<div class='example'>".
            "<div class='example-code'>".
            "this->print_admin_menu('/admin')".
            "</div>".
            "<div class='example-text'>".
            $this->lang_map->product_config["example-text-3"].
            "</div>".
            "</div>";
        echo "<p>".
            $this->lang_map->product_config["p4"].
            "</p>".
            "<p>".
            $this->lang_map->product_config["p5"].
            "</p>".
            "<p>".
            $this->lang_map->product_config["p6"].
            "</p>";
    }
}