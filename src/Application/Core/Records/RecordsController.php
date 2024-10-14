<?php

namespace JointSite\Core\Records;
use JointSite\Core\Controller;
use JointSite\Core\Interfaces\RecordsControllerInterface;

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
            return jointSite::throwErr("request", "RecordsProcessController throw err: cant set up process_table - null");
        }
    }

    function LoadCntrlLang_custom():string
    {
        require_once JOINT_SITE_REQ_LANG."/controllers/lang_RecordsController.php";
        return "lang_RecordsController";
    }

    private function records_process():bool
    {
        if(!$this->checkRecordModel())
        {
            return false;
        }

        //used in all processed views
        require_once JOINT_SITE_REQUIRE_DIR."/application/views/templates/RecordView.php";

        global $request;

        if(!$this->process_url){
            return jointSite::throwErr("request", "RecordsProcessController throw err: cant set up process_url - null");
        }

        $pp_exp = explode("/", $this->process_url);
        $pp_cnt = count($pp_exp);

        if(JOINT_SITE_APP_REF){
            $pp_cnt--;
        }

        if (!isset($request["routes"][$pp_cnt]) or
            $request["routes"][$pp_cnt] == null or
            $request["routes"][$pp_cnt] == "listview") {
            $this->checkTemplateView("list");
            $this->view->process_url = $this->process_url;
            $this->view->view_data = $this->view_data;

            $this->process_list();

        } elseif ($request["routes"][$pp_cnt] == "detailview") {
            $this->checkTemplateView("detail");
            $this->view->view_data = $this->view_data;
            $this->view->action_log = $this->exec_detail($_GET);
            if ($this->view->action_log["result"]) {
                $this->process_detail();

            } else {
                return jointSite::throwErr("request", $this->lang_map->rc_errors["prefix"] .
                    $this->lang_map->rc_errors["detail"] . ", " .
                    $this->lang_map->rc_errors["model_err"] .
                    $this->model->log_message);
            }

        } elseif ($request["routes"][$pp_cnt] == "editview") {
            $this->checkTemplateView("edit");
            $this->view->view_data = $this->view_data;
            $this->view->slave_req = $this->makeSlaveRequest();
            if (isset($_POST["submit"]) and $_POST["submit"] == $this->view->lang_map->view_submit_val) {
                $this->view->action_log = $this->exec_edit($_POST);
                $this->model->copyCustomFields();
            } else {
                $this->model->copyValFromRequest($_GET);
                if (!$this->model->copyRecord()) {
                    return jointSite::throwErr("request", $this->model->log_message);
                }
            }

            $this->view->editFields = $this->model->recordStructureFields->editFields;

            $this->prepareViewFields();

            $this->view->generate();
        } elseif ($request["routes"][$pp_cnt] == "newview") {
            $this->checkTemplateView("new");
            $this->view->view_data = $this->view_data;
            $this->view->type = "new";
            $this->view->slave_req = $this->makeSlaveRequest();
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

        } elseif ($request["routes"][$pp_cnt] == "deleteview") {
            $this->model->copyValFromRequest($_GET);
            if ($this->model->copyRecord()) {
                $this->checkTemplateView("delete");
                $this->view->view_data = $this->view_data;
                $this->view->type = "delete";
                $this->view->slave_req = $this->makeSlaveRequest();

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
                return jointSite::throwErr("request", $this->model->log_message);
            }
        } elseif (!$this->doAction_custom($request["routes"][$pp_cnt])) {
            return jointSite::throwErr("stab", "no custom actions in RecordsController: ".$request["routes"][$pp_cnt]);
        }
        return true;
    }

    function process_detail()
    {
        $this->view->viewFields = $this->model->recordStructureFields->viewFields;
        $this->view->slave_req = $this->makeSlaveRequest();

        $this->prepareViewFields($this->process_url);

        $this->view->generate();
    }

    function process_list()
    {
        if ($this->model->modelAliases[JOINT_SITE_APP_LANG]) {
            $this->view->h2 = $this->model->modelAliases[JOINT_SITE_APP_LANG];
        } else {
            $this->view->h2 = $this->model->tableName;
        }

        $this->view->list_frame_id = $this->model->tableName;

        if (isset($_POST["curPage"])) {
            $this->view->curPage = $_POST["curPage"];
        }

        if (isset($_POST["onPage"])) {
            $this->view->onPage = $_POST["onPage"];
        }

        $list_records = $this->exec_list($_POST);

        $this->view->listCount = $list_records["count"];
        $this->view->listFields = $this->model->recordStructureFields->listFields;
        $this->view->listRecords = $list_records["list"];
        $this->view->slave_req = $this->makeSlaveRequest();

        if (isset($_POST["applyFilterRec"])) {
            $listJson = array(
                "listView" => $this->view->listViewTable(),
                "pgView" => $this->view->listPgView(),
                "jsCtrlPanel" => $this->view->scriptListViewCrtlPannel(),
            );
            $this->view->generateJson($listJson);
        } else {

            $this->view->searchFields = $this->model->recordStructureFields->searchFields;
            $this->view->generate();
        }
    }

    function makeSlaveRequest()
    {

    }

    function doAction_custom(string $action_name)
    {
        return false;
    }

    public function exec_list($reqArr = null):array
    {
        $this->checkRecordModel();
        $this->model->copyValFromRequest($reqArr);
        $sup_cond = $this->model->filterWhere($reqArr);

        return array(
            "count" => $this->model->countRecords($sup_cond["where"], $sup_cond["having"]),
            "list" => $this->model->listRecords($sup_cond["where"], $sup_cond["order"], $sup_cond["limit"], $sup_cond["having"]),
        );
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
            require_once JOINT_SITE_REQUIRE_DIR."/application/Core/Records/RecordsModel.php";
            $this->model = new RecordsModel($this->process_table);
        }
        if($this->model->connect_database_status){
            if($this->model->pdo_query("SHOW TABLES LIKE '".$this->process_table."'")->fetch(\PDO::FETCH_ASSOC)){
                return true;
            }else{
                return jointSite::throwErr("request", "RecordProcessController->checkRecordModel throw err: cant find target table = ".$this->process_table.
                    " in database ".$this->model->conn_db);
            }
        }else{
            return jointSite::throwErr("request", "RecordProcessController->checkRecordModel throw err: connect_database_status = fail");
        }
    }

    //if custom view not loaded
    function checkTemplateView($type_of_view)
    {
        if($type_of_view == "list"){
            if(!$this->view instanceof \RecordListView) {
                require_once JOINT_SITE_REQUIRE_DIR."/application/views/templates/RecordListView.php";
                $this->view = new \RecordListView();
            }
        }elseif ($type_of_view == "detail"){
            if(!$this->view instanceof \RecordDetailView) {
                require_once JOINT_SITE_REQUIRE_DIR."/application/views/templates/RecordDetailView.php";
                $this->view = new \RecordDetailView();
            }
        }
        elseif (in_array($type_of_view, array("edit", "new", "delete"))){
            if(!$this->view instanceof \RecordEditView) {
                require_once JOINT_SITE_REQUIRE_DIR."/application/views/templates/RecordEditView.php";
                $this->view = new \RecordEditView();
            }
        }
    }

    function prepareViewFields()
    {
        $this->view->record = $this->model->recordStructureFields->record;
        if($this->model->modelAliases[JOINT_SITE_APP_LANG]){
            $this->view->h2=$this->model->modelAliases[JOINT_SITE_APP_LANG];
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