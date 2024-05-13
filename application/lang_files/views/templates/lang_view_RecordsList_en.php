<?php
class lang_view_RecordsList_en extends lang_view_en
{
    public $list_table = array(
        "found" => "Found",
        "list_by" => "display by",
        "sort" => "sort field",
        "new" => "New one",
        "btn_apply" => "applyFilterForm",
        "cell_view" => "View",
        "cell_del" => "Del",
        "cell_edit" => "Edit",
        "btn_clear" => "Clear",
    );

    function set_head_array($options)
    {
        $this->head["description"] = "Records list, find records in table";
        $this->head["title"] = "Records list - ".$options["h2"];
        $this->head["h1"] = "Records list in ".$options["h2"];
    }
}