<?php
class controller_applications extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->lang_map["mkApp"] = array(
            "err-f" => array(
                "en" => "error",
                "rus" => "ошибка",
            ),
            "err-1" => array(
                "en" => "client name not acceptable",
                "rus" => "недопустимое имя пользователя",
            ),
            "err-2" => array(
                "en" => "email not valid",
                "rus" => "недопустимый email",
            ),
            "err-3" => array(
                "en" => "too less text",
                "rus" => "слишком мало текста",
            ),
        );
    }

    function action_index()
    {
        global $server;
        if($_POST["feedBack-form-modal"] == "newAppl"){
            $fbfmResponse = $this->mkApplicationModal();
            $this->view->generateJson($fbfmResponse);
        }elseif(!$server['reqUri_expl'][2]){
            throwErr("404", "controller applications 404 err-1");
        }else{
            throwErr("404", "controller applications 404 err-2");
        }
    }

    function mkApplicationModal()
    {
        $this->model = new model_applications();
        $this->model->getRecordStructure();
        $this->model->copyPost();

        $errFlag = false;

        if($this->model->checkClientName()){
            $fbfmResponse["clientName"]["err"] = 0;
        }else{
            $errFlag = true;
            $fbfmResponse["clientName"]["err"] = 1;
            $fbfmResponse["clientName"]["info"] = $this->lang_map["mkApp"]["err-f"][$_SESSION["lang"]].": ".
                $this->lang_map["mkApp"]["err-1"][$_SESSION["lang"]];
        }

        if($this->model->checkUserEmail()){
            $fbfmResponse["clientMail"]["err"] = 0;
        }else{
            $errFlag = true;
            $fbfmResponse["clientMail"]["err"] = 1;
            $fbfmResponse["clientMail"]["info"] = $this->lang_map["mkApp"]["err-f"][$_SESSION["lang"]].": ".
                $this->lang_map["mkApp"]["err-2"][$_SESSION["lang"]];
        }
        $_SESSION["basket"]["lang"] = $_SESSION["lang"];
        if($_SESSION["basket"]["total"]){
            $this->model->record["basket"]["curVal"] = json_encode($_SESSION["basket"]);
            $fbfmResponse["clientSubject"]["err"] = 0;
        }else{
            if(strlen($_POST["clientSubject"])>10){
                $fbfmResponse["clientSubject"]["err"] = 0;
            }else{
                $errFlag = true;
                $fbfmResponse["clientSubject"]["err"] = 1;
                $fbfmResponse["clientSubject"]["info"] = $this->lang_map["mkApp"]["err-f"][$_SESSION["lang"]].": ".
                    $this->lang_map["mkApp"]["err-3"][$_SESSION["lang"]];
            }
        }
        if($_SESSION["user_id"]){
            $this->model->record["user_id"]["curVal"] = $_SESSION["site_user"]["user_id"];
        }
        $this->model->record["status"]["curVal"] = "new";
        $this->model->record["payStatus"]["curVal"] = "not-paid";

        if(!$errFlag){
            $this->model->record["dateEntered"]["curVal"] = date("Y-m-d H:i:s");
            if($this->model->insertRecord()){
                unset($_SESSION["basket"]);
                $fbfmResponse["fbfa"]=1;
                $fbfmResponse["redirectUrl"]="/applications/details/".$this->model->record["appl_id"]["curVal"];

                require_once "application/core/Module/ntSendModel.php";
                $ntSend_model = new ntSendModel();

                $ntSend_model->AddNtf("new-app-siteman", "user",
                    "36332131-C26E-4B63-A22D-11A3076074ED", json_encode(
                        array(
                            "server_host" => $_SERVER["HTTP_HOST"],
                            "appl_id" => $this->model->record["appl_id"]["curVal"],
                        )
                    ), true, "default");

                $ntSend_model->AddNtf("new-app-user", "email",
                    $this->model->record["clientMail"]["curVal"], json_encode(
                        array(
                            "server_host" => $_SERVER["HTTP_HOST"],
                            "appl_id" => $this->model->record["appl_id"]["curVal"],
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
        global $routes;
        if($routes[3]){
            $this->model = new model_applications();
            $this->model->getRecordStructure();
            $this->model->record["appl_id"]["curVal"] = $routes[3];
            if($this->model->copyRecord()){
                include "application/views/applications/applicationsView.php";
                $this->view = new applicationsView();
                $this->view->view_data = $this->get_details();
                $this->view->view_data["rd"] = $this->model->record;
                $this->view->generate();
            }else{
                throwErr("404", "controller applications details: unknown appl id");
            }
        }else{
            throwErr("404", "controller applications details: no appl id");
        }
    }

    function addComment()
    {

        global $routes;
        if($_POST["appl-f-nc"]=="y"){
            $commentModel = new RecordsModel();
            $commentModel->tableName = "applCm_dt";
            $commentModel->getRecordStructure();

            $commentModel->record["appl_id"]["curVal"] = $routes[3];


            if(strlen($_POST["content"]) > 1){
                $commentModel->record["content"]["curVal"] = $_POST["content"].strlen($_POST["content"]);
            }else{
                $applCm_rd["err"]["content"] = "Ничего не введено";
            }
            $commentModel->record["dateEntered"]["curVal"] = date("Y-m-d H:i:s");

            if($_SESSION["site_user"]["user_id"]){
                $commentModel->record["user_id"]["curVal"] = $_SESSION["site_user"]["user_id"];
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
                                    $this->model->record["appl_id"]["curVal"] ) && !is_dir( $_SERVER["DOCUMENT_ROOT"].APPL_UPLOAD_FOLDER."/".
                                    $this->model->record["appl_id"]["curVal"] ) ) {
                                mkdir( $_SERVER["DOCUMENT_ROOT"].APPL_UPLOAD_FOLDER."/".
                                    $this->model->record["appl_id"]["curVal"] );
                            }
                            if (move_uploaded_file($_FILES["applFiles"]['tmp_name'][$fCounter], $_SERVER["DOCUMENT_ROOT"].APPL_UPLOAD_FOLDER."/".
                                $this->model->record["appl_id"]["curVal"]."/".$path_parts['basename'])) {
                            } else {
                                $addCmmErr = "Возможная атака с помощью файловой загрузки!\n";
                            }
                        }
                    }
                }
                if(count($uplAttach)){
                    $commentModel->record["attach"]["curVal"] = json_encode($uplAttach);
                }
            }

            if($commentModel->insertRecord()){

            }
        }
    }

    function get_details()
    {
        $this->addComment();
        if($this->model->record["basket"]["curVal"]){
            $basket = json_decode($this->model->record["basket"]["curVal"], true);

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
left join usersToGroups_dt on applCm_dt.user_id = usersToGroups_dt.user_id and group_id = 'A8357ED4-D2FD-45B3-9ACD-950950BE3535' 
left join users_dt on users_dt.user_id = usersToGroups_dt.user_id 
where appl_id = '".$this->model->record["appl_id"]["curVal"]."'
order by applCm_dt.dateEntered desc";
        $findApplCm_res = $this->model->query($findApplCm_qry);

        $viewData["findApplCm"] = $findApplCm_res;

        return $viewData;

    }
}