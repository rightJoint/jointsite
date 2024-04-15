<?php
include "application/core/Records/RecordsModel.php";
class Model_User extends RecordsModel
{
    public $tableName = "users_dt";
    function getRecordStructure()
    {
        $this->record = array(
            "user_id" => array(
                "indexes" => true,
                "format" => "varchar",
            ),
            "accLogin" => array(
                "format" => "varchar",
            ),
            "accAlias" => array(
                "format" => "varchar",
            ),
            "pw_hash" => array(
                "format" => "varchar",
            ),
            "vldCode" => array(
                "format" => "varchar",
            ),
            "regDate" => array(
                "format" => "datetime",
            ),
            "netWork" => array(
                "format" => "varchar",
            ),
            "validDate" => array(
                "format" => "datetime",
            ),
            "photoLink" => array(
                "format" => "varchar",
            ),
            "eMail" => array(
                "format" => "varchar",
            ),
            "birthDay" => array(
                "format" => "date",
            ),
            "socProf" => array(
                "format" => "varchar",
            ),
            "blackList" => array(
                "format" => "tinyint",
            ),
            "created_by" => array(
                "format" => "varchar",
            ),
            "is_admin" => array(
                "format" => "tinyint",
            ),
            "send_ntf" => array(
                "format" => "tinyint",
            ),

        );
        $this->editFields = array(
            "user_id" => array(
                "indexes" => true,
                "format" => "varchar",
            ),
            "accLogin" => array(
                "format" => "varchar",
            ),
            "accAlias" => array(
                "format" => "varchar",
            ),
            "pw_hash" => array(
                "format" => "varchar",
            ),
            "vldCode" => array(
                "format" => "varchar",
            ),
            "regDate" => array(
                "format" => "datetime",
            ),
            "netWork" => array(
                "format" => "varchar",
            ),
            "validDate" => array(
                "format" => "datetime",
            ),
            "photoLink" => array(
                "format" => "varchar",
            ),
            "eMail" => array(
                "format" => "varchar",
            ),
            "birthDay" => array(
                "format" => "date",
            ),
            "socProf" => array(
                "format" => "varchar",
            ),
            "blackList" => array(
                "format" => "tinyint",
            ),
            "created_by" => array(
                "format" => "varchar",
            ),
            "is_admin" => array(
                "format" => "tinyint",
            ),
            "send_ntf" => array(
                "format" => "tinyint",
            ),

        );
        $this->listFields = array(
            "btnDetail" => array(
                "replaces" => array("user_id"),
                "format" => "link",
                "url" => "user_id=user_id",
            ),
            "btnEdit" => array(
                "replaces" => array("user_id"),
                "format" => "link",
                "url" => "user_id=user_id",
            ),
            "btnDelete" => array(
                "replaces" => array("user_id"),
                "format" => "link",
                "url" => "user_id=user_id",
            ),
            "user_id" => array(
                "format" => "varchar",
                "maxLength" => 20,
            ),
            "accLogin" => array(
                "format" => "varchar",
                "maxLength" => 20,
            ),
            "accAlias" => array(
                "format" => "varchar",
                "maxLength" => 20,
            ),
            "pw_hash" => array(
                "format" => "varchar",
                "maxLength" => 20,
            ),
            "vldCode" => array(
                "format" => "varchar",
                "maxLength" => 20,
            ),
            "regDate" => array(
                "format" => "datetime",
            ),
            "netWork" => array(
                "format" => "varchar",
                "maxLength" => 20,
            ),
            "validDate" => array(
                "format" => "datetime",
            ),
            "photoLink" => array(
                "format" => "varchar",
                "maxLength" => 20,
            ),
            "eMail" => array(
                "format" => "varchar",
                "maxLength" => 20,
            ),
            "birthDay" => array(
                "format" => "date",
            ),
            "socProf" => array(
                "format" => "varchar",
                "maxLength" => 20,
            ),
            "blackList" => array(
                "format" => "tinyint",
            ),
            "created_by" => array(
                "format" => "varchar",
                "maxLength" => 20,
            ),
            "is_admin" => array(
                "format" => "tinyint",
            ),
            "send_ntf" => array(
                "format" => "tinyint",
            ),

        );
        $this->viewFields = array(
            "user_id" => array(
                "indexes" => true,
                "format" => "varchar",
                "readonly" => true,
            ),
            "accLogin" => array(
                "format" => "varchar",
                "readonly" => true,
            ),
            "accAlias" => array(
                "format" => "varchar",
                "readonly" => true,
            ),
            "pw_hash" => array(
                "format" => "varchar",
                "readonly" => true,
            ),
            "vldCode" => array(
                "format" => "varchar",
                "readonly" => true,
            ),
            "regDate" => array(
                "format" => "datetime",
                "readonly" => true,
            ),
            "netWork" => array(
                "format" => "varchar",
                "readonly" => true,
            ),
            "validDate" => array(
                "format" => "datetime",
                "readonly" => true,
            ),
            "photoLink" => array(
                "format" => "varchar",
                "readonly" => true,
            ),
            "eMail" => array(
                "format" => "varchar",
                "readonly" => true,
            ),
            "birthDay" => array(
                "format" => "date",
                "readonly" => true,
            ),
            "socProf" => array(
                "format" => "varchar",
                "readonly" => true,
            ),
            "blackList" => array(
                "format" => "tinyint",
                "readonly" => true,
            ),
            "created_by" => array(
                "format" => "varchar",
                "readonly" => true,
            ),
            "is_admin" => array(
                "format" => "tinyint",
                "readonly" => true,
            ),
            "send_ntf" => array(
                "format" => "tinyint",
                "readonly" => true,
            ),

        );
        $this->searchFields = array(
            "user_id" => array(
                "format" => "varchar",
                "sort" => true,
                "search" => true,
            ),
            "accLogin" => array(
                "format" => "varchar",
                "sort" => true,
                "search" => true,
            ),
            "accAlias" => array(
                "format" => "varchar",
                "sort" => true,
                "search" => true,
            ),
            "pw_hash" => array(
                "format" => "varchar",
                "sort" => true,
                "search" => true,
            ),
            "vldCode" => array(
                "format" => "varchar",
                "sort" => true,
                "search" => true,
            ),
            "regDate" => array(
                "format" => "datetime",
                "sort" => true,
                "search" => true,
            ),
            "netWork" => array(
                "format" => "varchar",
                "sort" => true,
                "search" => true,
            ),
            "validDate" => array(
                "format" => "datetime",
                "sort" => true,
                "search" => true,
            ),
            "photoLink" => array(
                "format" => "varchar",
                "sort" => true,
                "search" => true,
            ),
            "eMail" => array(
                "format" => "varchar",
                "sort" => true,
                "search" => true,
            ),
            "birthDay" => array(
                "format" => "date",
                "sort" => true,
                "search" => true,
            ),
            "socProf" => array(
                "format" => "varchar",
                "sort" => true,
                "search" => true,
            ),
            "blackList" => array(
                "format" => "tinyint",
                "sort" => true,
                "search" => true,
            ),
            "created_by" => array(
                "format" => "varchar",
                "sort" => true,
                "search" => true,
            ),
            "is_admin" => array(
                "format" => "tinyint",
                "sort" => true,
                "search" => true,
            ),
            "send_ntf" => array(
                "format" => "tinyint",
                "sort" => true,
                "search" => true,
            ),
        );
    }

