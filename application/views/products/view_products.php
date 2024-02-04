<?php
class view_products extends View
{

    function __construct()
    {

        $this->logo = 'img/popimg/dev-logo.png';
        $this->styles[] = "css/products/prod-main.css";

        $this->lang_map["head"]["h1"] = array(
            "en" => "My products",
            "rus" => "Мои продукты",
        );
        $this->lang_map["head"]["title"] = array(
            "en" => "My products - free",
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
                    "Модуль описыват связанные таблицы мастер - подчиненные для групповых операций поиска и удаления.",
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
        $this->lang_map["jointpass"] = array(
            "title" => array(
                "en" => "joint-pass",
                "rus" => "Джойнт Пасс",
            ),
            "img-1" => "img/popimg/jointPass.png",
            "img-2" => "img/Products/encrypt-img.png",
            "p1" => array(
                "en" => "adasdwdwdwed",
                "rus" => "Органайзер паролей. ".
                    "Вам не придется помнить пароли от всех ваших учеток, достаточно помнить один МастерПасс от программы. ",
            ),
            "p2" => array(
                "en" => "adasdwdwdwed",
                "rus" => "Нажмите на учетку в таблице и кнопки копирования логина и пароля сразу доступны на панели. ".
                    "Все данные шифруются и хранятся на вашем диске. Вы можете распределить ваши учетки на группы и категории.",
            ),
            "p3" => array(
                "en" => "adasdwdwdwed",
                "rus" => "Кроме двух предустановленных полей (логин и пароль) вы можете создать собственные, добавить к ним изображения и включить шифрование. ".
                    "К учетке можно добавлять любое количество уникальных полей.",
            ),
            "p4" => array(
                "en" => "adasdwdwdwed",
                "rus" => "Следите за обновлением паролей просто отсортировав учетки в таблице по дате обновления. ".
                    "Вы можете скопировать данные программы чтоб перенести на другой ПК. ".
                    "Мастер Пас можно менять, программа перешифрует данные.",
            ),
            "a_title" => array(
                "en" => "adasdwdwdwed",
                "rus" => "скачать приложение jointPass",
            ),
            "a_text" => array(
                "en" => "adasdwdwdwed",
                "rus" => "Скачать",
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

        $promoteBlock_txt = "<div class='promote-block'>".
            "<div class='promote-block-title'>".
            "<div class='pbt-header'>".$this->lang_map["jointpass"]['title'][$_SESSION["lang"]]."</div>".
            "<div class='pbt-numbers'><span onclick='promoteBlock(1)'>c#</span><span  onclick='promoteBlock(2)'>wpf</span></div>".
            "</div>".
            "<div class='promote-block-content'>".
            "<div class='pbc-line f-left'>".
            "<img src='".$this->lang_map["jointpass"]["img-1"]."'>".
            "<p>".
            $this->lang_map["jointpass"]["p1"][$_SESSION["lang"]].
            "</p>".
            "<p>".
            $this->lang_map["jointpass"]["p2"][$_SESSION["lang"]].
            "</p>".
            "</div>".
            "<div class='pbc-line f-right'>".
            "<img src='".$this->lang_map["jointpass"]["img-2"]."'>".
            "<p>".
            $this->lang_map["jointpass"]["p3"][$_SESSION["lang"]].
            "</p>".
            "<p>".
            $this->lang_map["jointpass"]["p4"][$_SESSION["lang"]].
            "</p>".
            "</div>".

            "</div>".
            "<div class='promote-block-order'>".
            "<div class='pbo-ctrl'><a href='/products/jointpass' class='pbo-ctrl-feedback' ".
            "title='".$this->lang_map["jointpass"]["a_title"][$_SESSION["lang"]]."'><img src='/img/Products/get-jp-icon.png'>".
            $this->lang_map["jointpass"]["a_text"][$_SESSION["lang"]]."</a></div>".
            "<div class='pbo-txt'><div class='pbc-arrow'></div>".$this->lang_map["jointpass"]["arrow"][$_SESSION["lang"]]."</div>".
            "</div>".
            "</div>";
        echo $promoteBlock_txt;


        $promoteBlock_txt = "<div class='promote-block'>".
            "<div class='promote-block-title'>".
            "<div class='pbt-header'>".$this->lang_map["jointsite"]['title'][$_SESSION["lang"]]."</div>".
            "<div class='pbt-numbers'><span onclick='promoteBlock(1)'>php</span><span  onclick='promoteBlock(2)'>js</span><span onclick='promoteBlock(3)'>mvc</span></div>".
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
        echo $promoteBlock_txt;
        echo "</div></div></div>";

    }
}