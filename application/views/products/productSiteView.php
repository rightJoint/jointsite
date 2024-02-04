<?php
include "application/views/view_main.php";
class productSiteView extends view_main
{
    public $logo="/img/popimg/internet.png";

    function __construct()
    {
        parent::__construct();
        $this->styles[] = "/css/products/prod-deploy.css";
        $this->lang_map["head"]["title"] = array(
            "en" => "jointSite - product",
            "rus" => "джойнтСайт - продукт",
        );
        $this->lang_map["head"]["h1"] = array(
            "en" => "Web Site - product",
            "rus" => "Web site - продукт",
        );

        $this->lang_map["prod_about"] = $this->lang_map["branches"]["site-descr"];

        $this->lang_map["product-info"] = array(
            "h_content" => array(
                "en" => "Table of content",
                "rus" => "Сщдержание",
            ),
            "h2_common" => array(
                "en" => "About product",
                "rus" => "О продукте",
            ),
            "h2_setup" => array(
                "en" => "Set up",
                "rus" => "Установка",
            ),
        );
        $this->lang_map["product-deploy"] = array(
            "install" => array(
                'h3' => array(
                    "en" => "Getting files",
                    "rus" => "Копирование файлов",
                ),
                'p1' => array(
                    "en" => "Getting files",
                    "rus" => "Все библиотеки, конфиги и медиа-файлы максимально включены в репозирорий, ничего отдельно копировать не надо.",
                ),
                'p2' => array(
                    "en" => "Getting files",
                    "rus" => "Получить файлы проекта можно с помощью гит, клонировав ветку из репозитория ",
                ),
                'checkout-branch' => array(
                    "en" => "theme-branch",
                    "rus" => "theme-branch",
                ),
                "download_text" => array(
                    "en" => "",
                    "rus" => "",
                ),
                "download_link" => array(
                    "en" => "(or download archive file, if link presents)",
                    "rus" => "(или скачать архив с файлами если выложен для загрузки)",
                ),
                "example-text" => array(
                    "en" => "clone repository and checkout branch (<strong>use real name of branch instead theme-branch</strong>)",
                    "rus" => "клонирование репозитория и переключение на ветку (<strong>вместо theme-branch вам надо указать название одной из веток сайта</strong>)",
                ),
            ),
            "server" => array(
                "h3" => array(
                    "en" => "Server",
                    "rus" => "Сервер",
                ),
                "p1" => array(
                    "en" => "Setver",
                    "rus" => "Сайт установлен на хостинг, локально тестировался на Open Server Panel со следующими настройками:",
                ),
            ),
        );
        $this->lang_map["product-migration"] = array(
            "h3" => array(
                "en" => "Set up",
                "rus" => "Миграции",
            ),
            "p1" => array(
                "en" => "Set up",
                "rus" => "После того как вы создадите базу данных, вам надо будет создать таблицы и вставить в них начальные данные для работы",
            ),
            "p2" => array(
                "en" => "About product",
                "rus" => "Для настройки подключения к базе данных и проведения миграций можно использовать ветку Admin, если у вас нет другого простого способа для этого. ".
                    "К сожалению автослияние в гит дает конфликт в меню view.php, при решении вручную главное чтоб все блоки добавились, а не перезаписывались.",
            ),
        );
        $this->lang_map["product-custom"] = array(
            "p1" => array(
                "en" => "Table of content",
                "rus" => "Реальный сайт настроен на этот репозитории и может содержать другие ветки, ".
                    "для скачивания в полностью собраном виде доступны только те ветки, что даны в описании.",
            ),
            "h3-1" => array(
                "en" => "Table of content",
                "rus" => "Тематические ветки",
            ),
            "h3-2" => array(
                "en" => "Table of content",
                "rus" => "Core - ветки",
            ),
        );
        $this->lang_map["product-config"] = array(
            "h3" => array(
                "en" => "Table of content",
                "rus" => "Конфигурирование",
            ),
            "p1" => array(
                "en" => "Table of content",
                "rus" => "По умолчанию каталог для файлов конфигурации настраивается в ",
            ),
            "example-text-1" => array(
                "en" => "Table of content",
                "rus" => "установка каталога ",
            ),
            "p2" => array(
                "en" => "Table of content",
                "rus" => "в каталоге <span class='ex-conf'>__config</span> находится файл <span class='ex-conf'>dir_const.php</span>, ".
                    "он включается в код и содержит информацию о других настройках сайта",
            ),
            "example-text-2" => array(
                "en" => "Table of content",
                "rus" => "настройки подключения к БД в ",
            ),
        );

    }

    function print_page_content()
    {
        $this->prod_about();
        $this->prod_menu();
        $this->prod_info();
        $this->prod_deploy();
    }

    function prod_info(){

        echo "<div class='contentBlock-frame'><div class='contentBlock-center'>".
            "<div class='contentBlock-wrap'>".
            "<section>".
            "<h2 id='product-info'>".$this->lang_map["product-info"]["h2_common"][$_SESSION["lang"]]."</h2>";
        $this->prod_info_custom();
        echo "</section>".
            "</div></div></div>";
    }

