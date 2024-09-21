<?php
interface RecordsControllerInterface
{
    public function records_process():bool;

    public function checkRecordModel():bool;
}