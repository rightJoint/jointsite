<?php
class view_jointsite_main extends View_Products_JointSite
{
    function LoadViewLang($request = null)
    {
        parent::LoadViewLang($request = null); // TODO: Change the autogenerated stub
        require_once JOINT_SITE_REQ_LANG."/views/lang_view_jointsite_main.php";
        return "lang_view_jointsite_main";
    }

    function prod_about()
    {

    }
    function prod_deploy_migrations(){

    }

    function prod_deploy_server()
    {

    }

    function print_prod_branches()
    {
        $this->print_branch("main");
    }

    function prod_deploy_config()
    {
        echo "<h3>".$this->lang_map->product_config["h3"]."</h3>".
            "<p>".
            $this->lang_map->product_config["p1"].
            "<p>".
            $this->lang_map->product_config["p2"].
            "</p>";
    }
}