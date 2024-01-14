<?php
class recorduserstogroupsModel extends ModuleRecordsModel
{

    public $tableName = "usersToGroups_dt";
    public $modelAliases = array(
        "en" => "Users groups",
        "rus" => "Группы пользователей",
    );

    function __construct()
    {
        $this->lang_map["rules"] = array(
            "any" => array(
                "en" => "anyone",
                "rus" => "Любой",
            ),
            "own" => array(
                "en" => "owner",
                "rus" => "владелец",
            ),
            "forbidden" => array(
                "en" => "forbidden",
                "rus" => "запрещен",
            ),
            "enable" => array(
                "en" => "enable",
                "rus" => "Может",
            ),
            "disable" => array(
                "en" => "disable",
                "rus" => "Выключено",
            ),
        );
        parent::__construct();
    }

    public function getRecordStructure()
    {
        $this->record = array(
            "group_id" => array(
                "indexes" => 1,
                "format" => "varchar",
                "use_table_name" => "usersToGroups_dt",
            ),
            "user_id" => array(
                "indexes" => 1,
                "format" => "varchar",
                "use_table_name" => "usersToGroups_dt",
            ),
            "read_rule" => array(
                "format" => "varchar",
            ),
            "create_rule" => array(
                "format" => "varchar",
            ),
            "edit_rule" => array(
                "format" => "varchar",
            ),
            "delete_rule" => array(
                "format" => "varchar",
            ),
            "created_by" => array(
                "format" => "varchar",
                "curVal" => $_SESSION["site_user"]["user_id"],
            ),
            "createdLogin" => array(
                "format" => "varchar",
                "use_table_name" => "udtcreated",
                "curVal" => $_SESSION["site_user"]["accLogin"],
            ),
            "groupAlias" => array(
                "format" => "varchar",
                "use_table_name" => "usersGroups_dt",
                "use_filed_name" => "groupAlias",
            ),
            "send_ntf" => array(
                "format" => "tinyint",
            ),
        );

        $this->editFields = array(
            "group_id" => array(
                "indexes" => 1,
                "format" => "select",
                "filling" => $this->fillGroups_name(),
                "fieldAliases" => array(
                    "en" => "Group",
                    "rus" => "Группа",
                ),
            ),
            "user_id" => array(
                "indexes" => 1,
                "format" => "select",
                "filling" => $this->fillUser_id(),
                "fieldAliases" => array(
                    "en" => "Login",
                    "rus" => "Логин",
                ),
            ),
            "read_rule" => array(
                "format" => "select",
                "fieldAliases" => array(
                    "en" => "View",
                    "rus" => "Просмотр",
                ),
                "filling" => $this->fillViewRule("read"),
            ),
            "create_rule" => array(
                "format" => "select",
                "fieldAliases" => array(
                    "en" => "Create",
                    "rus" => "Создание",
                ),
                "filling" => $this->fillViewRule("create"),
            ),
            "edit_rule" => array(
                "format" => "select",
                "fieldAliases" => array(
                    "en" => "Edit",
                    "rus" => "Редактирование",
                ),
                "filling" => $this->fillViewRule("edit"),
            ),
            "delete_rule" => array(
                "format" => "select",
                "fieldAliases" => array(
                    "en" => "Delete",
                    "rus" => "Удаление",
                ),
                "filling" => $this->fillViewRule("delete"),
            ),
            "send_ntf" => array(
                "format" => "tinyint",
                "fieldAliases" => array(
                    "en" => "Notification",
                    "rus" => "Оповещение",
                ),
            ),
            "createdLogin" => array(
                "format" => "varchar",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "Owner",
                    "rus" => "Владелец",
                ),
            ),
            "created_by" => array(
                "format" => "hidden",
                "fieldAliases" => array(
                    "en" => "Created by",
                    "rus" => "Создал(а)",
                ),
                "readonly" => 1,
            ),
        );

