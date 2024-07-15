<?php
class lang_view_jointsite_music_en extends lang_view_products_jointsite_en
{
    function __construct()
    {
        parent::__construct();

        $this->prodmenu["principles_of_work"] = "Принцип работы модуля";

        $this->principles_of_work = array(
            "h3-1" => "Загрузка модели",
            "h3-2" => "Загрузка представления",
        );

        $this->head["description"] = $this->head["h1"].". ".$this->head["title"];

        $this->product_custom["p1"] = "Модуль позволяет настроить доступ к сайту используя авторизацию и систему ролей, ".
            "для оповещения пользователей разработана модель и шаблоны уведомлений.";
        $this->product_deploy["install"]["checkout-branch"] = "module";
        $this->product_deploy["install"]["example-text"] = "клонирование репозитория и переключение на ветку ".
            "(<strong>".$this->product_deploy["install"]["checkout-branch"]."</strong>)";

        $this->product_config["p1"] = "Все основные настройки приложения по умолчанию находятся в каталоге  <span class='ex-conf'>/__config</span>. ";
        $this->product_config["p2"] = "Настройки подключения к базе данных по умолчанию находятся в  <span class='ex-conf'>/__config/db_conn.php</span>. ";
        $this->product_migration["p1"] = "Запросы на создание тестовых таблиц и вставки данных находятся в каталоге <span class='ex-conf'>/migrations</span>";
        $this->prod_test = array(
            "p1" => "Проведите миграцию <span class='ex-conf'>2024-05-21_rj-test-records</span>. ".
                "<a href='".JOINT_SITE_EXEC_DIR."/test/records' title='Как работает Запись на тесте'>Проверить ветку Запись на тесте</a>. ".
                "В примере используются кастомные модели из музкальной галлереи",
        );
    }
}