<?php
class lang_view_jointsite_record extends lang_view_products_jointsite
{
    function __construct()
    {
        parent::__construct();

        $this->head["description"] = $this->head["h1"].". ".$this->head["title"];

        $this->product_custom["p1"] = "Record содержит контроллер, модель и представления для работы с записями ".
            "в таблицах базы данных.";
        $this->product_deploy["install"]["checkout-branch"] = "recnew";
        $this->product_deploy["install"]["example-text"] = "клонирование репозитория и переключение на ветку ".
            "(<strong>".$this->product_deploy["install"]["checkout-branch"]."</strong>)";

        $this->product_config["p1"] = "Все основные настройки приложения по умолчанию находятся в каталоге  <span class='ex-conf'>/__config</span>. ";
        $this->product_config["p2"] = "Настройки подключения к базе данных по умолчанию находятся в  <span class='ex-conf'>/__config/db_conn.php</span>. ";
        $this->product_migration["p1"] = "Запросы на создание тестовых таблиц и вставки данных находятся в каталоге <span class='ex-conf'>/migrations</span>";
        $this->prod_test = array(
            "p1" => "Проведите миграцию <span class='ex-conf'>2024-05-21_rj-test-records</span>. ".
                "<a href='".JOINT_SITE_SL_LANG."/test/records' title='Как работает Запись на тесте'>Проверить ветку Запись на тесте</a>. ".
                "В примере используются кастомные модели из музкальной галлереи",
        );
    }
}