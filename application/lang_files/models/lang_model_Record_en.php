<?php
class lang_model_Record_en extends lang_model_en
{
    public $updateRecord = array(
        "success" => "updateRecord query success",
        "fail" => "updateRecord query fail",
        "nothing" => "nothing changed",
    );
    public $insertRecord = array(
        "success" => "insertRecord success",
        "fail" => "insertRecord fail",
    );
    public $copyRecord = array(
        "fail" => "copy record fail",
    );
    public $table_name_rm_err = "table name not set in RecordModel";
    public $table_name_not_found = "table name not found in database (RecordModel)";
}