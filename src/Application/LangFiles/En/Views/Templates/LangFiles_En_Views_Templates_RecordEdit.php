<?php
class LangFiles_En_Views_Templates_RecordEdit extends LangFiles_en_Views_View
{
    public $view_submit_val = "Update";
    public $view_submit_val_new = "New";
    public $view_submit_val_del = "Delete";

    function update_head_array($options)
    {
        if($options["type"] == "edit"){
            $txt_rus = "Edit";

            $this->view_submit_val = "Update";

        }elseif ($options["type"] == "new"){
            $txt_rus = "Create";
            $this->view_submit_val = $this->view_submit_val_new;
        }elseif ($options["type"] == "delete"){
            $txt_rus = "Delete";
            $this->view_submit_val = $this->view_submit_val_del;
        }

        $this->head["description"] = $txt_rus." record in table";
        $this->head["title"] = $txt_rus." record in table ".$options["h2"];
        $this->head["h1"] = $txt_rus." record in table ".$options["h2"];
    }
}