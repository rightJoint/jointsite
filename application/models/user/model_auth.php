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
                    )
                ), true);
            $UserNtf_model->AddNtf("newUserOnSite-site", "group",
                "A8357ED4-D2FD-45B3-9ACD-950950BE3535", json_encode(
                    array(
                        "accLogin" => $user->record["accLogin"]["curVal"],
                        "accAlias" => $user->record["accAlias"]["curVal"],
                    )
                ), true);
        }

    }

    function auth_site_user()
    {
        $this->tableName = "users_dt";
        $this->getRecordStructure();

        $user_res = $this->listRecords("where users_dt.accLogin='".$this->login."' ");
        if(isset($user_res) and count($user_res) == 1){
            $user_row = $user_res[0];
            if(password_verify($_POST['password'], $user_row["pw_hash"])){
                if($user_row["validDate"]){
                    if(!$user_row["blackList"]){

                        $_SESSION["site_user"]["user_id"] = $user_row["user_id"];
                        $_SESSION["site_user"]["accLogin"] = $user_row["accLogin"];
                        $_SESSION["site_user"]["accAlias"] = $user_row["accAlias"];
                        if($user_row["photoLink"]){
                            $_SESSION["site_user"]["avatar"] = $user_row["photoLink"];
                        }
                        $groupsModel = new RecordsModel();
                        $groupsModel->tableName = "usersToGroups_dt";
                        $groupsModel->getRecordStructure();
                        $userToGroups_res = $groupsModel->listRecords("where usersToGroups_dt.user_id='".$user_row["user_id"]."' ");

                        if(count($userToGroups_res)){
                            foreach ($userToGroups_res as $row_num => $userToGroups_row){
                                $_SESSION["site_user"]["groups"][$userToGroups_row["group_id"]] = array(
                                    "read_rule" => $userToGroups_row["read_rule"],
                                    "create_rule" => $userToGroups_row["create_rule"],
                                    "edit_rule" => $userToGroups_row["edit_rule"],
                                    "delete_rule" => $userToGroups_row["delete_rule"],
                                );
                            }
                        }
                        header("Location: ".$_SERVER["HTTP_REFERER"]);
                    }else{

                        return "user_in_black_list";
                    }
                }else{
                    return "email_not_validated";
                }
            }else{
                return "wrong_login_or_pass";
            }
        }else{
            return "wrong_login_or_pass";
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