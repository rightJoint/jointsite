<?php
class LangFiles_En_RecordModel extends LangFiles_En_Model
{
    public $updateRecord = array(
        'success' => 'Update record success',
        'fail' => 'Update record fail',
        'nothing' => 'Nothing changed',
    );
    public $insertRecord = array(
        'success' => 'Create record success',
        'fail' => 'Create record fail',
    );
    public $copyRecord = array(
        'fail' => 'Copy record fail',
    );
    public $table_name_rm_err = 'table name does not set RecordModel';
    public $table_name_not_found = 'table name not found in database (ModelRecord)';
    public $file_err = array(
        'unlink_err' => 'delete error ModuleRecordsModel.php',
        'mvf_err_extension' => 'cant load extension file',
        'mvf_err_load' => 'load error in ModuleRecordsModel.php',
        'form_h2' => 'main info',
    );
}