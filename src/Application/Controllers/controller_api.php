<?php
require_once JOINT_SITE_REQUIRE_DIR."/application/core/RecordsController.php";
class controller_api extends RecordsController
{
    public function records_process($process_path=null,
                                    $default_table = null, //
                                    $view_data = null):bool
    {
        if(!$this->checkAccessController()){
            return false;
        }
        return parent::records_process($process_path, $default_table, $view_data);

    }

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
            }else{
                $access_err = "wrong access token";
            }
        }else{
            $access_err = "token file ".JOINT_SITE_CONF_DIR."/api/access_token.txt not exist";
        }
        return jointSite::throwErr("access", "denied in rest api contoller cause ".$access_err);
    }
}