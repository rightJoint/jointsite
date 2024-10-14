<?php
class lang_view_RecordDetail extends lang_view
{
    public $del_confirm_btn = null;
    public $del_confirm_txt = null;

    function update_head_array($options = null)
    {
        if($options["type"] == "detail"){
            $txt_rus = "Просмотр записи в таблице";
        }elseif ($options["type"] == "delete"){
            $txt_rus = "Удаление записи из таблицы";
        }
        $this->head["description"] =$txt_rus;
        $this->head["title"] = $txt_rus." ".$options["h2"];
        $this->head["h1"] = $txt_rus." ".$options["h2"];

        $this->del_confirm_btn = "Удалить";
        $this->del_confirm_txt = "Подтвердите удаление записи";
    }
}
