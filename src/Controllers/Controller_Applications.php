<?php


namespace Src\Controllers;


use JointApp\Controllers\Records\RecordsController;

class Controller_Applications extends RecordsController
{
    public function loadLangController():string
    {
        parent::loadLangController();
        $name = 'LangFiles_'.$this->langNs.'_Controller_Applications';
        require_once $this->docRoot.'/LangFiles/Controllers/Applications/'.$name.'.php';
        return $name;
    }


    function mkApplicationModal()
    {
        $errFlag = false;

        $this->prepareEditFields();
        $this->updateModelRecordFromRequest();


        if($this->model->checkClientName()){
            $fbfmResponse['clientName']['err'] = 0;
        }else{
            $errFlag = true;
            $fbfmResponse['clientName']['err'] = 1;
            $fbfmResponse['clientName']['info'] = $this->langMap->mkAppErr->err_f.': '.
                $this->langMap->mkAppErr->err_1;
        }

        if($this->model->checkUserEmail()){
            $fbfmResponse['clientMail']['err'] = 0;
        }else{
            $errFlag = true;
            $fbfmResponse['clientMail']['err'] = 1;
            $fbfmResponse['clientMail']['info'] = $this->langMap->mkAppErr->err_f.': '.
                $this->langMap->mkAppErr->err_2;
        }


        //$_SESSION['basket']['lang'] = $_SESSION['lang'];
        if(isset($_SESSION['basket']['total'])){
            $this->model->record['basket']['curVal'] = json_encode($_SESSION['basket']);
            $fbfmResponse['clientSubject']['err'] = 0;
        }else{
            if(strlen($_POST['clientSubject'])>10){
                $fbfmResponse['clientSubject']['err'] = 0;
            }else{
                $errFlag = true;
                $fbfmResponse['clientSubject']['err'] = 1;
                $fbfmResponse['clientSubject']['info'] = $this->langMap->mkAppErr->err_f.': '.
                    $this->langMap->mkAppErr->err-3;
            }
        }
        if(isset($_SESSION['user_id'])){
            $this->model->record['user_id']['curVal'] = $_SESSION['site_user']['user_id'];
        }
        $this->model->record['status']['curVal'] = 'new';
        $this->model->record['payStatus']['curVal'] = 'not-paid';

        if(!$errFlag){
            $this->model->record['dateEntered']['curVal'] = date('Y-m-d H:i:s');
            if($this->model->insertRecord()){
                //unset($_SESSION["basket"]);
                $fbfmResponse['fbfa']=1;
                $fbfmResponse['redirectUrl']='/applications/details/'.$this->model->record['appl_id']['curVal'];




                /*
                require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
                    "/application/core/ntSendModel.php";
                $ntSend_model = new ntSendModel();

                $ntSend_model->AddNtf("new-app-siteman", "user",
                    "F42F81F8-1300-41CA-89BB-36BD7417BE1E", json_encode(
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
                */

            }else{
                    $fbfmResponse["mo-submit"]["err"]=1;
                    $fbfmResponse["mo-submit"]["info"] = "ошибка: неизвестная ошибка DB->putOne";
            }
        }

        $this->view->responseJson = $fbfmResponse;
    }
}