<?php
include "application/views/products/view_jointpass.php";
class view_products extends view_jointpass
{

    function __construct()
    {

        parent::__construct();

        $this->logo = 'img/popimg/dev-logo.png';
        $this->styles[] = "css/products/prod-main.css";

        $this->lang_map["head"]["description"] = array(
            "en" => "My products: jointPass - passwords organizer.",
            "rus" => "Мои продукты: jointPass - органайзер паролей.",
        );

        $this->lang_map["head"]["h1"] = array(
            "en" => "My products",
            "rus" => "Мои продукты",
        );
        $this->lang_map["head"]["title"] = array(
            "en" => "My products - for free",
            "rus" => "Мои продукты - бесплатно",
        );

        $this->lang_map["jointsite"] = array(
            "title" => array(
                "en" => "joint-site",
                "rus" => "Web - Сайт",
            ),
            "img-1" => "img/popimg/internet.png",
            "img-2" => "img/popimg/music-logo.png",
            "p1" => array(
                "en" => "adasdwdwdwed",
                "rus" => "Двуязычный сайт (как этот) с меню в модальном окне. Технологии: php, js. Шаблон: MVC. ".
                    "Структуру модели можно описать в виде массивов полей или получить автоматически из базы данных. ".
                    "Модуль описывает связанные таблицы мастер - подчиненные для групповых операций поиска и удаления.",
            ),
            "p2" => array(
                "en" => "adasdwdwdwed",
                "rus" => "Ветка Управление сайтом (Модуль) предназначена для быстрого старта новых модулей, ".
                    "включает авторизацию и настройку ролей пользователя, личный кабинет и уведомления.",
            ),
            "p3" => array(
                "en" => "adasdwdwdwed",
                "rus" => "Репозиторий проекта содержит тематические ветки.",
            ),
            "p4" => array(
                "en" => "adasdwdwdwed",
                "rus" => "<ul>".
                    "<li>Admin - утилита для работы с mysql базой данных и записями в таблицах</li>".
                    "<li>Music - простейшая музыкальная галлерея чтоб хранить и слушать несколько альбомов любимых трэков</li>".
                    "</ul>",
            ),
            "a_title" => array(
                "en" => "adasdwdwdwed",
                "rus" => "Описание и установка",
            ),
            "a_text" => array(
                "en" => "adasdwdwdwed",
                "rus" => "Смотреть",
            ),
            "arrow" => array(
                "en" => "adasdwdwdwed",
                "rus" => "Узнать больше",
            ),
        );
    }

    function print_page_content()
    {
        echo"<div class='contentBlock-frame'><div class='contentBlock-center dark'>".
            "<div class='contentBlock-wrap'>";


        $this->print_jointPass();
        //echo $promoteBlock_txt;


        $promoteBlock_txt = "<div class='promote-block'>".
            "<div class='promote-block-title'>".
            "<div class='pbt-header'>".$this->lang_map["jointsite"]['title'][$_SESSION["lang"]]."</div>".
            "<div class='pbt-numbers'><span>php</span><span>js</span><span>mvc</span></div>".
            "</div>".
            "<div class='promote-block-content'>".
            "<div class='pbc-line f-left'>".
            "<img src='".$this->lang_map["jointsite"]["img-1"]."'>".
            "<p>".
            $this->lang_map["jointsite"]["p1"][$_SESSION["lang"]].
            "</p>".
            "<p>".
            $this->lang_map["jointsite"]["p2"][$_SESSION["lang"]].
            "</p>".
            "</div>".
            "<div class='pbc-line f-right'>".
            "<img src='".$this->lang_map["jointsite"]["img-2"]."'>".
            "<p>".
            $this->lang_map["jointsite"]["p3"][$_SESSION["lang"]].
            "</p>".
            "<p>".
            $this->lang_map["jointsite"]["p4"][$_SESSION["lang"]].
            "</p>".
            "</div>".

            "</div>".
            "<div class='promote-block-order'>".
            "<div class='pbo-ctrl'><a href='/products/jointsite' class='pbo-ctrl-feedback' ".
            "title='".$this->lang_map["jointsite"]["a_title"][$_SESSION["lang"]]."'><img src='/img/popimg/eye-icon.png'>".
            $this->lang_map["jointsite"]["a_text"][$_SESSION["lang"]]."</a></div>".
            "<div class='pbo-txt'><div class='pbc-arrow'></div>".$this->lang_map["jointsite"]["arrow"][$_SESSION["lang"]]."</div>".
            "</div>".
            "</div>";
        // echo $promoteBlock_txt;
        echo "</div></div></div>";

    }
}