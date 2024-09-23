<?php
interface RecordsControllerInterface extends RecordsProcessControllerInterface
{
    public function action_detailview();

    public function action_listview();

    public function action_editview();

    public function action_deleteview();

    public function action_newview();
}