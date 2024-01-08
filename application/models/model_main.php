<?php
class Model_Main extends Model
{
    public $lang_map = array(
        "main_page_text" => array(
            "en" => "Thanks for use my software",
            "rus" => "Спасибо что пользуетесь моими программами"
        )
    );

    function get_data()
    {
        return $this->lang_map["main_page_text"][$_SESSION["lang"]];
    }

    function throwErrNoConn()
    {
        return true;
    }
}