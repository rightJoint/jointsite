<?php
class recordgroupsModel extends ModuleRecordsModel
{

    public $tableName = "usersGroups_dt";
    public $modelAliases = array(
        "en" => "Access groups",
        "rus" => "Группы доступа",
    );

    public $allow_edit_indexes = false;

    function getRecordStructure()
    {
        $this->record = array(
            "group_id" => array(
                "indexes" => 1,
                "format" => "varchar",
            ),
            "groupAlias_en" => array(
                "format" => "varchar",
            ),
            "groupAlias_rus" => array(
                "format" => "varchar",
            ),
            "activeFlag" => array(
                "format" => "tinyint",
            ),
            "created_by" => array(
                "format" => "varchar",
                "curVal" => $_SESSION["site_user"]["user_id"],
            ),
            "accAlias" => array(
                "format" => "varchar",
                "use_table_name" => "users_dt",
                "curVal" => $_SESSION["site_user"]["accAlias"],
            ),
        );

        $this->editFields = array(
            "group_id" => array(
                "indexes" => 1,
                "format" => "hidden",
                "fieldAliases" => array(
                    "en" => "group id",
                    "rus" => "id группы",
                ),
            ),
            "groupAlias_en" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "Name_en",
                    "rus" => "Назв_en",
                ),
            ),
            "groupAlias_rus" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "Name_rus",
                    "rus" => "Назв_rus",
                ),
            ),
            "activeFlag" => array(
                "format" => "tinyint",
                "fieldAliases" => array(
                    "en" => "Use it",
                    "rus" => "Использовать",
                ),
            ),
            "accAlias" => array(
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
                "replaces" => array("group_id"),
                "format" => "link",
                "url" => "group_id=group_id",
            ),
            "btnEdit" => array(
                "replaces" => array("group_id"),
                "format" => "link",
                "url" => "group_id=group_id",
            ),
            "btnDelete" => array(
                "replaces" => array("group_id"),
                "format" => "link",
                "url" => "group_id=group_id",
            ),
            "group_id" => array(
                "format" => "hidden",
                "maxLength" => 20,
                "fieldAliases" => array(
                    "en" => "Access group",
                    "rus" => "Группа доступа",
                ),
            ),
            "groupAlias_en" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "Name_en",
                    "rus" => "Назв_en",
                ),
            ),
            "groupAlias_rus" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "Name_rus",
                    "rus" => "Назв_rus",
                ),
            ),
            "activeFlag" => array(
                "format" => "tinyint",
                "fieldAliases" => array(
                    "en" => "Use it",
                    "rus" => "Использовать",
                ),
            ),
            "accAlias" => array(
                "format" => "varchar",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "Owner",
                    "rus" => "Владелец",
                ),
            ),
        );

        $this->searchFields = array(
            "groupAlias_en" => array(
                "format" => "varchar",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "Name_en",
                    "rus" => "Назв_en",
                ),
            ),
            "groupAlias_rus" => array(
                "format" => "varchar",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "Name_rus",
                    "rus" => "Назв_rus",
                ),
            ),
            "activeFlag" => array(
                "format" => "tinyint",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "Use it",
                    "rus" => "Использовать",
                ),
            ),
            "accAlias" => array(
                "format" => "varchar",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "Owner",
                    "rus" => "Владелец",
                ),
                "use_table_name" => "users_dt"
            ),
        );

        $this->viewFields = array(
            "group_id" => array(
                "indexes" => 1,
                "format" => "varchar",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "Access group",
                    "rus" => "Группа доступа",
                ),
            ),
            "groupAlias_en" => array(
                "readonly" => 1,
                "format" => "varchar",
            ),
            "groupAlias_rus" => array(
                "readonly" => 1,
                "format" => "varchar",
            ),
            "activeFlag" => array(
                "format" => "tinyint",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "Use it",
                    "rus" => "Использовать",
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

    public function listRecords($where = null, $order = null, $limit = null)
    {

        $findList_qry = "select ".
            "group_id, ".
            "groupAlias_en, ".
            "groupAlias_rus, ".
            "activeFlag, ".
            "usersGroups_dt.created_by, ".
            "users_dt.accAlias ".
            "from ".$this->tableName." ".
            "left join users_dt on usersGroups_dt.created_by = users_dt.user_id ".
            $where.$order.$limit;

        return $this->fetchToArray($findList_qry);
    }

    public function countRecords($where = null)
    {
        return $this->query("select count(*) as cnt from ".$this->tableName." ".
            "left join users_dt on usersGroups_dt.created_by = users_dt.user_id ".
            $where)->fetch(PDO::FETCH_ASSOC)["cnt"];
    }

    public function copyRecord(){
        $query_text="select ".$this->tableName.".*, users_dt.accAlias from ".$this->tableName.
            " left join users_dt on usersGroups_dt.created_by = users_dt.user_id ".
            " where ";
        foreach ($this->record as $fieldName=>$fieldInfo) {
            if ($fieldInfo["indexes"]) {
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
}