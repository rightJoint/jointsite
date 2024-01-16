<?php
class RecordsController extends Controller
{
    public function records_process($process_path="admin/records", $custom_name, $view_data = null)
    {
        include "application/core/Records/RecordsView.php";
        global $routes;

        $pp_exp = explode("/", $process_path);
        $pp_cnt = count($pp_exp);

        $this->model = $this->loadModel($process_path, $custom_name);

        $this->model->getRecordStructure();

        if (!$routes[$pp_cnt + 2] || $routes[$pp_cnt + 2] == "list") {

            $this->view = $this->loadView("list", $process_path, $custom_name);

            $this->view->view_data = $view_data;

            $this->process_list();

        } elseif ($routes[$pp_cnt + 2] == "new") {
            $this->view = $this->loadView("edit", $process_path, $custom_name);
            $this->view->process_url = $process_path."/" . $custom_name;
            $this->view->type = "new";

            $this->model->copyGetId();
            if($_POST){
                $this->model->copyPost();
                $this->view->action_log["result"] = $this->model->insertRecord();
                $this->view->action_log["log"] = $this->model->log_message;
                if($this->view->action_log["result"]){
                    $get_str = null;
                    foreach ($this->model->record as $fName=>$fData){
                        if($fData["indexes"] == true){
                            $get_str.=$fName."=".$fData["curVal"]."&";
                        }
                    }
                    $get_str = substr($get_str, 0, strlen($get_str)-1);
                    header("Location: /".$process_path."/".$custom_name."/edit?".$get_str);
                }
            }

            $this->view->editFields = $this->model->editFields;
            $this->view->record = $this->model->record;

            if($this->model->modelAliases[$_SESSION["lang"]]){
                $this->view->h2=$this->model->modelAliases[$_SESSION["lang"]];
            }else{
                $this->view->h2 = $this->model->tableName;
            }

            $this->view->list_frame_id = $this->model->tableName;
            $this->view->generate();
        } elseif ($routes[$pp_cnt + 2] == "edit") {
            $this->view = $this->loadView("edit", $process_path, $custom_name);

            $this->model->copyGetId();
            if ($this->model->copyRecord()) {
                $this->edit_record();
                $this->view->record = $this->model->record;
                $this->view->editFields = $this->model->editFields;

                if($this->model->modelAliases[$_SESSION["lang"]]){
                    $this->view->h2=$this->model->modelAliases[$_SESSION["lang"]];
                }else{
                    $this->view->h2 = $this->model->tableName;
                }
                $this->view->generate();
            } else {
                throwErr("request", $this->model->log_message);
            }
        } elseif ($routes[$pp_cnt + 2] == "delete")
        {
            $this->view = $this->loadView("detail", $process_path, $custom_name);

            $this->view->type = "delete";

            $this->model->copyGetId();
            if ($this->model->copyRecord()) {

                if($_POST["confirmdetelerecord"]){
                    $this->delete_record($process_path, $custom_name);

                }

                $this->view->viewFields = $this->model->viewFields;
                $this->view->record = $this->model->record;
                if($this->model->modelAliases[$_SESSION["lang"]]){
                    $this->view->h2=$this->model->modelAliases[$_SESSION["lang"]];
                }else{
                    $this->view->h2 = $this->model->tableName;
                }
                $this->view->generate();
            } else {
                throwErr("request", $this->model->log_message);
            }
        } elseif ($routes[$pp_cnt + 2] == "detail") {
            $this->view = $this->loadView("detail", $process_path, $custom_name);

            $this->model->copyGetId();
            if ($this->model->copyRecord()) {

                $this->process_detail($process_path);
            }
            else {
                throwErr("request", $this->model->log_message);
            }
        }
    }

    function edit_record()
    {
        if($_POST){
            $this->model->copyPost();
            $this->view->action_log = array(
                "result" => $this->model->updateRecord(),
                "log" => $this->model->log_message,
            );
        }


    }

    function delete_record($process_path, $custom_name)
    {
        $this->view->action_log = $this->model->deleteRecord();
        if($this->view->action_log["result"]){
            header("Location: /".$process_path."/".$custom_name);
        }
    }

