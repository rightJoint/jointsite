<?php
require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
    "/application/core/RecordsController.php";
class controller_api extends RecordsController
{
    function __construct($loaded_model, $loaded_view, $action_name)
    {
        $this->checkAccessController();
        parent::__construct($loaded_model, $loaded_view, $action_name);
    }

    static function checkAccessController()
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
            $access_err = "token file ".JOINT_SITE_APP_CONFIG."/api/access_token.txt not exist";
        }
        jointSite::throwErr("access", "denied in rest api contoller cause ".$access_err);
    }
}