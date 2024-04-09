<?php
class view_jointpass extends View
{
    function __construct()
    {
        $this->styles[] = "css/products/prod-main.css";
        $this->lang_map["jointpass"] = array(
            "title" => array(
                "en" => "joint-pass",
                "rus" => "Джойнт Пасс",
            ),
            "img-1" => "img/popimg/jointPass.png",
            "img-2" => "img/Products/encrypt-img.png",
            "p1" => array(
                "en" => "Passwords organizer. No needs keep in mind all passwords of yours accounts, remember only one Master Pass of this app. ",
                "rus" => "Органайзер паролей. ".
                    "Вам не придется помнить пароли от всех ваших учеток, достаточно помнить один МастерПасс от программы. ",
            ),
            "p2" => array(
                "en" => "Tap on account row in grid and buttons to copy clipboard login and password just appear on filter panel. ".
                    "All data store encrypted in yor disk. You may sort out your accounts by groups and categories.",
                "rus" => "Нажмите на учетку в таблице и кнопки копирования логина и пароля сразу доступны на панели. ".
                    "Все данные шифруются и хранятся на вашем диске. Вы можете распределить ваши учетки на группы и категории.",
            ),
            "p3" => array(
                "en" => "In addition two predefined fields (login and password) you may add custom fields, attach to that images, turn on encryption. ".
                    "Account may contain any unique fields.",
                "rus" => "Кроме двух предустановленных полей (логин и пароль) вы можете создать собственные, добавить к ним изображения и включить шифрование. ".
                    "К учетке можно добавлять любое количество уникальных полей.",
            ),
            "p4" => array(
                "en" => "Watch when your password was last updated just sort them in grid by date. ".
                    "Your may migrate you data to use on another PC. ".
                    "It is possible to change MasterPass, app re-crypt data.",
                "rus" => "Следите за обновлением паролей просто отсортировав учетки в таблице по дате обновления. ".
                    "Вы можете скопировать данные программы чтоб перенести на другой ПК. ".
                    "Мастер Пас можно менять, программа перешифрует данные.",
            ),
            "a_title" => array(
                "en" => "get app jointPass",
                "rus" => "скачать приложение jointPass",
            ),
            "a_text" => array(
                "en" => "Download",
                "rus" => "Скачать",
            ),
            "arrow" => array(
                "en" => "learn more",
                "rus" => "Узнать больше",
            ),
            "h2" => array(
                "en" => "My products - freeware",
                "rus" => "Мои продукты - бесплатно",
            ),
        );
    }

    function print_page_content()
    {
        echo"<div class='contentBlock-frame'><div class='contentBlock-center dark'>".
            "<div class='contentBlock-wrap'>";
        $this->print_jointPass();
        echo "</div></div></div>";
    }

    function print_jointPass()
    {
        $promoteBlock_txt = "<h2 style='color: silver; margin-top: 1em'>".$this->lang_map["jointpass"]["h2"][$_SESSION["lang"]]."</h2>".
            "<div class='promote-block'>".
            "<div class='promote-block-title'>".
            "<div class='pbt-header'>".$this->lang_map["jointpass"]['title'][$_SESSION["lang"]]."</div>".
            "<div class='pbt-numbers'><span>c#</span><span>wpf</span></div>".
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
    }
}