        $this->listFields = array(
            "btnDetail" => array(
                "replaces" => array("group_id", "user_id"),
                "format" => "link",
                "url" => "group_id=group_id&user_id=user_id",
            ),
            "btnEdit" => array(
                "replaces" => array("group_id", "user_id"),
                "format" => "link",
                "url" => "group_id=group_id&user_id=user_id",
            ),
            "btnDelete" => array(
                "replaces" => array("group_id", "user_id"),
                "format" => "link",
                "url" => "group_id=group_id&user_id=user_id",
            ),

            "group_id" => array(
                "format" => "hidden",
                "maxLength" => 20,
                "fieldAliases" => array(
                    "en" => "Group",
                    "rus" => "Группа",
                )
            ),
            "groupAlias" => array(
                "format" => "varchar",
                "maxLength" => 20,
                "fieldAliases" => array(
                    "en" => "groupAlias",
                    "rus" => "Назв. гр.",
                )
            ),
            "userLogin" => array(
                "format" => "varchar",
                "maxLength" => 20,
                "fieldAliases" => array(
                    "en" => "Login",
                    "rus" => "Логин",
                ),
            ),


            "user_id" => array(
                "format" => "hidden",
                "maxLength" => 20,
            ),

            "read_rule" => array(
                "format" => "select",
                "fieldAliases" => array(
                    "en" => "View",
                    "rus" => "Просмотр",
                ),
                "filling" => $this->fillViewRule("read"),
            ),
            "create_rule" => array(
                "format" => "select",
                "fieldAliases" => array(
                    "en" => "Create",
                    "rus" => "Создание",
                ),
                "filling" => $this->fillViewRule("create"),
            ),
            "edit_rule" => array(
                "format" => "select",
                "fieldAliases" => array(
                    "en" => "Edit",
                    "rus" => "Редактирование",
                ),
                "filling" => $this->fillViewRule("edit"),
            ),
            "delete_rule" => array(
                "format" => "select",
                "fieldAliases" => array(
                    "en" => "Delete",
                    "rus" => "Удаление",
                ),
                "filling" => $this->fillViewRule("delete"),
            ),
            "send_ntf" => array(
                "format" => "tinyint",
                "fieldAliases" => array(
                    "en" => "Notification",
                    "rus" => "Оповещение",
                ),
            ),
            "createdLogin" => array(
                "format" => "varchar",
                "maxLength" => 20,
                "fieldAliases" => array(
                    "en" => "Owner",
                    "rus" => "Владелец",
                ),
            ),



            /*
            "created_by" => array(
                "format" => "varchar",
            ),*/
        );

