<?php
require_once "application/lang_files/controllers/lang_cntrl_Module_".$_SESSION[JS_SAIK]["lang"].".php";
class ModuleController extends RecordsController
{
    public $module_name;
    public $module_config;
    public $m_process_url;

    public function module_process($module_name, $m_process_url)
    {
        $this->module_name = $module_name;
        $this->module_config = $this->load_module_config($this->module_name);
        $this->m_process_url = $m_process_url;

        global $request;

        $mpu_expld = explode("/", $this->m_process_url);
        $mpu_cnt = count($mpu_expld);


        if($request["routes"][$mpu_cnt-1] == $mpu_expld[$mpu_cnt-1]){


            if(!isset($request["routes"][$mpu_cnt])){
                $mainModel_name = $this->load_module_model($this->module_name, $this->module_config["moduleTable"]["tableName"]);

                $mainModel = new $mainModel_name();

                $countMain_where = $mainModel->filterWhere()["where"];

                $module_stat["moduleTable"]["countRecords"]=$mainModel->countRecords($countMain_where);

                if($this->module_config["bindTables"]){
                    foreach ($this->module_config["bindTables"] as $tName => $tOptions){
                        $bindModel_name = $this->load_module_model($this->module_name, $tName);
                        $bindModel = new $bindModel_name();
                        $bindModel->module_name = $this->module_name;
                        $count_where = $bindModel->filterWhere()["where"];
                        $module_stat["bindTables"][$tName]["countRecords"]=$bindModel->countRecords($count_where);
                    }
                }

                require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
                    "/application/views/templates/ModuleStatView.php";
                $this->view = new ModuleStatView();

                $this->view->module_stat = $module_stat;
                $this->view->module_config = $this->module_config;
                $this->view->m_process_url = $this->m_process_url;
                $this->view->module_name = $this->module_name;

                $this->view->generate();
            }else{
                if($this->module_config["moduleTable"]["tableName"] == $request["routes"][$mpu_cnt]){
                    $tProcess = $this->module_config["moduleTable"]["tableName"];
                }elseif($this->module_config["bindTables"][$request["routes"][$mpu_cnt]]){
                    $tProcess =$request["routes"][$mpu_cnt];
                }else{
                    jointSite::throwErr("request", "module process table ".$request["routes"][$mpu_cnt]." not found");
                }
                if(!isset($request["routes"][$mpu_cnt+1]) or $request["routes"][$mpu_cnt+1] == "listview"){
                    $type_of_view = "list";
                }elseif($request["routes"][$mpu_cnt+1] == "detailview"){
                    $type_of_view = "detail";
                }elseif($request["routes"][$mpu_cnt+1] == "editview" or $request["routes"][$mpu_cnt+1] == "deleteview"
                    or $request["routes"][$mpu_cnt+1] == "newview"){
                    $type_of_view = "edit";
                }

                $use_model_name = $this->load_module_model($this->module_name, $tProcess);

                $this->model = new $use_model_name();
                $this->model->moule_name = $this->module_name;

                $m_view_name = $this->load_module_view($type_of_view);
                $this->view = new $m_view_name();

                $this->view->hasAccessCreate = false;

                if(isset($this->model->access_rules["create_rule"]) and $this->model->access_rules["create_rule"] == 7){
                    $this->view->hasAccessCreate = true;
                }

                $this->view->module_config = $this->module_config;
                $this->view->m_process_url = $this->m_process_url;
                $this->view->module_name = $this->module_name;

                $this->records_process($this->m_process_url."/".$tProcess, $tProcess, null);
            }
        }else{
            jointSite::throwErr("request", "module_process ".$this->module_name." tProcess not found");
        }
    }


    function load_module_config($module_name)
    {
        include JOINT_SITE_CONF_DIR.
            "/modules/".$module_name."_mconf.php";
        return $module_tables_conf;
    }

    function load_module_model($module_name, $model_name)
    {
        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
            "/application/core/RecordsModel.php";
        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
            "/application/core/ModuleModel.php";
        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
            "/application/models/modules/".$module_name."/m_model_".$model_name.".php";
        return "m_model_".$model_name;
    }

