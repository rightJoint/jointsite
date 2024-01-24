<?php
include "application/views/products/productSiteView.php";
class productSiteAdminView extends productSiteView
{
    public $logo="/img/popimg/admin-logo.png";

    function __construct()
    {
        parent::__construct();
        $this->lang_map["head"]["title"] = array(
            "en" => "jointSite - branch Admin",
            "rus" => "джойнтСайт - ветка Админ",
        );
        $this->lang_map["head"]["h1"] = array(
            "en" => "Web Site - branch Admin",
            "rus" => "Web site - ветка Админ",
        );
        $this->lang_map["prod_about"] = $this->lang_map["branches"]["list"]["admin"]["descr"];

        $this->lang_map["prod-info-text"] = array(

            "get_in" => array(
                "en" => "get in admin using menu ref /admin",
                "rus" => "вход админ через меню по адресу /admin",
            ),
            "menu_1" => array(
                "en" => "admin menu in modal win",
                "rus" => "меню админки в модальном окне",
            ),
            "menu_2" => array(
                "en" => "admin menu after auth",
                "rus" => "меню админке после авторизации",
            ),
            "users" => array(
                "en" => "list, create or delete admin users",
                "rus" => "список, создание и удаление пользователей админки",
            ),
            "server" => array(
                "en" => "Set up connection to sql server and database",
                "rus" => "Настройка подключения к sql серверу и базе данных",
            ),
            "sql" => array(
                "en" => "Execution sql query",
                "rus" => "Выполнение sql запроса",
            ),
            "tables" => array(
                "en" => "Actions with tables",
                "rus" => "Операции с таблицами",
            ),
            "query" => array(
                "en" => "Search query",
                "rus" => "Запрос на поиск",
            ),
            "records" => array(
                "en" => "Process records in table",
                "rus" => "Работа с записями в таблице",
            ),

        );
    }

    function prod_info(){
        foreach ($this->branches as $b_name=>$b_info){
            $this->branches[$b_name]["href"] = "/products/jointsite/".$b_name;
        }
        echo "<div class='contentBlock-frame'><div class='contentBlock-center'>".
            "<div class='contentBlock-wrap'>".
            "<section>".
            "<h2 id='product-info'>Общая информация</h2>".
            "<div class='branches-block'>".
            "<p>Ветка админ наследуется от ветки Record для работы с записями в таблицах, ".
            "дополнена моделями и представления загрузки/выгрузки таблиц, выполнения SQL запросов и других целей</p>".
            "<div class='example eximg'>".
            "<div class='example-img'>".
            "<img src='/img/Products/admin-get_in_admin_".$_SESSION["lang"].".png'>".
            "</div>".
            "<div class='example-text'>".
            $this->lang_map["prod-info-text"]["get_in"][$_SESSION["lang"]].
            "</div>".
            "</div>".
            "<p>defaul user login password</p>".
            "<div class='example eximg'>".
            "<div class='example-img'>".
            "<img src='/img/Products/admin_menu-1_".$_SESSION["lang"].".png'>".
            "</div>".
            "<div class='example-text'>".
            $this->lang_map["prod-info-text"]["menu_1"][$_SESSION["lang"]].
            "</div>".
            "</div>".
            "<div class='example eximg'>".
            "<div class='example-img'>".
            "<img src='/img/Products/admin_menu-2_".$_SESSION["lang"].".png'>".
            "</div>".
            "<div class='example-text'>".
            $this->lang_map["prod-info-text"]["menu_2"][$_SESSION["lang"]].
            "</div>".
            "</div>".
            "<div class='example eximg'>".
            "<div class='example-img'>".
            "<img src='/img/Products/admin-users_".$_SESSION["lang"].".png'>".
            "</div>".
            "<div class='example-text'>".
            $this->lang_map["prod-info-text"]["users"][$_SESSION["lang"]].
            "</div>".
            "</div>".
            "<p>where users files</p>".
            "<div class='example eximg'>".
            "<div class='example-img'>".
            "<img src='/img/Products/admin-server_".$_SESSION["lang"].".png'>".
            "</div>".
            "<div class='example-text'>".
            $this->lang_map["prod-info-text"]["server"][$_SESSION["lang"]].
            "</div>".
            "</div>".
            "<p>where sql files</p>".
            "<div class='example eximg'>".
            "<div class='example-img'>".
            "<img src='/img/Products/admin-create_db_sql_".$_SESSION["lang"].".png'>".
            "</div>".
            "<div class='example-text'>".
            $this->lang_map["prod-info-text"]["sql"][$_SESSION["lang"]].
            "</div>".
            "</div>".
            "<div class='example eximg'>".
            "<div class='example-img'>".
            "<img src='/img/Products/admin-tables_".$_SESSION["lang"].".png'>".
            "</div>".
            "<div class='example-text'>".
            $this->lang_map["prod-info-text"]["tables"][$_SESSION["lang"]].
            "</div>".
            "</div>".
            "<p>where upload table files, where create files</p>".
            "<div class='example eximg'>".
            "<div class='example-img'>".
            "<img src='/img/Products/admin-query_".$_SESSION["lang"].".png'>".
            "</div>".
            "<div class='example-text'>".
            $this->lang_map["prod-info-text"]["query"][$_SESSION["lang"]].
            "</div>".
            "</div>".
            "<div class='example eximg'>".
            "<div class='example-img'>".
            "<img src='/img/Products/admin_records_".$_SESSION["lang"].".png'>".
            "</div>".
            "<div class='example-text'>".
            $this->lang_map["prod-info-text"]["records"][$_SESSION["lang"]].
            "</div>".
            "</div>".
            "</section>".
            "</div></div></div>";
    }

}