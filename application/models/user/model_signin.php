<?php
class model_signin extends Model_User
{
    public $login;

    function create_site_user($login, $password, $email)
    {
        $this->recordStructureFields->record["user_id"]["curVal"] = $this->createGUID();
        $this->recordStructureFields->record["accLogin"]["curVal"] = $login;
        $this->recordStructureFields->record["accAlias"]["curVal"] = $login;
        $this->recordStructureFields->record["pw_hash"]["curVal"] = password_hash($password, PASSWORD_DEFAULT);
        $this->recordStructureFields->record["vldCode"]["curVal"] = $this->createGUID();
        $this->recordStructureFields->record["regDate"]["curVal"] = date("Y-m-d H:i:s");
        $this->recordStructureFields->record["netWork"]["curVal"] = "site";
        $this->recordStructureFields->record["validDate"]["curVal"] = null;
        $this->recordStructureFields->record["photoLink"]["curVal"] = null;
        $this->recordStructureFields->record["eMail"]["curVal"] = $email;
        $this->recordStructureFields->record["birthDay"]["curVal"] = null;
        $this->recordStructureFields->record["socProf"]["curVal"] = null;
        $this->recordStructureFields->record["blackList"]["curVal"] = 0;
        $this->recordStructureFields->record["created_by"]["curVal"] = $this->recordStructureFields->record["user_id"]["curVal"];
        $this->recordStructureFields->record["is_admin"]["curVal"] = 0;
        $this->recordStructureFields->record["send_ntf"]["curVal"] = 1;
        $this->recordStructureFields->record["pref_lang"]["curVal"] = "rus";

        return $this->insertRecord();
    }

    function auth_site_user()
    {
        if(password_verify($_POST['password'], $this->recordStructureFields->record["pw_hash"]["curVal"])) {
            if($this->auth_user()){
                header("Location: ".$_SERVER["HTTP_REFERER"]);
            }else{
                return false;
            }
        }else{
            $this->log_message = "wrong_login_or_pass";
            return false;
        }
    }

    function checkDoubleLogin($login)
    {
        $countLogin_qry = "select count(user_id) as cnt from users_dt where accLogin = '".$login."'";
        if(!$this->query($countLogin_qry)->fetch(PDO::FETCH_ASSOC)["cnt"]){
            return true;
        }
        return false;
    }

    function ok_auth()
    {
        include JOINT_CONF_DIR."/social_auth.php";
        $ok_conf = $auth_conf["ok"];

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
                $this->recordStructureFields->record["netWork"]["curVal"] = "ok";
                $this->recordStructureFields->record["accLogin"]["curVal"] = $usrArr['uid'];
                $this->recordStructureFields->record["accAlias"]["curVal"] = $usrArr['name'];
                $this->recordStructureFields->record["photoLink"]["curVal"] = $usrArr['pic_2'];
                $this->recordStructureFields->record["birthDay"]["curVal"] = $usrArr['birthday'];
                $this->recordStructureFields->record["socProf"]["curVal"] = "https://ok.ru/profile/".$usrArr['uid'];
                return true;
            }else{
                $this->log_message = "no-user-uid";
            }
        }else{
            $this->log_message = "access_token-problem";
        }
        return false;
    }

    function vk_auth()
    {
        include JOINT_CONF_DIR."/social_auth.php";
        $vk_conf = $auth_conf["vk"];
        $tokenReq=file_get_contents("https://oauth.vk.com/access_token?client_id=".$vk_conf['client_id']
            ."&client_secret=".$vk_conf['client_secret']."&redirect_uri=".$vk_conf['redirect_uri']."&code=".$_GET['code']);

        if($tokenArr=json_decode($tokenReq, true)){
            if(isset($tokenArr['access_token']) and $tokenArr['access_token']!=null){
                $usrReq = @file_get_contents('https://api.vk.com/method/users.get?user_ids='. $tokenArr['user_id'].
                    "&fields=photo_100,bdate&v=6.0&access_token=".$tokenArr['access_token']);
                $usrArr = json_decode($usrReq, true);
                if($usrArr!=null and isset($usrArr['response']['0']['id']) and $usrArr['response']['0']['id']!=null){
                    $this->recordStructureFields->record["netWork"]["curVal"] = "vk";
                    $this->recordStructureFields->record["accLogin"]["curVal"] = $usrArr['response']['0']['id'];
                    $this->recordStructureFields->record["accAlias"]["curVal"] = $usrArr['response']['0']['first_name']." ".$usrArr['response']['0']['last_name'];
                    $this->recordStructureFields->record["photoLink"]["curVal"] = $usrArr['response']['0']['photo_100'];
                    $this->recordStructureFields->record["birthDay"]["curVal"] = date_format(date_create($usrArr['response']['0']['bdate']), 'Y-m-d');
                    $this->recordStructureFields->record["socProf"]["curVal"] = 'https://vk.com/id'.$usrArr['response']['0']['id'];
                    return true;
                }else{
                    $this->log_message = $usrReq;
                }
            }else{
                $this->log_message = $tokenReq;
            }
        }else{
            $this->log_message = "null token from vk";
        }

        return false;
    }
}