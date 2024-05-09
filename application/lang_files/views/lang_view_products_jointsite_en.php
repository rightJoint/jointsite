<?php
require_once ($_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
    "/application/lang_files/views/lang_view_main_en.php");
class lang_view_products_jointsite_en extends lang_view_main_en
{
    function __construct()
    {
        parent::__construct();

        $this->head["h1"] = "JointSite - product";
        $this->head["title"] = "JointSite - product";
        $this->head["description"] = "JointSite - product: web-application, branches, setup";

        $this->product_custom["p1"] = "Real site fetching from this repository and may track branch that is not described there, ".
    "fully composed branches are in the list bellow..";

        $this->prodmenu = array(
            "h_content" => "Table of content",
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
                "download_link" => "(или скачать архив с файлами если выложен для загрузки)",
                "example-text" => "clone repository and checkout branch ".
                    "(<strong>instead theme-branch use name one of site branches</strong>)",
            ),
            "server" => array(
                "h3" => "Server",
                "p1" => "App set at hosting, tested locally on Open Server Panel with next settings:",
            ),
        );
        $this->product_migration = array(
            "h3" => "Migrations",
            "p1" => "Usually, you need to create database, tables and insert there data.",
        );

        $this->product_config = array(
            "h3" => "Configuration",
            "p1" => " <span class='ex-conf'>.htaccess</span> - included into repository. ".
                "For run this app into another one, edit .htaccess",
            "example-text-1" => "setup app entry point ",
            "p2" => "Also for run fro, not root dir, you need specify app run dir param ".
                " in <span class='ex-conf'>index.php</span>",
            "example-text-2" => "Устанока директории ",
        );
        $this->prod_test = array(
            "p1" => "For test functionality this app attends url <span class='ex-conf'>/test</span>."
        );
    }
}