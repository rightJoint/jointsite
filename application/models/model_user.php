<?php
require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
    "/application/core/RecordsModel.php";
class Model_User extends RecordsModel
{
    public $tableName = "users_dt";

    function checkUserLogin()
    {
        if (preg_match('/^[a-z]{1}[0-9a-z-._]{2,15}$/imsiu', $_POST["login"]) == 0){
            return false;
        }
        return true;

    }

    function checkUserPassword($password)
    {
        if (preg_match('/^[a-z]{1}[0-9a-z-._]{2,15}$/imsiu', $password) == 0){
            return false;
        }else{
            return true;
        }
    }

    function checkUserEmail($user_email)
    {
        if (filter_var($user_email, FILTER_VALIDATE_EMAIL)){
            return true;
        }else{
            return false;
        }
    }

    function copy_by_login_or_email()
    {
        $curVal_where = null;
        if(isset($this->recordStructureFields->record["accLogin"]["curVal"])){
            $curVal_where = "where users_dt.accLogin='".
                $this->recordStructureFields->record["accLogin"]["curVal"]."'";
            if(isset($this->recordStructureFields->record["eMail"]["curVal"])){

                $curVal_where .= " or users_dt.eMail='".
                    $this->recordStructureFields->record["eMail"]["curVal"]."'";
            }

        }elseif(isset($this->recordStructureFields->record["eMail"]["curVal"])){

            $curVal_where = " where users_dt.eMail='".
                $this->recordStructureFields->record["eMail"]["curVal"]."'";
        }
        if($curVal_where != null){
            $user_res = $this->listRecords($curVal_where);
        }
        if(isset($user_res) and count($user_res) == 1) {
            $user_row = $user_res[0];
            foreach ($this->recordStructureFields->record as $fieldName => $field_data){
                if(!isset($this->recordStructureFields->record[$fieldName]["curVal"])){
                    $this->recordStructureFields->record[$fieldName]["curVal"] = $user_row[$fieldName];
                }
            }
            return true;
        }
        return false;
    }

    protected function auth_user()
    {
        if($this->recordStructureFields->record["validDate"]["curVal"]){
            if(!$this->recordStructureFields->record["blackList"]["curVal"]){

                $_SESSION[JS_SAIK]["site_user"]["user_id"] = $this->recordStructureFields->record["user_id"]["curVal"];
                $_SESSION[JS_SAIK]["site_user"]["accLogin"] = $this->recordStructureFields->record["accLogin"]["curVal"];
                $_SESSION[JS_SAIK]["site_user"]["accAlias"] = $this->recordStructureFields->record["accAlias"]["curVal"];
                $_SESSION[JS_SAIK]["site_user"]["is_admin"] = $this->recordStructureFields->record["is_admin"]["curVal"];
                if($this->recordStructureFields->record["photoLink"]["curVal"]){
                    $_SESSION[JS_SAIK]["site_user"]["avatar"] = $this->recordStructureFields->record["photoLink"]["curVal"];
                }
                $groupsModel = new RecordsModel("usersToGroups_dt");
                $userToGroups_res = $groupsModel->listRecords("where usersToGroups_dt.user_id='".$this->recordStructureFields->record["user_id"]["curVal"]."' ");

                if(is_array($userToGroups_res) and count($userToGroups_res) > 0){
                    foreach ($userToGroups_res as $row_num => $userToGroups_row){
                        $_SESSION[JS_SAIK]["site_user"]["groups"][$userToGroups_row["group_id"]] = array(
                            "read_rule" => $userToGroups_row["read_rule"],
                            "create_rule" => $userToGroups_row["create_rule"],
                            "edit_rule" => $userToGroups_row["edit_rule"],
                            "delete_rule" => $userToGroups_row["delete_rule"],
                        );
                    }
                }
                return true;
            }else{
                $this->log_message = "user_in_black_list";
            }
        }else{
            $this->log_message = "email_not_validated";
        }
        return false;
    }
}