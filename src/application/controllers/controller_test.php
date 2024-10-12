<?php
use jointSite\core\RecordsController;
class controller_test extends \jointSite\core\RecordsController
{
    public $process_url = JOINT_SITE_APP_REF."/test/records";
    public $process_table = "migrations";

    function action_index()
    {
        $this->view->generate();
    }

    function action_records()
    {
        $view_data = $this->model->query("SHOW TABLES");

        $rec_url_expl = explode("/", $this->process_url);
        $rec_url_cnt = count($rec_url_expl);
        global $request;

        if(JOINT_SITE_APP_REF!=null){
            $rec_url_cnt--;
        }

        $use_custon_table = false;
        if(isset($request["routes"][$rec_url_cnt]) and $request["routes"][$rec_url_cnt]!= null){
            $tableName = $request["routes"][$rec_url_cnt];
            $use_custon_table = true;
            //echo "YYYY=".$tableName;
            //exit;
        }elseif ($table_row = $view_data->fetch()){
            $tableName =  $table_row[0];
            //one more query cause fetch
            $view_data = $this->model->query("SHOW TABLES");
        }else{
            jointSite::throwErr("request", "no table in database");
        }

        if($use_custon_table){
            $this->process_url.="/".$tableName;
            $this->process_table = $tableName;
        }
        $this->view->process_url = $this->process_url;
        $this->view->view_data = $view_data;
        $this->view->tableName = $tableName;
        $this->view_data = $this->view->print_select_tbl_panel();
        parent::action_index();
    }
}