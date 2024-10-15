<?php

namespace JointSite\Core\Records;

use JointSite\Core\Controller;
use JointSite\Core\Interfaces\RecordsControllerInterface;
use JointSite\Core\Logger\JointSiteLogger;
use JointSite\Views\Templates\RecordListView;
use JointSite\Views\Templates\RecordDetailView;
use JointSite\Views\Templates\RecordEditView;

class RecordsController extends Controller implements RecordsControllerInterface
{

    public $process_table = null; //when use RecordsModel by default without loaded custom model
    public $process_url;
    public $view_data;

    function __construct(string $loaded_model, string $loaded_view, string $action_name)
    {
        parent::__construct($loaded_model, $loaded_view, $action_name);
        if(isset($this->model->tableName)){
            $this->process_table = $this->model->tableName;
        }

        if(!$this->process_table){
            $this->logger->error("RecordsProcessController throw err: cant set up process_table - null", $this->logger->logger_context);
        }
    }

    function loadLangControllerCustom():string
    {
        require_once (JOINT_SITE_REQ_LANG."/Controllers/LangFiles_".JOINT_SITE_NS_LANG."_Controllers_RecordsController.php");
        $return_lang = "LangFiles_".JOINT_SITE_NS_LANG."_Controllers_RecordsController";

        return $return_lang;
    }

    private function records_process():bool
    {
        if(!$this->checkRecordModel())
        {
            return false;
        }

        global $request;

        $pp_exp = explode("/", $this->process_url);
        $pp_cnt = count($pp_exp);

        if (!isset($request["routes_ns"][$pp_cnt]) or
            $request["routes_ns"][$pp_cnt] == null or
            $request["routes_ns"][$pp_cnt] == "listview") {
            $this->checkTemplateView("list");
            $this->view->process_url = $this->process_url;
            $this->view->view_data = $this->view_data;

            $this->processList();

        } elseif ($request["routes_ns"][$pp_cnt] == "detailview") {
            $this->checkTemplateView("detail");
            $this->view->view_data = $this->view_data;
            $this->view->action_log = $this->exec_detail($_GET);
            if ($this->view->action_log["result"]) {
                $this->process_detail();

            } else {
                $this->logger->emergency($this->lang_map->rc_errors["prefix"] .
                    $this->lang_map->rc_errors["detail"] . ", " .
                    $this->lang_map->rc_errors["model_err"] .
                    $this->model->log_message,
                $this->logger->logger_context);
            }

        } elseif ($request["routes_ns"][$pp_cnt] == "editview") {
            $this->checkTemplateView("edit");
            $this->view->view_data = $this->view_data;
            if (isset($_POST["submit"]) and $_POST["submit"] == $this->view->lang_map->view_submit_val) {
                $this->view->action_log = $this->exec_edit($_POST);
                $this->model->copyCustomFields();
            } else {
                $this->model->copyValFromRequest($_GET);
                if (!$this->model->copyRecord()) {
                    $this->logger->emergency($this->model->log_message,
                        $this->logger->logger_context);
                }
            }

            $this->view->editFields = $this->model->recordStructureFields->editFields;

            $this->prepareViewFields();

            $this->view->generate();
        } elseif ($request["routes_ns"][$pp_cnt] == "newview") {
            $this->checkTemplateView("new");
            $this->view->view_data = $this->view_data;
            $this->view->type = "new";
            if (isset($_POST["submit"]) and
                $_POST["submit"] == $this->view->lang_map->view_submit_val_new) {
                $this->view->action_log = $this->exec_new($_POST);
                if ($this->view->action_log["result"]) {
                    $get_str = null;
                    foreach ($this->model->recordStructureFields->record as $fName => $fData) {
                        if ($fData["indexes"] == true) {
                            $get_str .= $fName . "=" . $fData["curVal"] . "&";
                        }
                    }
                    $get_str = substr($get_str, 0, strlen($get_str) - 1);
                    header("Location: " . $this->process_url . "/editview?" . $get_str);
                }
            }

            $this->view->editFields = $this->model->recordStructureFields->editFields;

            $this->prepareViewFields();

            $this->view->generate();

        } elseif ($request["routes_ns"][$pp_cnt] == "deleteview") {
            $this->model->copyValFromRequest($_GET);
            if ($this->model->copyRecord()) {
                $this->checkTemplateView("delete");
                $this->view->view_data = $this->view_data;
                $this->view->type = "delete";

                if (isset($_POST["submit"]) and
                    ($_POST["submit"] == $this->view->lang_map->view_submit_val_del)) {
                    $this->view->action_log = $this->exec_delete($_POST);
                    if ($this->view->action_log["result"]) {
                        header("Location: " . $this->process_url);
                    }
                }
                $this->view->editFields = $this->model->recordStructureFields->editFields;
                $this->prepareViewFields();
                $this->view->generate();
            } else {
                $this->logger->debug($this->model->log_message, $this->logger->logger_context);
            }
        } elseif (!$this->doAction_custom($request["routes_ns"][$pp_cnt])) {
            return $this->logger->debug("no custom actions in RecordsController: ".$request["routes_ns"][$pp_cnt], $this->logger->logger_context);
        }
        return true;
    }

    function process_detail()
    {
        $this->view->viewFields = $this->model->recordStructureFields->viewFields;

        $this->prepareViewFields($this->process_url);

        $this->view->generate();
    }

