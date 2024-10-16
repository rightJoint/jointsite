<?php
class LangFiles_En_Views_Templates_RecordDetail extends LangFiles_En_Views_View
{
    function update_head_array($options)
    {
        if($options["type"] == "detail"){
            $txt_en = "View record in table";
        }elseif ($options["type"] == "delete"){
            $txt_en = "Delete record from table";
        }
        $this->head["description"] = $txt_en;
        $this->head["title"] = $txt_en." ".$options["h2"];
        $this->head["h1"] = $txt_en." ".$options["h2"];

        $this->del_confirm_btn = "Delete";
        $this->del_confirm_txt = "Confirm to delete record";
    }
}
