<?php
class LangFiles_Ru_Views_MainView extends LangFiles_Ru_Views_View
{
    public $branches = array();
    public $product_custom = array();

    function __construct()
    {
        $this->branches = array(
            "h2" => "Ветки этого сайта",
            "branch-version" => "Версия",
            "branch-get" => "Скачать ветку",
            "learn-more" => "Узнать больше",
            "depend" => "Зависимости",
            "site-descr" => "Двуязычный сайт с меню в модальном окне. Технологии: php, js. Шаблон: MVC. ".
                "CI/CD: ДокерХаб. Отладка: xDebug. Тестирование: phpUnit",
            "site-descr-1" => "<small>Это все еще довольно сырой проект, обновления готовятся и выйдут скоро.</small>",
        );
        $this->product_custom = array(
            "h3-1" => "Тематические ветки",
            "h3-2" => "Core - ветки",
        );
    }
}