        $this->searchFields = array(
            "groupAlias" => array(
                "format" => "varchar",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "Group",
                    "rus" => "Группа",
                ),
                "use_table_name" => "usersGroups_dt",
                "use_field_name" => "groupAlias_".$_SESSION["lang"],
            ),
            "userLogin" => array(
                "indexes" => 1,
                "format" => "varchar",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "Login",
                    "rus" => "Логин",
                ),
                "use_table_name" => "udtuser",
                "use_field_name" => "accLogin",
            ),
            "read_rule" => array(
                "format" => "select",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "View",
                    "rus" => "Просмотр",
                ),
                "filling" => $this->fillViewRule("read"),
            ),
            "create_rule" => array(
                "format" => "select",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "Create",
                    "rus" => "Создание",
                ),
                "filling" => $this->fillViewRule("create"),
            ),
            "edit_rule" => array(
                "format" => "select",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "Edit",
                    "rus" => "Редактирование",
                ),
                "filling" => $this->fillViewRule("edit"),
            ),
            "delete_rule" => array(
                "format" => "select",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "Delete",
                    "rus" => "Удаление",
                ),
                "filling" => $this->fillViewRule("delete"),
            ),
            "send_ntf" => array(
                "format" => "tinyint",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "Notification",
                    "rus" => "Оповещение",
                ),
            ),
            "createdLogin" => array(
                "format" => "varchar",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "Owner",
                    "rus" => "Владелец",
                ),
                "use_table_name" => "udtcreated",
                "use_field_name" => "accLogin",
            ),

            /*
            "created_by" => array(
                "format" => "varchar",
                "sort" => 1,
                "search" => 1,
            ),*/
        );

        $this->viewFields = array(
            "group_id" => array(
                "indexes" => 1,
                "format" => "varchar",
                "readonly" => 1,
            ),
            "user_id" => array(
                "indexes" => 1,
                "format" => "varchar",
                "readonly" => 1,
            ),
            "read_rule" => array(
                "format" => "varchar",
                "readonly" => 1,
            ),
            "create_rule" => array(
                "format" => "varchar",
                "readonly" => 1,
            ),
            "edit_rule" => array(
                "format" => "varchar",
                "readonly" => 1,
            ),
            "delete_rule" => array(
                "format" => "varchar",
                "readonly" => 1,
            ),
            "send_ntf" => array(
                "format" => "tinyint",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "Notification",
                    "rus" => "Оповещение",
                ),
            ),
            "created_by" => array(
                "format" => "varchar",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "Created by",
                    "rus" => "Создал(а)",
                ),
            ),
        );
    }

    public function copyRecord(){
        $query_text="select ".$this->tableName.".*, users_dt.accLogin as createdLogin from ".$this->tableName.
            " left join users_dt on usersToGroups_dt.created_by = users_dt.user_id ".
            " where ";
        foreach ($this->record as $fieldName=>$fieldInfo) {
            if ($fieldInfo["indexes"]) {
                if($fieldInfo["use_table_name"]){
                    $query_text.=$fieldInfo["use_table_name"].".";
                }
                $query_text.=$fieldName."='".$fieldInfo["curVal"]."' and " ;
            }
        }
        $query_text = substr($query_text, 0, strlen($query_text)-4);

        $query_res = $this->query($query_text);

        if($query_res->rowCount()===1){
            $result=$query_res->fetch(PDO::FETCH_ASSOC);
            foreach ($this->record as $fieldName=>$fieldInfo) {
                $this->record[$fieldName]["curVal"] = $result[$fieldName];
                $this->record[$fieldName]["fetchVal"] = $result[$fieldName];
            }
            return true;
        }
        $this->log_message = "copyRecord fail";
        return false;
    }

    public function listRecords($where = null, $order = null, $limit = null)
    {
        $findList_qry = "select ".
            $this->tableName.".group_id, ".
            $this->tableName.".user_id, ".
            $this->tableName.".read_rule, ".
            $this->tableName.".create_rule, ".
            $this->tableName.".edit_rule, ".
            $this->tableName.".delete_rule, ".
            $this->tableName.".created_by, ".
            $this->tableName.".send_ntf, ".
            "udtcreated.accLogin as createdLogin, ".
            "udtuser.accLogin as userLogin, ".
            "usersGroups_dt.groupAlias_".$_SESSION["lang"]." as groupAlias ".
            "from ".$this->tableName." ".
            "left join users_dt udtcreated on ".$this->tableName.".created_by = udtcreated.user_id ".
            "left join users_dt udtuser on ".$this->tableName.".user_id = udtuser.user_id ".
            "inner join usersGroups_dt on usersGroups_dt.group_id = ".$this->tableName.".group_id ".
            $where.$order.$limit;

        return $this->fetchToArray($findList_qry);
    }

    public function countRecords($where = null)
    {
        $countUsers_qry = "select count(*) as cnt ".
            "from ".$this->tableName." ".
            "left join users_dt udtcreated on ".$this->tableName.".created_by = udtcreated.user_id ".
            "left join users_dt udtuser on ".$this->tableName.".user_id = udtuser.user_id ".
            "inner join usersGroups_dt on usersGroups_dt.group_id = ".$this->tableName.".group_id ".
            $where;

        return $this->query($countUsers_qry)->fetch(PDO::FETCH_ASSOC)["cnt"];
    }

    function fillUser_id()
    {
        if($_GET["user_id"] and !$_GET["group_id"]){
            $fillUsers_qry = "select users_dt.user_id, accLogin from users_dt where user_id='".$_GET["user_id"]."'";
        }elseif ($_GET["group_id"] and !$_GET["user_id"]){
            $fillUsers_qry = "select users_dt.user_id, accLogin, ".$this->tableName.".group_id from users_dt ".
                "left join ".$this->tableName." on ".$this->tableName.".user_id = users_dt.user_id ".
                " and ".$this->tableName.".group_id = '".$_GET["group_id"]."' ".
                "where group_id is null ".
                "order by accLogin";
        }elseif ($_GET["group_id"] and $_GET["user_id"]){
            $fillUsers_qry = "select users_dt.user_id, accLogin from users_dt where users_dt.user_id='".$_GET["user_id"]."'";
        }
        elseif (!$_GET["group_id"] and !$_GET["user_id"]){
            $fillUsers_qry = "select users_dt.user_id, accLogin from users_dt";
        }

        $findUsers_res = $this->query($fillUsers_qry);
        $fillUsers_id = null;
        if($findUsers_res->rowCount()){
            while ($findUsers_row = $findUsers_res->fetch(PDO::FETCH_ASSOC)){
                $fillUsers_id[$findUsers_row["user_id"]] = $findUsers_row["accLogin"];
            }
        }else{
            $fillUsers_id[""] = "";
        }
        return $fillUsers_id;
    }

    function fillGroups_name()
    {
        if($_GET["group_id"] and !$_GET["user_id"]){
            $fillGroups_qry = "select usersGroups_dt.group_id, usersGroups_dt.groupAlias_".$_SESSION["lang"]." as groupAlias from usersGroups_dt where group_id='".$_GET["group_id"]."'";
        }elseif ($_GET["user_id"] and !$_GET["group_id"]) {

            $fillGroups_qry = "select usersGroups_dt.group_id, usersGroups_dt.groupAlias_".$_SESSION["lang"]." as groupAlias, ".$this->tableName.".user_id from usersGroups_dt ".
                "left join ".$this->tableName." on ".$this->tableName.".group_id = usersGroups_dt.group_id ".
                " and ".$this->tableName.".user_id = '".$_GET["user_id"]."' ".
                "where user_id is null ".
                "order by usersGroups_dt.groupAlias_".$_SESSION["lang"];
        }elseif($_GET["group_id"] and $_GET["user_id"]){

            $fillGroups_qry = "select usersGroups_dt.group_id, usersGroups_dt.groupAlias_".$_SESSION["lang"]." as groupAlias from usersGroups_dt where group_id='".$_GET["group_id"]."'";

        }elseif(!$_GET["group_id"] and !$_GET["user_id"]){
            $fillGroups_qry = "select usersGroups_dt.group_id, usersGroups_dt.groupAlias_".$_SESSION["lang"]." as groupAlias from usersGroups_dt";
        }


        $fillGroups_res = $this->query($fillGroups_qry);
        $fillGroups_name = null;
        if($fillGroups_res->rowCount()){
            while ($fillGroups_row = $fillGroups_res->fetch(PDO::FETCH_ASSOC)){
                $fillGroups_name[$fillGroups_row["group_id"]] = $fillGroups_row["groupAlias"];
            }
        }else{
            $fillGroups_name[""] = "";
        }

        return $fillGroups_name;
    }

    function fillViewRule($type_of_rule = null)
    {

        if($type_of_rule == "read"){
            return array(
                ""=>"",
                "any" => $this->lang_map["rules"]["any"][$_SESSION["lang"]],
                "own" => $this->lang_map["rules"]["own"][$_SESSION["lang"]],
            );
        }elseif ($type_of_rule == "create"){
            return array(
                ""=>"",
                "enable" => $this->lang_map["rules"]["enable"][$_SESSION["lang"]],
                "disable" => $this->lang_map["rules"]["disable"][$_SESSION["lang"]],
            );
        }elseif ($type_of_rule == "edit"){
            return array(
                ""=>"",
                "any" => $this->lang_map["rules"]["any"][$_SESSION["lang"]],
                "own" => $this->lang_map["rules"]["own"][$_SESSION["lang"]],
                "forbidden" => $this->lang_map["rules"]["forbidden"][$_SESSION["lang"]],
            );
        }elseif ($type_of_rule == "delete"){
            return array(
                ""=>"",
                "any" => $this->lang_map["rules"]["any"][$_SESSION["lang"]],
                "own" => $this->lang_map["rules"]["own"][$_SESSION["lang"]],
                "forbidden" => $this->lang_map["rules"]["forbidden"][$_SESSION["lang"]],
            );
        }
    }
}