<?php
class lang_view_main_rus extends lang_view_rus
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
        $this->branchesList = array(
            "main" => array(
                "title" => "Ветка Приложение (Main)",
                "test_ref" => JOINT_SITE_EXEC_DIR."/products/jointsite/main",
                "test_ref_title" => "Перейти к тесту",
                "descr" => "Приложение можно установить как сайт или запускать внутри сайта на отдельном url. ",
                "version" => "v1.0",
                "get" => "<a href='https://github.com/rightJoint/jointsite/tree/main' title='скачать с гит хаба'>ссылка на github</a>",
                "more" => "<a href='".JOINT_SITE_EXEC_DIR."/products/jointsite/main' title='узнать подробнее про приложение'>подробнее</a>",
                "depend" => "нет зависимостей",
            ),
        );
        $this->product_custom = array(
            "h3-1" => "Тематические ветки",
            "h3-2" => "Core - ветки",
        );
    }
}