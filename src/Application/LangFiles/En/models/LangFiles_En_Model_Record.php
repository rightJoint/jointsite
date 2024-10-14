<?php
class LangFiles_En_Model_Record extends lang_model
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
    public $file_err = array(
        "unlink_err" => "unlink error in ModuleRecordsModel.php",
        "mvf_err_extension" => "cant move extension",
        "mvf_err_load" => "load error in ModuleRecordsModel.php",
        "form_h2" => "main info",
    );
}