<?php
namespace jointSite\core\Interfaces;
interface RecordsControllerInterface
{
    public function action_detailview();

    public function action_listview();

    public function action_editview();

    public function action_deleteview();

    public function action_newview();

    public function checkRecordModel();

    public function process_detail();

    public function process_list();

    public function makeSlaveRequest();

    public function exec_list($reqArr = null):array;

    public function exec_detail($reqArr = null):array;

    public function exec_edit($reqArr):array;

    public function exec_new($reqArr):array;

    public function exec_delete($reqArr):array;

}