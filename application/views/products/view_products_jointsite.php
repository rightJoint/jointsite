<?php
require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
    "/application/views/view_main.php";
class View_Products_JointSite extends view_main
{
    public $logo = JOINT_SITE_EXEC_DIR."/img/popimg/internet.png";
    public $current_branch = "main";
    function __construct()
    {
        parent::__construct();
        $this->styles[] = JOINT_SITE_EXEC_DIR."/css/products/prod-deploy.css";
    }

    function print_page_content()
    {
        $this->prod_about();
        $this->prod_menu();
        $this->prod_info();
        $this->prod_deploy();
    }
    function prod_about()
    {
        echo "<div class='contentBlock-frame'><div class='contentBlock-center'>".
            "<div class='contentBlock-wrap'>".
            "<section class='prod-about'>".
            "<p>".
            $this->lang_map->branches["site-descr"].
            "</p>".
            "</section>".
            "</div></div></div>";
    }

    function prod_menu()
    {
        echo "<div class='contentBlock-frame '><div class='contentBlock-center'>".
            "<div class='contentBlock-wrap'>".
            "<section class='prod-menu'>".
            "<h2>".$this->lang_map->prodmenu["h2_сontent"]."</h2>".
            "<ul>".
            "<li><a href='#product-info'>".$this->lang_map->prodmenu["h2_common"]."</a></li>".
            "<li><a href='#product-setup'>".$this->lang_map->prodmenu["h2_setup"]."</a></li>".
            "</ul>".
            "</section>".
            "</div></div></div>";

    }
    function prod_info(){

        echo "<div class='contentBlock-frame'><div class='contentBlock-center'>".
            "<div class='contentBlock-wrap'>".
            "<section>".
            "<h2 id='product-info'>".$this->lang_map->prodmenu["h2_common"]."</h2>";
        $this->prod_info_custom();
        echo "</section>".
            "</div></div></div>";
    }

    function prod_info_custom()
    {
        echo "<div class='branches-block'>".
            "<p>".
            $this->lang_map->product_custom["p1"].
            "</p>";
        $this->print_branch("main");
        echo "<h3>".$this->lang_map->product_custom["h3-1"]."</h3>";
        $this->print_branch("music");
        echo "<h3>".$this->lang_map->product_custom["h3-2"]."</h3>";
        $this->print_prod_branches();
        echo "</div>";
    }

    function print_prod_branches()
    {
        $this->print_branch("siteman");
        $this->print_branch("record");
    }

    function prod_deploy()
    {
        echo "<div class='contentBlock-frame'><div class='contentBlock-center'>".
            "<div class='contentBlock-wrap'>".
            "<section class='prod-deploy'>".
            "<h2 id='product-setup'>".$this->lang_map->prodmenu["h2_setup"]."</h2>";
        $this->prod_deploy_server();
        $this->prod_deploy_install();
        $this->prod_deploy_config();
        $this->prod_deploy_migrations();
        echo "</section>".
            "</div></div></div>";

    }

    function prod_deploy_server()
    {
        echo "<h3>".$this->lang_map->product_deploy["server"]["h3"]."</h3>".
            "<p>".
            $this->lang_map->product_deploy["server"]["p1"].
            "<ul>".
            "<li>Apache_2.4-PHP_7.2+Nginx_1.23</li>".
            "<li>MySQL-5.6</li>".
            "<li>PHP_8.1</li>".
            "</ul>".
            "</p>";
    }
    function prod_deploy_install()
    {
        echo "<h3>".$this->lang_map->product_deploy["install"]["h3"]."</h3>".
            "<p>".
            $this->lang_map->product_deploy["install"]["p1"].
            "</p>".
            "<p>".
            $this->lang_map->product_deploy["install"]["p2"].
            $this->lang_map->product_deploy["install"]["download_link"].
            "</p>".
            "<div class='example'>".
            "<div class='example-code'>".
            "git clone https://github.com/rightJoint/jointsite".
            "</div>".
            "<div class='example-code'>".
            "git checkout ".$this->lang_map->product_deploy["install"]["checkout-branch"].
            "</div>".
            "<div class='example-text'>".
            $this->lang_map->product_deploy["install"]["example-text"].
            "</div>".
            "</div>".
            "<p>".
            $this->lang_map->product_deploy["install"]["p3"].
            "</p>".
            "<div class='example'>".
            "<div class='example-code'>".
            "git init".
            "</div>".
            "<div class='example-code'>".
            "git remote add origin https://github.com/rightJoint/jointsite".
            "</div>".
            "<div class='example-code'>".
            "git checkout -b ".$this->lang_map->product_deploy["install"]["checkout-branch"].
            "</div>".
            "<div class='example-code'>".
            "git pull origin ".$this->lang_map->product_deploy["install"]["checkout-branch"].
            "</div>".
            "<div class='example-text'>".
            $this->lang_map->product_deploy["install"]["example-text2"]." ".$this->lang_map->product_deploy["install"]["checkout-branch"].
            "</div>".
            "</div>";
    }

    function prod_deploy_config()
    {
        echo "<h3>".$this->lang_map->product_config["h3"]."</h3>".
            "<p>".
            $this->lang_map->product_config["p1"].
            "</p>";
        echo $this->prod_deploy_config_ex();
    }

    function prod_deploy_config_ex()
    {
        echo "<div class='example'>".
        "<div class='example-code'>".
        "RewriteBase /".$this->lang_map->product_config["mirror_base"].
        "</div>".
        "<div class='example-text'>".
        $this->lang_map->product_config["example-text-1"].
        "<span class='ex-conf'>/".$this->lang_map->product_config["mirror_base"]."</span> в <span class='ex-conf'>.htacceess</span>".
        "</div>".
        "</div>".
        "<p>".
        $this->lang_map->product_config["p2"].
        "</p>".
        "<div class='example'>".
        "<div class='example-code'>".
        "new jointSite(".$this->lang_map->product_config["mirror_dir"].");".
        "</div>".
        "<div class='example-text'>".
        $this->lang_map->product_config["example-text-2"].
        "</div>".
        "</div>";
    }

    function prod_deploy_migrations()
    {
        echo "<h3>".$this->lang_map->product_migration["h3"]."</h3>".
            "<p>".$this->lang_map->product_migration["p1"]."</p>";
        if($this->lang_map->product_migration["p2"]){
            echo "<p>".$this->lang_map->product_migration["p2"]."</p>";
        }

    }
}