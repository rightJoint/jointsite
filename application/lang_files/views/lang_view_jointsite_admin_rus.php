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

        $this->product_config = array(
            "h3" => "Конфигурирование",
            "p1" => "Дополнительные настройки директорий админки находятся в <span class='ex-conf'>__config/admin_conf.php</span>. ",
            "p2" => "По умолчанию админка настроена на url <span class='ex-conf'>/admin</span>. ",
            "p3" => "Данные пользователей адмнки находятся в <span class='ex-conf'>__config/adminUsers.txt</span>, ".
                "логин и пароль для входа<span class='ex-conf'>admin</span>, ",
        );
        $this->prod_test = array(
            "p1" => "Проверить работу приложения можно на <a href='".JOINT_SITE_EXEC_DIR."/test/main' ".
                "title='Как работает на тесте'>Проверить приложение</a>, но в этой ветке только шаблоны, которые не интересно проверять.",

        );
        $this->product_migration["p1"] = "Для работы с миграциями в адмике, первую миграцию ".
            "<span class='ex-conf'>/migrations/2024-05-20-migrations_tables.sql</span> на создание таблиц необходимо провести ".
            "вручную. Это можно сделать в <span class='ex-conf'>url /admin/tables</span> или <span class='ex-conf'>url /admin/sql</span>";
        $this->product_migration["p2"] = "Имеется возможность для просмотра и редактирования запросов в sql файлах, ".
        " контроль выполнения миграций по логам.";
        $this->prod_test = array(
            "p1" => "Для теста Админка предствален на <a href='".JOINT_SITE_EXEC_DIR."/admin'>".JOINT_SITE_EXEC_DIR."/admin</a>".
                " и на тестовом url <a href='".JOINT_SITE_EXEC_DIR."/test/phpmysqladmin' title='Как работает Админ на тесте'>".
                JOINT_SITE_EXEC_DIR."/test/phpmysqladmin</a>.",
        );
    }


}