    function checkUserLogin()
    {
        if (preg_match('/^[a-z]{1}[0-9a-z-._]{2,15}$/imsiu', $this->record["accLogin"]["curVal"]) == 0){
            return false;
        }
        return true;

    }

    function checkUserPassword()
    {
        if (preg_match('/^[a-z]{1}[0-9a-z-._]{2,15}$/imsiu', $_POST["password"]) == 0){
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
        $user_res = $this->listRecords("where users_dt.accLogin='".$this->record["accLogin"]["curVal"]."' or users_dt.eMail='".$this->record["eMail"]["curVal"]."'");
        if(isset($user_res) and count($user_res) == 1) {
            $user_row = $user_res[0];
            foreach ($this->record as $fieldName => $field_data){
                if(!isset($this->record[$fieldName]["curVal"])){
                    $this->record[$fieldName]["curVal"] = $user_row[$fieldName];
                }
            }
            return true;
        }
        return false;
    }

    function auth_user()
    {
        if($this->record["validDate"]["curVal"]){
            if(!$this->record["blackList"]["curVal"]){

                $_SESSION["site_user"]["user_id"] = $this->record["user_id"]["curVal"];
                $_SESSION["site_user"]["accLogin"] = $this->record["accLogin"]["curVal"];
                $_SESSION["site_user"]["accAlias"] = $this->record["accAlias"]["curVal"];
                $_SESSION["site_user"]["is_admin"] = $this->record["is_admin"]["curVal"];
                if($this->record["photoLink"]["curVal"]){
                    $_SESSION["site_user"]["avatar"] = $this->record["photoLink"]["curVal"];
                }
                $groupsModel = new RecordsModel();
                $groupsModel->tableName = "usersToGroups_dt";
                $groupsModel->getRecordStructure();
                $userToGroups_res = $groupsModel->listRecords("where usersToGroups_dt.user_id='".$this->record["user_id"]["curVal"]."' ");

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
                $this->log_message = "user_in_black_list";
            }
        }else{
            $this->log_message = "email_not_validated";
        }
        return false;
    }
}