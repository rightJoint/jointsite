<?php
class lang_view_main extends lang_view
{
    function __construct()
    {
        $this->branches = array(
            "h2" => "Ветки этого сайта",
            "branch-version" => "Версия",
            "branch-get" => "Скачать ветку",
            "learn-more" => "Узнать больше",
            "depend" => "Зависимости",
            "site-descr" => "Двуязычный сайт с меню в модальном окне. Технологии: php, js. Шаблон: MVC.",
        );
        $this->product_custom = array(
            "h3-1" => "Тематические ветки",
            "h3-2" => "Core - ветки",
        );
    }
}