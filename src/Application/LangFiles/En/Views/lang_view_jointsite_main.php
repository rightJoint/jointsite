<?php
class lang_view_jointsite_main extends lang_view_products_jointsite
{
    function __construct()
    {
        parent::__construct();

        $this->head["description"] = $this->head["h1"].". ".$this->head["title"];

        $this->product_custom["p1"] = "This php app supports mvc pattern. ".
            "Core-branch main contains general templates for quick launch new theme-branches. ".
            "For displaying custom errors attends Alerts_Controller. ";
        $this->product_deploy["install"]["checkout-branch"] = "main";
        $this->product_deploy["install"]["example-text"] = "clone repository and checkout branch ".
            "(<strong>".$this->product_deploy["install"]["checkout-branch"]."</strong>)";

        $this->product_config["p1"] = "All configuration settings, by default, are into directory  <span class='ex-conf'>/__config</span>. ";
        $this->product_config["p2"] =  "At this branch custom settings not required.";

        $this->prod_test = array(
            "p1" => "<a href='".JOINT_SITE_APP_REF."/test/main' ".
                "title='Как работает на тесте'>Check how this app work</a>, but there is not much to test.",

        );
    }
}
