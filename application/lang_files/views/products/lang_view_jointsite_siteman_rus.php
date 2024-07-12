<?php
class lang_view_jointsite_siteman_rus extends lang_view_products_jointsite_rus
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

        $this->product_custom["p1"] = "В Siteman настроены основные модули сайта для управления пользователями, группами и оповещениями.";
        $this->product_custom["p2"] = "После установки и проведения миграций Админка сайта будет доступна по адресу ".
            "<a href='".JOINT_SITE_EXEC_DIR."/siteman'>/siteman</a>.";
        $this->product_custom["p3"] = "Для входа используйте ".
            "<span class='ex-conf'>логин: </span>siteman".
            " и <span class='ex-conf'>пароль: </span>siteman";
        $this->product_deploy["install"]["checkout-branch"] = "siteman";
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