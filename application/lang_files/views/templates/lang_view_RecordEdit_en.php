<?php
class lang_view_RecordEdit_en extends lang_view_en
{
    public $view_submit_val = "Update";

    function update_head_array($options)
    {
        if($options["type"] == "edit"){
            $txt_en = "Edit";
            $this->view_submit_val = "Update";

        }elseif ($options["type"] == "new"){
            $txt_en = "Create";
            $this->view_submit_val = "Create";
        }

        $this->head["description"] = $txt_en." record in table";
        $this->head["title"] = $txt_en." view in table ".$options["h2"];
        $this->head["h1"] = $txt_en." view in table ".$options["h2"];
    }
}