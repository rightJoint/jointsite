<?php
class RecordsController extends Controller
{
    public $default_table = "musicTracksToAlb_dt"; //when use RecordsModel by default without loaded custom model

    function LoadCntrlLang_custom()
    {
        require_once $_SERVER["DOCUMENT_ROOT"] . JOINT_SITE_EXEC_DIR . "/application/lang_files/".
            "controllers/lang_RecordsController_".$_SESSION[JS_SAIK]["lang"].".php";
        return "lang_RecordsController_".$_SESSION[JS_SAIK]["lang"];
    }

    public function records_process($process_path=null,
                                    $default_table = null, //
                                    $view_data = null)
    {
        $this->default_table = $default_table;
        $this->checkRecordModel();

        //used in all processed views
        require_once $_SERVER["DOCUMENT_ROOT"] . JOINT_SITE_EXEC_DIR . "/application/views/templates/RecordView.php";

        global $request;

        $pp_exp = explode("/", $process_path);
        $pp_cnt = count($pp_exp);

        if (!isset($request["routes"][$pp_cnt]) or
            $request["routes"][$pp_cnt] == null or
            $request["routes"][$pp_cnt] == "listview") {
            $this->checkTemplateView("list");
            $this->view->process_url = $process_path;
            $this->view->view_data = $view_data;

            $this->process_list();

        } elseif ($request["routes"][$pp_cnt] == "detailview") {
            $this->checkTemplateView("detail");
            $this->view->view_data = $view_data;
            $this->view->action_log = $this->action_detail(false);
            if ($this->view->action_log["result"]) {
                $this->process_detail($process_path);

            } else {
                jointSite::throwErr("request", $this->lang_map->rc_errors["prefix"] .
                    $this->lang_map->rc_errors["detail"] . ", " .
                    $this->lang_map->rc_errors["model_err"] .
                    $this->model->log_message);
            }

        } elseif ($request["routes"][$pp_cnt] == "editview") {
            $this->checkTemplateView("edit");
            $this->view->view_data = $view_data;
            if (isset($_POST["submit"]) and $_POST["submit"] == $this->view->lang_map->view_submit_val) {
                $this->view->action_log = $this->action_edit(false);
                $this->model->copyCustomFields();
            } else {
                $this->model->copyValFromRequest(null, "GET");
                if (!$this->model->copyRecord()) {
                    jointSite::throwErr("request", $this->model->log_message);
                }
            }

            $this->view->editFields = $this->model->recordStructureFields->editFields;

            $this->prepareViewFields($process_path);

            $this->view->generate();
        } elseif ($request["routes"][$pp_cnt] == "newview") {
            $this->checkTemplateView("new");
            $this->view->view_data = $view_data;
            $this->view->type = "new";
            if (isset($_POST["submit"]) and
                $_POST["submit"] == $this->view->lang_map->view_submit_val_new) {
                $this->view->action_log = $this->action_new(false);
                if ($this->view->action_log["result"]) {
                    $get_str = null;
                    foreach ($this->model->recordStructureFields->record as $fName => $fData) {
                        if ($fData["indexes"] == true) {
                            $get_str .= $fName . "=" . $fData["curVal"] . "&";
                        }
                    }
                    $get_str = substr($get_str, 0, strlen($get_str) - 1);
                    header("Location: " . $process_path . "/editview?" . $get_str);
                }
            }

            $this->view->editFields = $this->model->recordStructureFields->editFields;

            $this->prepareViewFields($process_path);

            $this->view->generate();

        } elseif ($request["routes"][$pp_cnt] == "deleteview") {
            $this->model->copyValFromRequest(null, "GET");
            if ($this->model->copyRecord()) {
                $this->checkTemplateView("delete");
                $this->view->view_data = $view_data;
                $this->view->type = "delete";
                if (isset($_POST["submit"]) and
                    ($_POST["submit"] == $this->view->lang_map->view_submit_val_del)) {
                    $this->view->action_log = $this->action_delete(false);
                    if ($this->view->action_log["result"]) {
                        header("Location: " . $process_path);
                    }
                }
                $this->view->editFields = $this->model->recordStructureFields->editFields;
                $this->prepareViewFields($process_path);
                $this->view->generate();
            } else {
                jointSite::throwErr("request", $this->model->log_message);
            }
        } elseif (!$this->doAction_custom($request["routes"][$pp_cnt])) {
            jointSite::throwErr("stab", "no custom actions in RecordsController");
        }
    }

    function process_detail($process_path)
    {
        $this->view->viewFields = $this->model->recordStructureFields->viewFields;

        $this->prepareViewFields($process_path);

        $this->view->generate();
    }

