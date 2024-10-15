<?php
class LangFiles_Ru_View_JointSiteMain extends LangFiles_Ru_Views_JointSiteProducts
{
    function __construct()
    {
        parent::__construct();

        $this->head["description"] = $this->head["h1"].". ".$this->head["title"];

        $this->product_custom["p1"] = "Приложение написано на php и потддерживает MVC шаблон. ".
            "В core-ветке main содержатся основные шаблоны для быстрого применения в дальнейшем на тематических ветках. ".
            "Для обрабатываемых ошибок приложения пердназначен Alerts_Controller. ";
        $this->product_deploy["install"]["checkout-branch"] = "main";
        $this->product_deploy["install"]["example-text"] = "клонирование репозитория и переключение на ветку ".
            "(<strong>".$this->product_deploy["install"]["checkout-branch"]."</strong>)";

        $this->product_config["p1"] = "Все основные настройки приложения по умолчанию находятся в каталоге  <span class='ex-conf'>/__config</span>. ";
        $this->product_config["p2"] ="В этой ветке никаких дополнительных настроек не требуется.";
        $this->prod_test = array(
            "p1" => "Проверить работу приложения можно на <a href='".JOINT_SITE_SL_LANG."/test/main' ".
                "title='Как работает на тесте'>Проверить приложение</a>, но в этой ветке только шаблоны, которые не интересно проверять.",

        );
    }
}