    function process_detail($process_path = null)
    {

        $this->view->viewFields = $this->model->viewFields;
        $this->view->record = $this->model->record;
        if($this->model->modelAliases[$_SESSION["lang"]]){
            $this->view->h2=$this->model->modelAliases[$_SESSION["lang"]];
        }else{
            $this->view->h2 = $this->model->tableName;
        }
        $this->view->generate();
    }

    function process_list()
    {
        if($this->model->modelAliases[$_SESSION["lang"]]){
            $this->view->h2=$this->model->modelAliases[$_SESSION["lang"]];
        }else{
            $this->view->h2 = $this->model->tableName;
        }

        $this->view->list_frame_id = $this->model->tableName;

        if ($_POST["curPage"]) {
            $this->view->curPage = $_POST["curPage"];
        }

        if ($_POST["onPage"]) {
            $this->view->onPage = $_POST["onPage"];
        }

        if ($_POST["applyFilterRec"]) {
            $this->model->copyPost();
            $sup_cond = $this->model->filterWhere();

            $this->view->listCount = $this->model->countRecords($sup_cond["where"]);
            $this->view->listFields = $this->model->listFields;
            $this->view->listRecords = $this->model->listRecords($sup_cond["where"], $sup_cond["order"], $sup_cond["limit"]);
            $listJson = array(
                "listView" => $this->view->listViewTable(),
                "pgView" => $this->view->listPgView(),
                "jsCtrlPanel" => $this->view->scriptListViewCrtlPannel(),
            );
            $this->view->generateJson($listJson);
        } else {
            $sup_cond = $this->model->filterWhere();
            $this->view->listCount = $this->model->countRecords($sup_cond["where"]);
            $this->view->listFields = $this->model->listFields;
            $this->view->listRecords = $this->model->listRecords($sup_cond["where"], $sup_cond["order"], $sup_cond["limit"]);
            $this->view->searchFields = $this->model->searchFields;
            $this->view->generate();
        }
    }

    function loadModel($process_path, $custom_name = null)
    {
        if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/application/models/" . $process_path . "/record" . $custom_name . "Model.php")) {
            require_once($_SERVER["DOCUMENT_ROOT"] . "/application/models/" . $process_path . "/record" . $custom_name . "Model.php");
            $type = "record" . $custom_name."Model";
            return new $type;
        } else {
            $return_model = new RecordsModel();
            $return_model->tableName = $custom_name;
            if(!$return_model->tableName_exist()){
                throwErr("request", "RecordsController, RecordsModel: cant use custom url without custom model");
            }
            return $return_model;
        }
    }

    function loadView($type_of_view, $process_path, $custom_name = null)
    {
        $viewName = "Record";
        if($type_of_view == "detail"){
            include "application/core/Records/RecordDetailView.php";
            $viewType = "DetailView";
        }elseif ($type_of_view == "edit"){
            include "application/core/Records/RecordEditView.php";
            $viewType = "EditView";
        }elseif ($type_of_view == "list"){
            require_once "application/core/Records/RecordsListView.php";
            $viewType = "ListView";
            $viewName .="s";
        }


        $pp_exp = explode("/", $process_path);
        $pp_cnt = count($pp_exp);

        $view = $viewName.$viewType;

        if($pp_cnt > 1){
            if(file_exists($_SERVER["DOCUMENT_ROOT"] . "/application/views/" . $pp_exp[0]."/".$pp_exp[0] . $viewType. ".php")){
                require_once "application/views/" . $pp_exp[0]."/".$pp_exp[0] . $viewType. ".php";
                $view = $pp_exp[0] . $viewType;
            }
        }

        $view_custom_name = null;
        if($custom_name){
            $view_custom_name = "/".$custom_name;
            if(file_exists($_SERVER["DOCUMENT_ROOT"] . "/application/views/" . $process_path ."/". $custom_name . $viewType.".php")){
                include "application/views/" . $process_path ."/". $custom_name . $viewType.".php";
                $view = $custom_name . $viewType;
            }
        }

        $view = new $view;

        $view->process_url = $process_path.$view_custom_name;

        return $view;
    }
}