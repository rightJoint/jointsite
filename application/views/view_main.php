<?php
class view_main extends View
{
    function __construct()
    {
        $this->styles[] = "/css/main_view.css";

        $this->branches = array(
            "admin" => array(
                "href" => "/admin",
                "img" => "/img/popimg/admin-logo.png",
            ),
            "record" => array(
                "href" => "#",
                "img" => "/img/popimg/record.png",
            ),
        );

        $this->lang_map["branches"] = array(
            "h2" => array(
                "en" => "Branches of this site",
                "rus" => "Ветки этого сайта",
            ),
            "branch-version" => array(
                "en" => "Version",
                "rus" => "Версия"
            ),
            "branch-get" => array(
                "en" => "Get branch",
                "rus" => "Скачать ветку"
            ),
            "learn-more" => array(
                "en" => "Learn more",
                "rus" => "Узнать больше"
            ),
            "depend" => array(
                "en" => "Dependences",
                "rus" => "Зависимости"
            ),
            "list" => array(
                "admin" => array(
                    "title" => array(
                        "en" => "mysql admin",
                        "rus" => "Админка для MYSQL",
                    ),
                    "descr" => array(
                        "en" => "With admin tool you can connect to database, ".
                            "load to DB entire tables, execute sql queries, ".
                            "find and edit records in tables. ".
                            "It is completed project, may use for deploy another modules to make ".
                            "needed migrations, might be helpful who dont know another simple way for that",
                        "rus" => "С помощью админки можно подключаться к базе занных, ".
                            "делать копии и вставки таблиц, выполнять sql запросы, ".
                            "искать и редактировать записи в таблицах. ".
                            "Это завершенный проект, можно использовать для развертвания других модулей чтоб ".
                            "провести необходимые миграции в БД, подойдет тех кто не имеет для этого другого простого способа.",
                    ),
                    "version" => array(
                        "en" => "3.01",
                        "rus" => "3.01",
                    ),
                    "get" => array(
                        "en" => "there should be refer - admin",
                        "rus" => "Здесь ссылку откуда скачать - admin",
                    ),
                    "more" => array(
                        "en" => "there should be refer - admin",
                        "rus" => "Здесь ссылку откуда скачать - admin",
                    ),
                    "depend" => array(
                        "en" => "#Record-branch",
                        "rus" => "#ветка Запись",
                    ),
                ),
                "record" => array(
                    "title" => array(
                        "en" => "Record-branch",
                        "rus" => "ветка Запись",
                    ),
                    "descr" => array(
                        "en" => "Include model, controller and views for edit, create, delete and search records in tables. ".
                            "Supports custom models describes record structure as array, and custom views",
                        "rus" => "Модель, контроллер и представленния для работы с записями в таблицах БД, ".
                            "основные операции: правка, добавление, удаление, поиск. ".
                            "Возможно использовать кастомные модели описав структуру записи в таблице ввиде массива, и кастомные представления ",
                    ),
                    "version" => array(
                        "en" => "betta",
                        "rus" => "betta",
                    ),
                    "get" => array(
                        "en" => "there should be refer",
                        "rus" => "Здесь ссылку откуда скачать",
                    ),
                    "more" => array(
                        "en" => "there should be refer",
                        "rus" => "Здесь ссылку откуда скачать",
                    ),
                    "depend" => array(
                        "en" => "no dependences",
                        "rus" => "нет зависимостей",
                    ),
                ),
            ),

            "site-descr" => array(
                "en" => "This is double language web site with modal win menu. Engine: php, js. Pattern: MVC.",
                "rus" => "Двуязычный сайт с меню в модальном окне. Технологии: php, js. Шаблон: MVC.",
            )
        );
    }

    function print_page_content()
    {
        echo "<div class='contentBlock-frame'><div class='contentBlock-center'>".
            "<div class='contentBlock-wrap'>";

        echo $this->print_title();

        echo "<div class='branches-block'>".
            "<h2>".
            $this->lang_map["branches"]["h2"][$_SESSION["lang"]].
            "</h2>";

        foreach ($this->lang_map["branches"]["list"] as $b_name=>$b_info){
            $this->print_branch($b_name, $b_info);
        }
        echo "</div>".
            "</div></div></div>";
    }

    function print_branch($b_name, $b_info)
    {
        echo "<div class='branch-block'>".
            "<div class='branch-img'>".
            "<img src='".$this->branches[$b_name]["img"]."'>".
            "</div>".
            "<div class='branch-main'>".
            "<div class='branch-title'>".
            "<a href='".$this->branches[$b_name]["href"]."'>".
            $b_info["title"][$_SESSION["lang"]].
            "</a>".
            "</div>".
            "<p>".
            $b_info["descr"][$_SESSION["lang"]].
            "</p>".
            "</div>".
            "<div class='branch-info'>".
            "<div class='branch-version'>".
            "<span>".$this->lang_map["branches"]["branch-version"][$_SESSION["lang"]].":</span>".
            $b_info["version"][$_SESSION["lang"]].
            "</div>".
            "<div class='branch-get'>".
            "<span>".$this->lang_map["branches"]["branch-get"][$_SESSION["lang"]].":</span>".
            $b_info["get"][$_SESSION["lang"]].
            "</div>".
            "<div class='learn-more'>".
            "<span>".$this->lang_map["branches"]["learn-more"][$_SESSION["lang"]].":</span>".
            $b_info["more"][$_SESSION["lang"]].
            "</div>".
            "<div class='depend'>".
            "<span>".$this->lang_map["branches"]["depend"][$_SESSION["lang"]].":</span>".
            $b_info["depend"][$_SESSION["lang"]].
            "</div>".
            "</div>".
            "</div>";
    }

    function print_title()
    {
        echo "<p>".
            $this->lang_map["branches"]["site-descr"][$_SESSION["lang"]]."<br>",
            $this->view_data."</p>";
    }
}