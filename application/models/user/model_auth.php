<?php
include "application/core/Module/ntSendModel.php";
class Model_Auth extends Model_User
{
    public $login;

    function create_site_user($login, $password, $email)
    {
        $user = new RecordsModel();
        $user->tableName = "users_dt";
        $user->getRecordStructure();
        $user->record["user_id"]["curVal"] = $this->createGUID();
        $user->record["accLogin"]["curVal"] = $login;
        $user->record["accAlias"]["curVal"] = $login;
        $user->record["pw_hash"]["curVal"] = password_hash($password, PASSWORD_DEFAULT);
        $user->record["vldCode"]["curVal"] = $this->createGUID();
        $user->record["regDate"]["curVal"] = date("Y-m-d H:i:s");
        $user->record["netWork"]["curVal"] = "site";
        $user->record["validDate"]["curVal"] = null;
        $user->record["photoLink"]["curVal"] = null;
        $user->record["eMail"]["curVal"] = $email;
        $user->record["birthDay"]["curVal"] = null;
        $user->record["socProf"]["curVal"] = null;
        $user->record["blackList"]["curVal"] = 0;
        $user->record["created_by"]["curVal"] = $user->record["user_id"]["curVal"];
        $user->record["is_admin"]["curVal"] = 0;

        if($user->insertRecord()){
            require_once "application/core/Module/ntSendModel.php";
            $UserNtf_model = new ntSendModel();
            $UserNtf_model->AddNtf("welcomeFromSiteForUser", "user",
                $user->record["user_id"]["curVal"], json_encode(
                    array(
                        "accLogin" => $user->record["accLogin"]["curVal"],
                        "accAlias" => $user->record["accAlias"]["curVal"],
                        "accPass" => $password,
                        "validCode" => $user->record["vldCode"]["curVal"],
                        "host" => $_SERVER["HTTP_HOST"],
                    )
                ), true, "default");
            $UserNtf_model->AddNtf("newUserOnSite-site", "group",
                "A8357ED4-D2FD-45B3-9ACD-950950BE3535", json_encode(
                    array(
                        "accLogin" => $user->record["accLogin"]["curVal"],
                        "accAlias" => $user->record["accAlias"]["curVal"],
                    )
                ), true, "default");
        }

    }

    function auth_site_user()
    {
        if(password_verify($_POST['password'], $this->record["pw_hash"]["curVal"])) {
            return $this->auth_user();
        }else{
            return "wrong_login_or_pass";
        }
    }

    function ok_auth()
    {
        include JOINT_CONF_DIR."/social_auth.php";
        $ok_conf = $auth_conf["ok"];
        $this->record["accLogin"]["curVal"] = "xerman3";
        $this->record["netWork"]["curVal"] = "ok";
        $this->record["accAlias"]["curVal"] = "XER-XER1";
        //$this->record["photoLink"]["curVal"] = $usrArr['pic_2'];
        //$this->record["birthDay"]["curVal"] = $usrArr['birthday'];
        $this->record["socProf"]["curVal"] = "https://ok.ru/profile/xer-man";
        $this->record["regDate"]["curVal"] = $this->record["validDate"]["curVal"] = date("Y-m-h H:i:s");
        $this->record["blackList"]["curVal"] = false;

        //$this->log_message = "test-ok-err";
        return true;

        $postReq = http_build_query(
            array(
                'code' => $_GET['code'],
                'client_id' => $ok_conf['client_id'],
                'client_secret' => $ok_conf['client_secret'],
                "redirect_uri" => $ok_conf['redirect_uri'],
                "grant_type" => "authorization_code"
            )
        );
        $opts = array('http' =>
            array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postReq
            )
        );
        $context = stream_context_create($opts);
        $tokenReq = file_get_contents('https://api.ok.ru/oauth/token.do?', false, $context);
        $tokenArr = json_decode($tokenReq, true);
        if(isset($tokenArr['access_token']) and $tokenArr['access_token']!=null){
            $secret_key = MD5($tokenArr['access_token'] . $ok_conf['client_secret']);
            $sig = MD5("application_key=" . $ok_conf['application_key'] . "format=jsonmethod=users.getCurrentUser" . $secret_key);

            $usrReq = file_get_contents("https://api.ok.ru/fb.do?application_key=" . $ok_conf['application_key'] . "&format=json" .
                "&method=users.getCurrentUser&sig=" . $sig . "&access_token=" . $tokenArr['access_token']);
            $usrArr = json_decode($usrReq, true);

            if(isset($usrArr['uid']) and $usrArr['uid']!=null){
                $this->record["netWork"]["curVal"] = "ok";
                $this->record["accLogin"]["curVal"] = $usrArr['uid'];
                $this->record["accAlias"]["curVal"] = $usrArr['name'];
                $this->record["photoLink"]["curVal"] = $usrArr['pic_2'];
                $this->record["birthDay"]["curVal"] = $usrArr['birthday'];
                $this->record["socProf"]["curVal"] = "https://ok.ru/profile/".$usrArr['uid'];
                $this->record["regDate"]["curVal"] = date("Y-m-h H:i:s");
                $this->record["blackList"]["curVal"] = false;
                return true;
            }else{
                $this->log_message = "no-user-uid";
            }
        }else{
            $this->log_message = "access_token-problem";
        }
        return false;
    }

    function checkDoubleLogin($login)
    {
        $countLogin_qry = "select count(user_id) as cnt from users_dt where accLogin = '".$login."'";
        if(!$this->query($countLogin_qry)->fetch(PDO::FETCH_ASSOC)["cnt"]){
            return true;
        }
        return false;
    }
}