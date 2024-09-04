<?php
//require_once "application/lang_files/controllers/lang_cntrl_applications_".$_SESSION["lang"].".php";
class controller_applications extends Controller
{
    function LoadCntrlLang_custom()
    {
        parent::LoadCntrlLang_custom();
        require_once $_SERVER["DOCUMENT_ROOT"] . JOINT_SITE_EXEC_DIR . "/application/lang_files".
            "/controllers/lang_cntrl_applications_".$_SESSION[JS_SAIK]["lang"].".php";
        return "lang_cntrl_applications_".$_SESSION[JS_SAIK]["lang"];
    }

    function LoadView_custom($action_name = null)
    {
        if($action_name == "details"){
            require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
                "/application/views/applications/applicationsView.php";
            return "applicationsView";
        }
    }

    function action_index()
    {
        if(isset($_POST["feedBack-form-modal"]) and $_POST["feedBack-form-modal"] == "newAppl"){
            $fbfmResponse = $this->mkApplicationModal();
            $this->view->generateJson($fbfmResponse);
        }elseif(!isset($server['reqUri_expl'][2])){
            jointSite::throwErr("notFound", "controller applications 404 err-1");
        }else{
            jointSite::throwErr("notFound", "controller applications 404 err-2");
        }
    }

    function mkApplicationModal()
    {
        $this->model = new model_applications(null, "applications");
        $this->model->copyValFromRequest($_POST);

        $errFlag = false;

        if($this->model->checkClientName()){
            $fbfmResponse["clientName"]["err"] = 0;
        }else{
            $errFlag = true;
            $fbfmResponse["clientName"]["err"] = 1;
            $fbfmResponse["clientName"]["info"] = $this->lang_map->mkApp["err-f"].": ".
                $this->lang_map->mkApp["err-1"];
        }

        if($this->model->checkUserEmail()){
            $fbfmResponse["clientMail"]["err"] = 0;
        }else{
            $errFlag = true;
            $fbfmResponse["clientMail"]["err"] = 1;
            $fbfmResponse["clientMail"]["info"] = $this->lang_map->mkApp["err-f"].": ".
                $this->lang_map->mkApp["err-2"];
        }
        $_SESSION[JS_SAIK]["basket"]["lang"] = $_SESSION[JS_SAIK]["lang"];
        if(isset($_SESSION[JS_SAIK]["basket"]["total"])){
            $this->model->recordStructureFields->record["basket"]["curVal"] = json_encode($_SESSION[JS_SAIK]["basket"]);
            $fbfmResponse["clientSubject"]["err"] = 0;
        }else{
            if(strlen($_POST["clientSubject"])>10){
                $fbfmResponse["clientSubject"]["err"] = 0;
            }else{
                $errFlag = true;
                $fbfmResponse["clientSubject"]["err"] = 1;
                $fbfmResponse["clientSubject"]["info"] = $this->lang_map->mkApp["err-f"].": ".
                    $this->lang_map->mkApp["err-3"];
            }
        }
        if(isset($_SESSION[JS_SAIK]["user_id"])){
            $this->model->recordStructureFields->record["user_id"]["curVal"] = $_SESSION[JS_SAIK]["site_user"]["user_id"];
        }
        $this->model->recordStructureFields->record["status"]["curVal"] = "new";
        $this->model->recordStructureFields->record["payStatus"]["curVal"] = "not-paid";

        if(!$errFlag){
            $this->model->recordStructureFields->record["dateEntered"]["curVal"] = date("Y-m-d H:i:s");
            if($this->model->insertRecord()){
                unset($_SESSION[JS_SAIK]["basket"]);
                $fbfmResponse["fbfa"]=1;
                $fbfmResponse["redirectUrl"]="/applications/details/".$this->model->recordStructureFields->record["appl_id"]["curVal"];

                require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
                    "/application/core/ntSendModel.php";
                $ntSend_model = new ntSendModel();

                $ntSend_model->AddNtf("new-app-siteman", "user",
                    "F42F81F8-1300-41CA-89BB-36BD7417BE1E", json_encode(
                        array(
                            "server_host" => $_SERVER["HTTP_HOST"],
                            "appl_id" => $this->model->recordStructureFields->record["appl_id"]["curVal"],
                        )
                    ), true, "default");

                $ntSend_model->AddNtf("new-app-user", "email",
                    $this->model->recordStructureFields->record["clientMail"]["curVal"], json_encode(
                        array(
                            "server_host" => $_SERVER["HTTP_HOST"],
                            "appl_id" => $this->model->recordStructureFields->record["appl_id"]["curVal"],
                        )
                    ), true, "default");

            }else{
            //    $fbfmResponse["mo-submit"]["err"]=1;
            //    $fbfmResponse["mo-submit"]["info"] = "ошибка: неизвестная ошибка DB->putOne";
            }
        }
        return $fbfmResponse;
    }

