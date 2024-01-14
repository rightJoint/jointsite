<?php
class validateView extends View
{
    public $logo = "/img/popimg/checkinNow.png";
    public $shortcut_icon = "/img/popimg/checkinNow.png";

    function __construct()
    {
        $this->lang_map["head"]["title"] = array(
            "en" => "Validation on site",
            "rus" => "Валидация на сайте",
        );
        $this->lang_map["head"]["description"] = array(
            "en" => "Validation on site",
            "rus" => "Валидация на сайте",
        );
        $this->lang_map["head"]["h1"] = array(
            "en" => "email validation",
            "rus" => "подтверждение email",
        );
        $this->lang_map["vld_login"] = array(
                "en" => "login",
                "rus" => "логин",
        );
        $this->lang_map["vld_alias"] = array(
            "en" => "alias",
            "rus" => "псевдоним",
        );
        $this->lang_map["vld_success"] = array(
            "en" => "success",
            "rus" => "успешно",
        );
        $this->lang_map["vld_txt_1"] = array(
            "en" => "validation for user",
            "rus" => "Валидация для пользователя",
        );
        $this->lang_map["vld_txt_2"] = array(
            "en" => "validation had success at",
            "rus" => "Валидация уже была дата",
        );
        $this->lang_map["vld_txt_3"] = array(
            "en" => "Use menu to sign in site",
            "rus" => "Используйте меню чтоб войти на сайт ",
        );
    }

    function print_page_content()
    {
        echo "<div class='contentBlock-frame'><div class='contentBlock-center'>".
            "<div class='contentBlock-wrap'>";
        if($this->view_data["status"]){
            echo "<p>".$this->lang_map["vld_txt_1"][$_SESSION["lang"]]." ".
                $this->lang_map["vld_login"][$_SESSION["lang"]].": ".
                $this->view_data["accLogin"]." (".$this->lang_map["vld_alias"][$_SESSION["lang"]].": ".
                $this->view_data["accAlias"].") ".$this->lang_map["vld_success"][$_SESSION["lang"]].".</p>".
            "<p>".$this->lang_map["vld_txt_3"][$_SESSION["lang"]]."</p>";
        }else{
            echo "<p>".$this->lang_map["vld_txt_2"][$_SESSION["lang"]]." ".$this->view_data["validDate"]." for user ".$this->lang_map["vld_login"][$_SESSION["lang"]].
                ": ".$this->view_data["accLogin"]." (".$this->lang_map["vld_alias"][$_SESSION["lang"]].": ".$this->view_data["accAlias"].")".
                "<p>Use menu to sign in site</p>";
        }

        echo "</div></div></div>";
    }
}