<?php

require_once JOINT_SITE_REQ_LANG."/Views/LangFiles_En_Views_MainView.php";

class LangFiles_En_Views_JointSiteProducts extends LangFiles_En_Views_MainView
{
    public $prodmenu = array();
    public $product_deploy = array();
    public $product_migration = array();
    public $product_config = array();

    function __construct()
    {
        parent::__construct();

        $this->head["h1"] = "JointSite - product";
        $this->head["title"] = "JointSite - product";
        $this->head["description"] = "JointSite - product: web-application, branches, setup";

        $this->product_custom["p1"] = "Это домашний проект, пока используется в целях тестирования технологий, ".
            "но так же может быть применен для решения реальных задач";

        $this->prodmenu = array(
            "h2_сontent" => "Table of content",
            "h2_common" => "About product",
            "h2_setup" => "Set up",
            "h2_test" => "Test",
        );
        $this->product_deploy = array(
            "install" => array(
                'h3' => "Getting filed",
                'p1' => "All dependencies, lib, configs, media - filed fully composed in branch, no needs to copy by hands.",
                'p2' => "Make app run folder, next get files using git, clone repository and checkout branch ",
                'checkout-branch' => "theme-branch",
                "download_text" => "",
                "download_link" => "",
                "example-text" => "clone repository and checkout branch ".
                    "(<strong>checkout one of branches this site instead theme-branch</strong>)",
                'p3' => "To use repository into current empty dir <span class='ex-conf'>/current_dir</span>, ".
                    "exec next commands: ",
                "example-text2" => "create empty repository and add remote jountsite. ".
                    "Create new local branch to track remote with the same name ",
            ),
            "server" => array(
                "h3" => "Server",
                "p1" => "App set at hosting, tested locally on Open Server Panel with next settings:",
            ),
        );
        $this->product_migration = array(
            "h3" => "Migrations",
            "p1" => "Usually, you need to create database, tables and insert there data.",
            "p2" => "To setup connections, create tables and use migrations ".
                "you can clone and merge into project theme-branch <span class='ex-conf'>admin</span>",
        );

        $this->product_config = array(
            "h3" => "Configuration",
            "p1" => " <span class='ex-conf'>.htaccess</span> - included into repository. ".
                "For run this app into another one, edit .htaccess",
            "example-text-1" => "setup app entry point ",
            "p2" => "Also for run fro, not root dir, you need specify app run dir param ".
                " in <span class='ex-conf'>index.php</span>",
            "example-text-2" => "Setup up dir <span class='ex-conf'>/mirror</span> to run into another app at /mirror url",
            "mirror_dir" => "/mirror",
            "mirror_base" => "mirror"
        );
    }
}