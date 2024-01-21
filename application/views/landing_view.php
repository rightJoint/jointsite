<?php
class landing_view extends View
{
    function __construct()
    {
        $this->lang_map["stab_landing"] = array(
            "en" => "Reconstruction, updates come out soon",
            "rus" => "Реконструкция, обновления скоро выйдут",
        );
        $this->lang_map["head"]["h1"] = array(
            "en" => "Reconstruction",
            "rus" => "Реконструкция",
        );
    }

    function print_page_content()
    {
        echo $this->lang_map["stab_landing"][$_SESSION["lang"]];
    }
}