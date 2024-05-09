<?php
class lang_view_jointsite_main_rus extends lang_view_products_jointsite_rus
{
    function __construct()
    {
        parent::__construct();

        $this->head["h1"] = "Web-приложение ДжойнтСайт";
        $this->head["title"] = "Ветка main";

        $this->head["description"] = $this->head["h1"].". ".$this->head["title"];

        $this->product_custom["p1"] = "Приложение написано на php и потддерживает MVC шаблон. ".
            "В core-ветке main содержатся основные шаблоны для быстрого применения в дальнейшем на тематических ветках. ".
            "Для педставления обрабатываемых ошибок приложения пердназначен Alerts_Controller. ";
        $this->product_deploy["install"]["checkout-branch"] = "main";
        $this->product_deploy["install"]["example-text"] = "клонирование репозитория и переключение на ветку ".
            "(<strong>".$this->product_deploy["install"]["checkout-branch"]."</strong>)";

        $this->product_config = array(
            "h3" => "Конфигурирование",
            "p1" => "Все основные настройки приложения по умолчанию находятся в каталоге  <span class='ex-conf'>__config</span>. ",
            "p2" => "В этой ветке никаких дополнительных настроек не требуется.",
        );
        $this->prod_test = array(
            "p1" => "Проверить работу приложения можно на <a href='".JOINT_SITE_EXEC_DIR."/test/main' ".
                "title='Как работает на тесте'>Проверить приложение</a>, но в этой ветке только шаблоны, которые не интересно проверять.",

        );
    }
}