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
}