    function action_details()
    {
        global $request;

        if(isset($request["routes"][3])){
            $this->model = new model_applications(null, "applications");
            $this->model->recordStructureFields->record["appl_id"]["curVal"] = $request["routes"][3];
            if($this->model->copyRecord()){
                //include "application/views/applications/applicationsView.php";
                //$this->view = new applicationsView();
                $this->view->view_data = $this->get_details();
                $this->view->view_data["rd"] = $this->model->recordStructureFields->record;
                $this->view->generate();
            }else{
               jointSite::throwErr("notFound", "controller applications details: unknown appl id");
            }
        }else{
            jointSite::throwErr("notFound", "controller applications details: no appl id");
        }
    }

    function addComment()
    {

        global $request;
        if(isset($_POST["appl-f-nc"]) and $_POST["appl-f-nc"]=="y"){

            $commentModel = new RecordsModel("applCm_dt");
            $commentModel->recordStructureFields->record["appl_id"]["curVal"] = $request["routes"][3];


            if(strlen($_POST["content"]) > 1){
                $commentModel->recordStructureFields->record["content"]["curVal"] = $_POST["content"].strlen($_POST["content"]);
            }else{
                $applCm_rd["err"]["content"] = "Ничего не введено";
            }
            $commentModel->recordStructureFields->record["dateEntered"]["curVal"] = date("Y-m-d H:i:s");

            if(isset($_SESSION[JS_SAIK]["site_user"]["user_id"])){
                $commentModel->recordStructureFields->record["user_id"]["curVal"] = $_SESSION[JS_SAIK]["site_user"]["user_id"];
            }

            $fLenght = count($_FILES["applFiles"]["name"]);

            $uplAttach = array();

            if($fLenght){
                for ($fCounter = 0;$fCounter < $fLenght;$fCounter++){
                    if($fCounter<3){
                        if ($_FILES["applFiles"]['error'][$fCounter] !== 0){
                        }else{

                            $path_parts = pathinfo(basename($_FILES["applFiles"]['name'][$fCounter]));
                            //$guid = $this->model->createGUID();
                            $uplAttach[]=$path_parts['basename'];
                            if ( !file_exists( $_SERVER["DOCUMENT_ROOT"].APPL_UPLOAD_FOLDER."/".
                                    $this->model->recordStructureFields->record["appl_id"]["curVal"] ) && !is_dir( $_SERVER["DOCUMENT_ROOT"].APPL_UPLOAD_FOLDER."/".
                                    $this->model->recordStructureFields->record["appl_id"]["curVal"] ) ) {
                                mkdir( $_SERVER["DOCUMENT_ROOT"].APPL_UPLOAD_FOLDER."/".
                                    $this->model->recordStructureFields->record["appl_id"]["curVal"] );
                            }
                            if (move_uploaded_file($_FILES["applFiles"]['tmp_name'][$fCounter], $_SERVER["DOCUMENT_ROOT"].APPL_UPLOAD_FOLDER."/".
                                $this->model->recordStructureFields->record["appl_id"]["curVal"]."/".$path_parts['basename'])) {
                            } else {
                                $addCmmErr = "Возможная атака с помощью файловой загрузки!\n";
                            }
                        }
                    }
                }
                if(count($uplAttach)){
                    $commentModel->recordStructureFields->record["attach"]["curVal"] = json_encode($uplAttach);
                }
            }

            if($commentModel->insertRecord()){

            }
        }
    }

    function get_details()
    {
        $this->addComment();
        if($this->model->recordStructureFields->record["basket"]["curVal"]){
            $basket = json_decode($this->model->recordStructureFields->record["basket"]["curVal"], true);

            $viewData["basket"]["total"] = $basket["total"];
            $viewData["basket"]["lang"] = $basket["lang"];
            foreach ($basket["prod"] as $prodAlias=>$prodCount){;
                $findProd_qry = "select * from srvCards_dt where cardAlias = '".$prodAlias."'";
                $findProd_res = $this->model->query($findProd_qry);
                if($findProd_row = $findProd_res->fetch(PDO::FETCH_ASSOC)){
                    $findProd_row["count"] = $prodCount;
                    $viewData["basket"]["prod"][$prodAlias] = $findProd_row;;
                }
            }
        }
        $findApplCm_qry = "select  applCm_dt.content, applCm_dt.dateEntered, applCm_dt.user_id, applCm_dt.attach, usersToGroups_dt.group_id, 
users_dt.photoLink, users_dt.accAlias, applCm_dt.appl_id    
from applCm_dt
left join usersToGroups_dt on applCm_dt.user_id = usersToGroups_dt.user_id and group_id = '67A5CC8E-5EBF-46FD-9A37-4BE80DA17681' 
left join users_dt on users_dt.user_id = usersToGroups_dt.user_id 
where appl_id = '".$this->model->recordStructureFields->record["appl_id"]["curVal"]."'
order by applCm_dt.dateEntered desc";
        $findApplCm_res = $this->model->query($findApplCm_qry);

        $viewData["findApplCm"] = $findApplCm_res;

        return $viewData;

    }
}