    function processList()
    {
        $this->view->list_frame_id = $this->model->tableName;

        if (isset($_POST["curPage"])) {
            $this->view->curPage = $_POST["curPage"];
        }

        if (isset($_POST["onPage"])) {
            $this->view->onPage = $_POST["onPage"];
        }


        $this->model->copyValFromRequest($_POST);
        $sup_cond = $this->model->filterWhere($_POST);

        $list_records = array(
            "count" => $this->model->countRecords($sup_cond["where"], $sup_cond["having"]),
            "list" => $this->model->listRecords($sup_cond["where"], $sup_cond["order"], $sup_cond["limit"], $sup_cond["having"]),
        );



        $this->view->listCount = $list_records["count"];
        $this->view->listFields = $this->model->recordStructureFields->listFields;
        $this->view->listRecords = $list_records["list"];

        if (isset($_POST["applyFilterRec"])) {
            $listJson = array(
                "listView" => $this->view->listViewTable(),
                "pgView" => $this->view->listPgView(),
                "jsCtrlPanel" => $this->view->scriptListViewCrtlPannel(),
            );

            //echo "<pre>";
            //print_r($listJson["pgView"]);
            //exit;

            $this->view->generateJson($listJson);
        } else {

            $this->view->searchFields = $this->model->recordStructureFields->searchFields;
            $this->view->generate();
        }
    }

    function doAction_custom(string $action_name)
    {
        return false;
    }

    public function exec_detail($reqArr = null):array
    {
        $this->checkRecordModel();
        $this->model->copyValFromRequest($reqArr);
        return array(
            "result" => $this->model->copyRecord(),
            "log" => $this->model->log_message,
            "record" => $this->model->recordStructureFields->record,
        );
    }

    public function exec_edit($reqArr):array
    {
        $this->checkRecordModel();
        $this->model->copyValFromRequest($reqArr);
        if ($this->model->copyRecord()) {
            $this->model->copyValFromRequest($reqArr);
            return array(
                "result" => $this->model->updateRecord(),
                "log" => $this->model->log_message,
            );
        } else {
            return array(
                "result" => false,
                "log" => $this->model->log_message,
            );
        }

    }

    public function exec_new($reqArr):array
    {
        $this->checkRecordModel();
        $this->model->copyValFromRequest($reqArr);
        return array(
            "result" => $this->model->insertRecord(),
            "log" => $this->model->log_message,
        );
    }

    public function exec_delete($reqArr):array
    {
        $this->checkRecordModel();
        $this->model->copyValFromRequest($reqArr);
        return array(
            "result" => $this->model->deleteRecord(),
            "log" => $this->model->log_message,
        );
    }

    /*if custom model mot loaded*/
    function checkRecordModel():bool
    {

        if(!$this->model instanceof RecordsModel) {
            require_once JOINT_SITE_REQUIRE_DIR."/Core/Records/RecordsModel.php";
            $this->model = new RecordsModel($this->process_table);
        }
        if($this->model->connect_database_status){
            if($this->model->pdoQuery("SHOW TABLES LIKE '".$this->process_table."'")->fetch(\PDO::FETCH_ASSOC)){
                return true;
            }else{
                return $this->logger->emergency("RecordProcessController->checkRecordModel throw err: cant find target table = ".$this->process_table.
                    " in database ".$this->model->conn_db, $this->logger->logger_context);
            }
        }else{
            return $this->logger->emergency("request", $this->logger->logger_context);
        }
    }

    //if custom view not loaded
    function checkTemplateView($type_of_view)
    {
        if($type_of_view == "list"){
            if(!$this->view instanceof RecordListView) {
                $this->view = new RecordListView();
            }
        }elseif ($type_of_view == "detail"){
            if(!$this->view instanceof RecordDetailView) {
                $this->view = new RecordDetailView();
            }
        }
        elseif (in_array($type_of_view, array("edit", "new", "delete"))){
            if(!$this->view instanceof RecordEditView) {
                $this->view = new RecordEditView();
            }
        }
    }

    function prepareViewFields()
    {
        $this->view->record = $this->model->recordStructureFields->record;
        if($this->model->modelAliases[JOINT_SITE_LW_LANG]){
            $this->view->h2=$this->model->modelAliases[JOINT_SITE_LW_LANG];
        }else{
            $this->view->h2 = $this->model->tableName;
        }
        $this->view->process_url = $this->process_url;
    }

    function action_filldatalist()
    {
        $req_where = json_decode($_GET["where"], true);
        $fdl_where = $this->model->filterWhere($req_where);

        $fdl_listRecords = $this->model->listRecords($fdl_where["where"]);

        if($_GET["findField"] and $_GET["returnKey"]){
            $list_return = array("" => "");
            if($fdl_listRecords){
                foreach ($fdl_listRecords as $list_num => $list_row){
                    $list_return[$list_row[$_GET["returnKey"]]] = $list_row[$_GET["findField"]];
                }
            }
        }else{
            $list_return = array(
                "error" => "fields not set",
            );
        }
        $this->view->generateJson($list_return);
    }

    function action_index()
    {
        $this->records_process();
    }

    function action_detailview()
    {
        $this->records_process();
    }

    function action_listview()
    {
        $this->records_process();
    }

    function action_editview()
    {
        $this->records_process();
    }

    function action_deleteview()
    {
        $this->records_process();
    }
    function action_newview()
    {
        $this->records_process();
    }

}