    function process_list()
    {
        if ($this->model->modelAliases[$_SESSION[JS_SAIK]["lang"]]) {
            $this->view->h2 = $this->model->modelAliases[$_SESSION[JS_SAIK]["lang"]];
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

        $list_records = $this->action_list(false);

        $this->view->listCount = $list_records["count"];
        $this->view->listFields = $this->model->recordStructureFields->listFields;
        $this->view->listRecords = $list_records["list"];

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

    function doAction_custom($action_name)
    {
        return false;
    }

    private function action_list($json = true)
    {
        $this->checkRecordModel();
        $this->model->copyValFromRequest();
        $sup_cond = $this->model->filterWhere();

        $list_records = array(
            "count" => $this->model->countRecords($sup_cond["where"], $sup_cond["having"]),
            "list" => $this->model->listRecords($sup_cond["where"], $sup_cond["order"], $sup_cond["limit"], $sup_cond["having"]),
        );

        if($json){
            $this->view->generateJson($list_records);
        }else{
            return $list_records;
        }
    }

    private function action_detail($json = true)
    {
        $this->checkRecordModel();
        $this->model->copyValFromRequest(null, "GET");
        $copy_res = array(
            "result" => $this->model->copyRecord(),
            "log" => $this->model->log_message,
            "record" => $this->model->recordStructureFields->record,
        );
        if($json){
            $copy_res["record"] = $this->model->recordStructureFields->record;
            $this->view->generateJson($copy_res);
        }else{
            return $copy_res;
        }
    }

    protected function action_edit($json = true)
    {
        $this->checkRecordModel();
        $this->model->copyValFromRequest(null, "GET");
        if ($this->model->copyRecord()) {
            $this->model->copyValFromRequest();
            $edit_res = array(
                "result" => $this->model->updateRecord(),
                "log" => $this->model->log_message,
            );
            if($json){
                $this->view->generateJson($edit_res);
            }else{
                return $edit_res;
            }
        } else {
            jointSite::throwErr("request", $this->model->log_message);
        }

    }

    protected function action_new($json = true)
    {
        $this->checkRecordModel();
        $this->model->copyValFromRequest();
        $new_res = array(
            "result" => $this->model->insertRecord(),
            "log" => $this->model->log_message,
        );
        if($json){
            $this->view->generateJson($new_res);
        }else{
            return $new_res;
        }
    }

    protected function action_delete($json = true)
    {
        $this->checkRecordModel();
        $this->model->copyValFromRequest();
        $del_res = array(
            "result" => $this->model->deleteRecord(),
            "log" => $this->model->log_message,
        );
        if($json){
            $this->view->generateJson($del_res);
        }else{
            return $del_res;
        }
    }

    /*if custom model mot loaded*/
    function checkRecordModel()
    {
        if(!$this->model instanceof RecordsModel) {
            require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR."/application/core/RecordsModel.php";
            $this->model = new RecordsModel($this->default_table);
        }
    }

    //if custom view not loaded
    function checkTemplateView($type_of_view)
    {
        if($type_of_view == "list"){
            if(!$this->view instanceof RecordListView) {
                require_once $_SERVER["DOCUMENT_ROOT"] . JOINT_SITE_EXEC_DIR . "/application/views/templates/RecordListView.php";
                $this->view = new RecordListView();
            }
        }elseif ($type_of_view == "detail"){
            if(!$this->view instanceof RecordDetailView) {
                require_once $_SERVER["DOCUMENT_ROOT"] . JOINT_SITE_EXEC_DIR . "/application/views/templates/RecordDetailView.php";
                $this->view = new RecordDetailView();
            }
        }
        elseif (in_array($type_of_view, array("edit", "new", "delete"))){
            if(!$this->view instanceof RecordEditView) {
                require_once $_SERVER["DOCUMENT_ROOT"] . JOINT_SITE_EXEC_DIR . "/application/views/templates/RecordEditView.php";
                $this->view = new RecordEditView();
            }
        }
    }

    function prepareViewFields($process_path = null)
    {
        $this->view->record = $this->model->recordStructureFields->record;
        if($this->model->modelAliases[$_SESSION[JS_SAIK]["lang"]]){
            $this->view->h2=$this->model->modelAliases[$_SESSION[JS_SAIK]["lang"]];
        }else{
            $this->view->h2 = $this->model->tableName;
        }
        $this->view->process_url = $process_path;
    }

    function action_filldatalist()
    {
        $req_where = json_decode($_GET["where"], true);
        $fdl_where = $this->model->filterWhere("custom", $req_where);

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
}