    function load_module_view($type_of_view)
    {
        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
            "/application/views/templates/RecordView.php";

        if($type_of_view == "list"){
            require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
                "/application/views/templates/RecordListView.php";
            require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
                "/application/views/templates/ModuleListView.php";
            return "ModuleListView";
        }elseif($type_of_view == "detail"){

            require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
                "/application/views/templates/RecordDetailView.php";
            require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
                "/application/views/templates/ModuleDetailView.php";
            return "ModuleDetailView";
        }elseif($type_of_view == "edit" or $type_of_view == "new"){

            require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
                "/application/views/templates/RecordEditView.php";
            require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
                "/application/views/templates/ModuleEditView.php";
            return "ModuleEditView";
        }
    }

    function process_detail($m_process_url)
    {
        global $request;
        $mpu_expld = explode("/", $m_process_url);
        $mpu_cnt = count($mpu_expld);
        if($this->module_config["moduleTable"]["tableName"] == $request["routes"][$mpu_cnt-1]){
            if($this->module_config["bindTables"]){
                foreach ($this->module_config["bindTables"] as $tName => $tOptions){

                    if($tOptions["relationships"]){

                        $bindModel_name = $this->load_module_model($this->module_name, $tName);
                        $bindModel = new $bindModel_name();
                        $bindModel_where = null;
                        $slave_req = null;
                        foreach ($tOptions["relationships"] as $mainTable_field=>$bindTable_field){
                            $slave_req.=$bindTable_field."=".$this->model->recordStructureFields->record[$mainTable_field]["curVal"]."&";
                            $bindModel_where.=$bindModel->tableName.".".$bindTable_field."='".
                                $this->model->recordStructureFields->record[$mainTable_field]["curVal"]."' and";
                        }

                        $bindModel_where = substr($bindModel_where, 0, strlen($bindModel_where) -4);
                        $slave_req = substr($slave_req, 0, strlen($slave_req) -1);

                        $sup_cond = $bindModel->filterWhere("GET", null);

                        $sup_cond["where"] = " where ".$bindModel_where;

                        $bind_list_view_name = $this->load_module_view("list");
                        $bind_list_view = new $bind_list_view_name();

                        $bind_list_view->newBtn_qry = "?".$slave_req;

                        $bind_list_view->process_url = $this->view->m_process_url."/".$tName;

                        $bind_list_view->listCount = $bindModel->countRecords($sup_cond["where"]);

                        $bind_list_view->listFields = $bindModel->recordStructureFields->listFields;
                        $bind_list_view->searchFields = $bindModel->recordStructureFields->searchFields;
                        $bind_list_view->listRecords = $bindModel->listRecords($sup_cond["where"], $sup_cond["order"], $sup_cond["limit"]);

                        if($this->model->modelAliases[$_SESSION["lang"]]){
                            $bind_list_view->h2 =$bindModel->modelAliases[$_SESSION["lang"]];
                        }else{
                            $bind_list_view->h2 = $tName;
                        }

                        $bind_list_view->list_frame_id = $bindModel->tableName;

                        $data["bindTables"][$bindModel->tableName] = array(
                            "html" => $bind_list_view->ctrlLine().
                                "<div class='list_table'>".
                                $bind_list_view->listViewTable().
                                "</div>".
                                $bind_list_view->scriptListViewCrtlPannel($slave_req).
                                $bind_list_view->scriptSortBlock(),
                            "h3" => $bind_list_view->h2,
                        );

                    }
                }
                $this->view->bindTables = $data["bindTables"];
            }
        }
        parent::process_detail($m_process_url);
    }

    function action_delete($json = true)
    {
        global $request;
        $mpu_expld = explode("/", $this->m_process_url);
        $mpu_cnt = count($mpu_expld);
        if($this->module_config["moduleTable"]["tableName"] == $request["routes"][$mpu_cnt]){
            if ($this->module_config["bindTables"]) {
                foreach ($this->module_config["bindTables"] as $tName => $tOptions){
                    if($tOptions["relationships"]){

                        $bind_model_name = $this->load_module_model($this->module_name, $tName);
                        $this->model->bind_models[$bind_model_name] = $tOptions["relationships"];
                    }
                }
            }
        }

        $this->view->action_log = parent::action_delete(false);
        if ($this->view->action_log["result"]) {
            header("Location: " . $this->m_process_url."/".$request["routes"][$mpu_cnt]);
        }
    }
}
