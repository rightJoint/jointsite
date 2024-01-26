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

        $this->lang_map["product-info"] = array(
            "h2_common" => array(
                "en" => "About admin branch",
                "rus" => "О ветке Админ",
            ),
            "h2_setup" => array(
                "en" => "Set up Admin",
                "rus" => "Установка Админки",
            ),
        );

        $this->lang_map["prod-info-text"] = array(

            "get_in" => array(
                "en" => "get in admin using menu ref <span class='ex-conf'>/admin</span>",
                "rus" => "вход в админку через меню по адресу <span class='ex-conf'>/admin</span>",
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

        $this->lang_map["product-deploy"] = array(
            "install" => array(
                'checkout-branch' => array(
                    "en" => "admin",
                    "rus" => "admin",
                ),

                "download_link" => array(
                    "en" => "(or download archive file <a href='/downloads/admin_v3.0.rar'>admin_v3.0.rar</a>')",
                    "rus" => "(или скачать архив с файлами <a href='/downloads/admin_v3.0.rar'>admin_v3.0.rar</a>)",
                ),
                "example-text" => array(
                    "en" => "clone repository and checkout branch <span class='ex-conf'>admin</span>",
                    "rus" => "клонирование репозитория и переключение на ветку <span class='ex-conf'>admin</span>",
                ),
            ),
        );

        $this->lang_map["product-migration"]["p2"] = array(
            "en" => "About product",
            "rus" => "В качестве примера можно использовать миграцию <span class='ex-conf'>20240109_213031_testtable_3_rec.php</span>".
                " чтоб протестить как работать с админкой и записями",
        );
    }

    function prod_deploy_config()
    {
        parent::prod_deploy_config();
        echo "<p>Файл с настройками админки <span class='ex-conf'>admin_conf.php</span> включается в проект в ".
            "<span class='ex-conf'>controller_admin.php</span></p>".
            "<div class='example'>".
            "<div class='example-code'>".
            "require_once JOINT_CONF_DIR.'/admin/admin_conf.php';".
            "</div>".
            "<div class='example-text'>".
            "включение файла с натройками <span class='ex-conf'>admin_conf.php</span> из каталога <span class='ex-conf'>__config/admin/</span>".
            "</div>".
            "</div>".
            "<p>Вы можете изменить настройки по умолчанию указав другие каталоги.</p>";
    }

    function prod_info_custom(){
        echo
            "<div class='branches-block'>".
            "<p>Ветка админ наследуется от ветки Record для работы с записями в таблицах, ".
            "дополнена моделями и представлениями загрузки/выгрузки таблиц, выполнения SQL запросов и других целей</p>".
            "<div class='example eximg'>".
            "<div class='example-img'>".
            "<img src='/img/Products/admin-get_in_admin_".$_SESSION["lang"].".png'>".
            "</div>".
            "<div class='example-text'>".
            $this->lang_map["prod-info-text"]["get_in"][$_SESSION["lang"]].
            "</div>".
            "</div>".
            "<p>Для входа в admin используйте настроенные по умолчанию логин <span class='ex-conf'>admin</span> пароль <span class='ex-conf'>admin</span></p>".
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
            "<p>Текстовый файл с данными пользователей админки <span class='ex-conf'>adminUsers.txt</span> по умолчанию находится в каталоге <span class='ex-conf'>__config/admin/</span></p>".
            "<div class='example eximg'>".
            "<div class='example-img'>".
            "<img src='/img/Products/admin-server_".$_SESSION["lang"].".png'>".
            "</div>".
            "<div class='example-text'>".
            $this->lang_map["prod-info-text"]["server"][$_SESSION["lang"]].
            "</div>".
            "</div>".
            "<p>Файл с настройками подключения к SQL-серверу и базе данных <span class='ex-conf'>db_conn.php</span> по умолчанию находится в <span class='ex-conf'>__config/</span></p>".
            "<div class='example eximg'>".
            "<div class='example-img'>".
            "<img src='/img/Products/admin-create_db_sql_".$_SESSION["lang"].".png'>".
            "</div>".
            "<div class='example-text'>".
            $this->lang_map["prod-info-text"]["sql"][$_SESSION["lang"]].
            "</div>".
            "</div>".
            "<p>Например, для создания базы данных <span class='ex-conf'>jointdb</span> выполните запрос</p>".
            "<div class='example'>".
            "<div class='example-code'>".
            "CREATE DATABASE jointdb CHARACTER SET utf8 COLLATE utf8_general_ci".
            "</div>".
            "<div class='example-text'>".
            "создание базы данных <span class='ex-conf'>jointdb</span>".
            "</div>".
            "</div>".
            "<p></p>".
            "<div class='example eximg'>".
            "<div class='example-img'>".
            "<img src='/img/Products/admin-tables_".$_SESSION["lang"].".png'>".
            "</div>".
            "<div class='example-text'>".
            $this->lang_map["prod-info-text"]["tables"][$_SESSION["lang"]].
            "</div>".
            "</div>".
            "<p>По умолчанию скрипт смотрит запросы на создание таблиц в каталоге <span class='ex-conf'>__config/admin/createTablesQueries/</span>, ".
            "запросы на загрузку и выгрузку таблиц в <span class='ex-conf'>usrdata/db/</span></p>".
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
            "</div>";
    }

}