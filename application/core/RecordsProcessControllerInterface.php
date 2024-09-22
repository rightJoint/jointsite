<?php
interface RecordsProcessControllerInterface
{
    public function records_process():bool;

    public function checkRecordModel():bool;

    //public function action_listview($process_path, $view_data = null);
}