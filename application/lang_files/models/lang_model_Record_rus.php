<?php
class lang_model_Record_rus extends lang_model_rus
{
    public $updateRecord = array(
        "success" => "Обновление записи успешно",
        "fail" => "Обновление записи неудачно",
        "nothing" => "Ничего не менялось",
    );
    public $insertRecord = array(
        "success" => "Добавление записи успешно",
        "fail" => "Добавление записи неудачно",
    );
    public $copyRecord = array(
        "fail" => "Копирование записи неудачно",
    );
    public $table_name_rm_err = "Имя таблицы не задано в RecordModel";
    public $table_name_not_found = "Имя таблицы не найдено в базе данных (МодельЗапись)";

}