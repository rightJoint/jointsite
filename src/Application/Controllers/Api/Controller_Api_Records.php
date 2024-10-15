<?php

namespace JointSite\Controllers\Api;

use JointSite\Core\Controller;
use JointSite\Core\Records\RecordsModel;

class Controller_Api_Records extends Controller
{
    function checkAccessController():bool
    {
        if(file_exists(JOINT_SITE_CONF_DIR."/api/access_token.txt")){

            $rest_access_token = null;

            if(isset($_GET["rest_access_token"]) and $_GET["rest_access_token"] !=null){
                $rest_access_token = $_GET["rest_access_token"];
            }elseif (isset($_POST["rest_access_token"]) and $_POST["rest_access_token"] !=null){
                $rest_access_token = $_POST["rest_access_token"];
            }

            if($rest_access_token!= null and
                $rest_access_token == trim(file_get_contents(JOINT_SITE_CONF_DIR."/api/access_token.txt"))){
                return true;
            }
        }
        return false;
    }

    function action_index()
    {
        if($this->checkAccessController()){
            global $request;

            $this->model = new RecordsModel();
            $this->view->header_content_type = "application/json; charset=utf-8";

            $this->model->tableName = $request["routes_ns"][3];
            if($this->model->getRecordStructure()){

                switch ($_SERVER['REQUEST_METHOD']) {
                    case "GET":
                        $this->listRecords();
                        break;
                    case "POST":
                        $this->updateRecord();
                        break;
                    case 'PUT':
                        $this->putRecord();
                        break;
                    case 'DELETE':
                        $this->deleteRecord();
                        break;
                }
            }else{
                $this->logger->alert("Controller_Api_Records throw err: cant find table db_name '".$this->model->conn_db."'".
                    " table_name='".$this->model->tableName."'", $this->logger->logger_context);
                echo "fail";
            }
        }else{
            $this->view->generateJson(array("result" => false, "info" => "Controller_Api_Records->checkAccessController ".
            "return false"));
        }
    }

    function listRecords()
    {
        $this->model->copyValFromRequest($_GET);
        $sup_cond = $this->model->filterWhere($_GET);

        $list_records = array(
            "count" => $this->model->countRecords($sup_cond["where"], $sup_cond["having"]),
            "list" => $this->model->listRecords($sup_cond["where"], $sup_cond["order"], $sup_cond["limit"], $sup_cond["having"]),
        );

        $this->view->generateJson($list_records);
    }

    function updateRecord()
    {
        $result = array(
            "result" => false,
            "info" => "",
        );
        parse_str($_SERVER["QUERY_STRING"], $REQ_ARR);

        $this->model->copyValFromRequest($REQ_ARR);

        if($this->model->copyRecord()){
            $this->model->copyValFromRequest($REQ_ARR);
            if($this->model->updateRecord()){
                $result["result"] = true;
                $result["info"] = "Success: ".$this->model->log_message;

            }else{
                $result["info"] = "cant update record: ".$this->model->log_message;
            }
        }else{
            $result["info"] = "cant find record to update";
        }
        $this->view->generateJson($result);
    }

    function putRecord()
    {
        $result = array(
            "result" => false,
            "info" => "",
        );
        parse_str($_SERVER["QUERY_STRING"], $REQ_ARR);

        $this->model->copyValFromRequest($REQ_ARR);

        if($this->model->insertRecord()){
            $result["result"] = true;
            $result["info"] = "Success: ".$this->model->log_message;

        }else{
            $result["info"] = "cant update record: ".$this->model->log_message;
        }

        $this->view->generateJson($result);
    }

    function deleteRecord()
    {
        $result = array(
            "result" => false,
            "info" => "",
        );

        parse_str($_SERVER["QUERY_STRING"], $REQ_ARR);

        $this->model->copyValFromRequest($REQ_ARR);

        if($this->model->copyRecord()){
            if($this->model->deleteRecord()){
                $result["result"] = true;
                $result["info"] = "Success: ".$this->model->log_message;

            }else{
                $result["info"] = "cant delete record: ".$this->model->log_message;
            }
        }else{
            $result["info"] = "cant find record to delete";
        }
        $this->view->generateJson($result);
    }
}