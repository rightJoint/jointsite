<?php
class adminMainView extends AdminView
{
    function __construct()
    {
        $this->styles[] = "/css/admin/startView.css";

        $this->lang_map["head"]["description"] = array(
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
        );
        $this->lang_map["head"]["title"] = array(
            "en" => "MySql Admin",
            "rus" => "Админка для mysql",
        );
        $this->lang_map["head"]["h1"] = array(
            "en" => "MySql Admin",
            "rus" => "Админка для mysql"
        );

        $this->lang_map["admin_h2"] = array(
            "en" => "Use menu for beginning",
            "rus" => "Воспользуйтесь меню для начала"
        );
    }

    function print_page_content()
    {
        echo  "<div class='contentBlock-frame admin-main'><div class='contentBlock-center'><div class='contentBlock-wrap'>".
            "<h2>".$this->lang_map["admin_h2"][$_SESSION["lang"]]."</h2><div class='contentMenu'>";
        foreach ($this->lang_map["admin_block"]["modules_list"] as $admin_mod=>$mod_opt){
            echo "<div class='contentCell'>".
                "<div class='contentCell-img'>".
                "<img src='".$this->img_for_modules["$admin_mod"]."'>".
                "</div><div class='contentCell-text'>".
                "<a href='/admin/".$admin_mod."/'>".$mod_opt["aliasMenu"][$_SESSION["lang"]]."</a>".
                "<p>".$mod_opt["altText"][$_SESSION["lang"]]."</p></div></div>";
        }
        echo "</div>".
            "</div></div></div>";
    }
}