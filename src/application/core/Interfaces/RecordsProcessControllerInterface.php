<?php
interface RecordsProcessControllerInterface
{
    public function records_process():bool;

    public function checkRecordModel();

    public function process_detail();

    public function process_list();

    public function makeSlaveRequest();

    public function exec_list($reqArr = null):array;

    public function exec_detail($reqArr = null):array;

    public function exec_edit($reqArr):array;

    public function exec_new($reqArr):array;

    public function exec_delete($reqArr):array;

    //public function action_listview($process_path, $view_data = null);
}