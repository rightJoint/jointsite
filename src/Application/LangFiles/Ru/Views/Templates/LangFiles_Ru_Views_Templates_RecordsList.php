<?php
class LangFiles_Ru_Views_Templates_RecordsList extends LangFiles_Ru_Views_View
{
    public $list_table = array(
        "found" => "Найдено",
        "list_by" => "Показывать по",
        "sort" => "Сортировка",
        "new" => "Создать запись",
        "btn_apply" => "Применить фильтр",
        "cell_view" => "Смотр.",
        "cell_del" => "Удал.",
        "cell_edit" => "Редакт.",
        "btn_clear" => "Очистить",
    );

    function set_head_array($options)
    {
        $this->head["description"] = "Список записей, найти запиь в таблице";
        $this->head["title"] = "Список записей - ".$options["h2"];
        $this->head["h1"] = "Список записей в ".$options["h2"];
    }
}