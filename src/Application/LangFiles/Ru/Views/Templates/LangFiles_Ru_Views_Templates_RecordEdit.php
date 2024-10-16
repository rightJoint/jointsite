<?php
class LangFiles_Ru_Views_Templates_RecordEdit extends LangFiles_Ru_Views_View
{
    public $view_submit_val = "Обновить";
    public $view_submit_val_new = "Создать";
    public $view_submit_val_del = "Удалить";

    function update_head_array($options)
    {
        if($options["type"] == "edit"){
            $txt_rus = "Редактирование";
        }elseif ($options["type"] == "new"){
            $txt_rus = "Создание";
            $this->view_submit_val = $this->view_submit_val_new;
        }elseif ($options["type"] == "delete"){
            $txt_rus = "Удаление";
            $this->view_submit_val = $this->view_submit_val_del;
        }

        $this->head["description"] = $txt_rus." записи в таблице";
        $this->head["title"] = $txt_rus." записи в таблице ".$options["h2"];
        $this->head["h1"] = $txt_rus." записи в таблице ".$options["h2"];
    }
}
