<?php

namespace JointApp\Models\User;

use JointApp\Factories\ModelFactory;
use JointApp\JointAppQueryBuilder;
use JointApp\Models\Records\RecordsModel;

class Model_User extends RecordsModel
{
    use UserTrait;

    public string $tableName = "users_dt";



    function copyByLoginOrEmail():bool
    {
        $qBuilder = new JointAppQueryBuilder();

        $where = '';
        if(isset($this->record["accLogin"]["curVal"])){
            //$qBuilder->where("where users_dt.accLogin='".$this->record["accLogin"]["curVal"]."'");
            $where = "users_dt.accLogin='".
                $this->record["accLogin"]["curVal"]."'";
            if(isset($this->record["eMail"]["curVal"])){

                $where .= " or users_dt.eMail='".
                    $this->record["eMail"]["curVal"]."'";
            }


        }elseif(isset($this->record["eMail"]["curVal"])){

            $where = " users_dt.eMail='".
                $this->record["eMail"]["curVal"]."'";
        }
        $user_res = [];
        if(!empty($where)){
            $qBuilder->where($where);
            $user_res = $this->listRecords($qBuilder);
        }

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

    public function authSiteUser()
    {
        $_SESSION["site_user"]["user_id"] = $this->record["user_id"]["curVal"];
        $_SESSION["site_user"]["accLogin"] = $this->record["accLogin"]["curVal"];
        $_SESSION["site_user"]["accAlias"] = $this->record["accAlias"]["curVal"];
        $_SESSION["site_user"]["is_admin"] = $this->record["is_admin"]["curVal"];
        $_SESSION["site_user"]["network"] = $this->record["netWork"]["curVal"];
        if($this->record["photoLink"]["curVal"]){
            $_SESSION["site_user"]["photoLink"] = $this->record["photoLink"]["curVal"];
        }

        $groupsModel = ModelFactory::createFromExistModel('JointApp\Models\Records\RecordsModel', $this, ['tableName' => 'usersToGroups_dt']);

        $qBuilder = new JointAppQueryBuilder();
        $qBuilder->where('usersToGroups_dt.user_id="'.$this->record["user_id"]["curVal"].'"');
        $userToGroups_res = $groupsModel->listRecords($qBuilder);


        if(is_array($userToGroups_res) and count($userToGroups_res) > 0){
            foreach ($userToGroups_res as $row_num => $userToGroups_row){
                $_SESSION["site_user"]["groups"][$userToGroups_row["group_id"]] = array(
                    "read_rule" => $userToGroups_row["read_rule"],
                    "create_rule" => $userToGroups_row["create_rule"],
                    "edit_rule" => $userToGroups_row["edit_rule"],
                    "delete_rule" => $userToGroups_row["delete_rule"],
                );
            }
        }
    }

    function checkDoubleLogin($login):bool
    {
        $countLogin_qry = "select count(user_id) as cnt from users_dt where accLogin = '".$login."'";
        if(!$this->pdoQuery($countLogin_qry)->fetch(\PDO::FETCH_ASSOC)["cnt"]){
            return true;
        }
        return false;
    }

    function createSiteUser($login, $password, $email):bool
    {
        $this->record["user_id"]["curVal"] = $this->createGUID();
        $this->record["accLogin"]["curVal"] = $login;
        $this->record["accAlias"]["curVal"] = $login;
        $this->record["pw_hash"]["curVal"] = password_hash($password, PASSWORD_DEFAULT);
        $this->record["vldCode"]["curVal"] = $this->createGUID();
        $this->record["regDate"]["curVal"] = date("Y-m-d H:i:s");
        $this->record["netWork"]["curVal"] = "site";
        $this->record["validDate"]["curVal"] = null;
        $this->record["photoLink"]["curVal"] = null;
        $this->record["eMail"]["curVal"] = $email;
        $this->record["birthDay"]["curVal"] = null;
        $this->record["socProf"]["curVal"] = null;
        $this->record["blackList"]["curVal"] = 0;
        $this->record["created_by"]["curVal"] = $this->record["user_id"]["curVal"];
        $this->record["is_admin"]["curVal"] = 0;
        $this->record["send_ntf"]["curVal"] = 1;
        $this->record["pref_lang"]["curVal"] = $this->langLw;

        return $this->insertRecord();
    }
}