    function prod_info_custom()
    {
        foreach ($this->branches as $b_name=>$b_info){
            $this->branches[$b_name]["href"] = "/products/jointsite/".$b_name;
        }
        echo "<div class='branches-block'>".
            "<p>".
            $this->lang_map["product-custom"]["p1"][$_SESSION["lang"]].
            "</p>".
            "<h3>".$this->lang_map["product-custom"]["h3-1"][$_SESSION["lang"]]."</h3>";
        $this->print_branch("music", $this->lang_map["branches"]["list"]["music"]);
        $this->print_branch("admin", $this->lang_map["branches"]["list"]["admin"]);

        echo "<h3>".$this->lang_map["product-custom"]["h3-2"][$_SESSION["lang"]]."</h3>";
        $this->print_branch("module", $this->lang_map["branches"]["list"]["module"]);
        $this->print_branch("record", $this->lang_map["branches"]["list"]["record"]);
        echo "</div>";
    }

    function prod_deploy_migrations()
    {
        echo "<h3>".$this->lang_map["product-migration"]["h3"][$_SESSION["lang"]]."</h3>".
            "<p>".$this->lang_map["product-migration"]["p1"][$_SESSION["lang"]]."</p>".
            "<p>".$this->lang_map["product-migration"]["p2"][$_SESSION["lang"]]."</p>";
    }

    function prod_deploy_config()
    {
        echo "<h3>".$this->lang_map["product-config"]["h3"][$_SESSION["lang"]]."</h3>".
            "<p>".
            $this->lang_map["product-config"]["p1"][$_SESSION["lang"]].
            "<span class='ex-conf'>core/application.php</span></p>".
            "<div class='example'>".
            "<div class='example-code'>".
            "define('JOINT_CONF_DIR', '__config');".
            "</div>".
            "<div class='example-text'>".
            $this->lang_map["product-config"]["example-text-1"][$_SESSION["lang"]].
            "<span class='ex-conf'>__config</span> в <span class='ex-conf'>core/application.php</span>".
            "</div>".
            "</div>".
            "<p>".
            $this->lang_map["product-config"]["p2"][$_SESSION["lang"]].
            "</p>".
            "<div class='example'>".
            "<div class='example-code'>".
            "define('SQL_CONN_DEFAULT', '/'.JOINT_CONF_DIR.'/db_conn.php');".
            "</div>".
            "<div class='example-text'>".
            $this->lang_map["product-config"]["example-text-2"][$_SESSION["lang"]].
            "<span class='ex-conf'>dir_const.php</span> указывают на файл <span class='ex-conf'>__config/db_conn.php</span>".
            "</div>".
            "</div>";
    }
    function prod_deploy_install()
    {
        echo "<h3>".$this->lang_map["product-deploy"]["install"]["h3"][$_SESSION["lang"]]."</h3>".
            "<p>".
            $this->lang_map["product-deploy"]["install"]["p1"][$_SESSION["lang"]].
            "</p>".
            "<p>".
            $this->lang_map["product-deploy"]["install"]["p2"][$_SESSION["lang"]].
            $this->lang_map["product-deploy"]["install"]["download_link"][$_SESSION["lang"]].
            "</p>".
            "<div class='example'>".
            "<div class='example-code'>".
            "git clone jointsite".
            "</div>".
            "<div class='example-code'>".
            "git checkout ".$this->lang_map["product-deploy"]["install"]["checkout-branch"][$_SESSION["lang"]].
            "</div>".
            "<div class='example-text'>".
            $this->lang_map["product-deploy"]["install"]["example-text"][$_SESSION["lang"]].
            "</div>".
            "</div>";
    }
    function prod_deploy_server()
    {
        echo "<h3>".$this->lang_map["product-deploy"]["server"]["h3"][$_SESSION["lang"]]."</h3>".
            "<p>".
            $this->lang_map["product-deploy"]["server"]["p1"][$_SESSION["lang"]].
            "<ul>".
            "<li>Apache_2.4-PHP_7.2+Nginx_1.23</li>".
            "<li>MySQL-5.6</li>".
            "<li>PHP_7.2</li>".
            "</ul>".
            "</p>";
    }


    function prod_deploy()
    {
        echo "<div class='contentBlock-frame'><div class='contentBlock-center'>".
            "<div class='contentBlock-wrap'>".
            "<section class='prod-deploy'>".
            "<h2 id='product-setup'>".$this->lang_map["product-info"]["h2_setup"][$_SESSION["lang"]]."</h2>";
        $this->prod_deploy_server();
        $this->prod_deploy_install();
        $this->prod_deploy_config();
        $this->prod_deploy_migrations();
        echo "</section>".
            "</div></div></div>";

    }

    function prod_about()
    {
        echo "<div class='contentBlock-frame'><div class='contentBlock-center'>".
            "<div class='contentBlock-wrap'>".
            "<section class='prod-about'>".
            "<p>".
            $this->lang_map["prod_about"][$_SESSION["lang"]].
            "</p>".
            "</section>".
            "</div></div></div>";
    }

    function prod_menu()
    {
        echo "<div class='contentBlock-frame '><div class='contentBlock-center'>".
            "<div class='contentBlock-wrap'>".
            "<section class='prod-menu'>".
            "<h2>".$this->lang_map["product-info"]["h2_сontent"][$_SESSION["lang"]]."</h2>".
            "<ul>".
            "<li><a href='#product-info'>".$this->lang_map["product-info"]["h2_common"][$_SESSION["lang"]]."</a></li>".
            "<li><a href='#product-setup'>".$this->lang_map["product-info"]["h2_setup"][$_SESSION["lang"]]."</a></li>".
            "</ul>".
            "</section>".
            "</div></div></div>";

    }

}