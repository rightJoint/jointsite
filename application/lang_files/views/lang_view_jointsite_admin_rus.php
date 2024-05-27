<?php
class lang_view_jointsite_admin_rus extends lang_view_products_jointsite_rus
{
    function __construct()
    {
        parent::__construct();

        $this->head["description"] = $this->head["h1"].". ".$this->head["title"];

        $this->product_custom["p1"] = "В контроллере вручную проверяется загрузка моделей и представлений для возможности ".
            "воспроизвести на другом url как в <a href='#product-test'>тестовом примере.</a>";
        $this->product_deploy["install"]["checkout-branch"] = "admin";

        $this->product_deploy["install"]["example-text"] = "клонирование репозитория и переключение на ветку ".
            "(<strong>".$this->product_deploy["install"]["checkout-branch"]."</strong>)";

        $this->product_config["p1"] = "По умолчанию админка настроена на запуск внутри другого приложения по адресу <span class='ex-conf'>/mirror</span>. ".
            "Чтоб запускать админку на отдельном сайте настройте обратно конфиги ниже как в примере.";

        $this->product_config["p2"] = "Так же для запуска на отдельном сайте, необходимо указать приложению, откуда оно запускается ".
            " в <span class='ex-conf'>index.php</span>";
        $this->product_config["example-text-2"] = "Настройка запуска приложения как отдельный сайт в index.php";

        $this->product_config["mirror_dir"] = "";
        $this->product_config["mirror_base"] = "";

        $this->product_config["p3"] = "Меню админки настроено на тестовый пример, чтоб настроить на адрес <span class='ex-conf'>/admin</span>, ".
            "укажите в <span class='ex-conf'>SiteView.php</span> в функции <span class='ex-conf'>print_admin_menu</span>";
        $this->product_config["example-text-3"] = "Настройка меню админки на адрес <span class='ex-conf'>/admin</span>";

        $this->product_config["p4"] = "Дополнительные настройки директорий админки находятся в <span class='ex-conf'>/__config/admin_conf.php</span>. ";
        $this->product_config["p5"] = "По умолчанию админка настроена на url <span class='ex-conf'>/admin</span>. ";
        $this->product_config["p6"] = "Данные пользователей адмнки находятся в <span class='ex-conf'>/__config/adminUsers.txt</span>, ".
            "логин и пароль для входа <span class='ex-conf'>admin</span>, ";
        // );
        $this->prod_test = array(
            "p1" => "Проверить работу приложения можно на <a href='".JOINT_SITE_EXEC_DIR."/test/main' ".
                "title='Как работает на тесте'>Проверить приложение</a>, но в этой ветке только шаблоны, которые не интересно проверять.",

        );
        $this->product_migration["p1"] = "Для работы с миграциями в адмике, первую миграцию ".
            "<span class='ex-conf'>/migrations/2024-05-20-migrations_tables.sql</span> на создание таблиц необходимо провести ".
            "вручную. Это можно сделать адресу <span class='ex-conf'>/admin/tables</span> или <span class='ex-conf'>/admin/sql</span>";
        $this->product_migration["p2"] = "Имеется возможность для просмотра и редактирования запросов в sql файлах, ".
            " контроль выполнения миграций по логам.";
        $this->prod_test = array(
            "p1" => "Для теста Админка предствален на <a href='".JOINT_SITE_EXEC_DIR."/admin'>".JOINT_SITE_EXEC_DIR."/admin</a>".
                " и на тестовом url <a href='".JOINT_SITE_EXEC_DIR."/test/phpmysqladmin' title='Как работает Админ на тесте'>".
                JOINT_SITE_EXEC_DIR."/test/phpmysqladmin</a>.",
        );
    }


}