<?php
class recordntflistModel extends ModuleRecordsModel
{
    public $tableName = "ntfList_dt";
    public $modelAliases = array(
        "en" => "Notification list",
        "rus" => "Список уведомлений",
    );


    function getRecordStructure()
    {
        $this->record = array(
            "ntf_id" => array(
                "format" => "varchar",
                "indexes" => true,
            ),
            "template_id" => array(
                "format" => "varchar",
            ),
            "subscriber_type" => array(
                "format" => "varchar",
            ),
            "type_id" => array(
                "format" => "varchar",
            ),
            "add_date" => array(
                "format" => "datetime",
                "curVal" => date("Y-m-d H:i:s"),
            ),
            "template_params" => array(
                "format" => "varchar",
            ),
            "send_params" => array(
                "format" => "varchar",
            ),
            "send_date" => array(
                "format" => "datetime",
            ),
            "created_by" => array(
                "format" => "varchar",
                "curVal" => $_SESSION["site_user"]["user_id"],
            ),
            "createdLogin" => array(
                "format" => "varchar",
                "use_table_name" => "udtcreated",
                "curVal" => $_SESSION["site_user"]["accAlias"],
            ),
            "tName" => array(
                "format" => "varchar",
                "use_table_name" => "ntfTemplates_dt",
            ),
            "uName" => array(
                "format" => "varchar",
                "use_table_name" => "unionId",
            ),
            "send_res" => array(
                "format" => "tinyint",
            ),
            "send_log" => array(
                "format" => "varchar",
            ),
        );

        $this->listFields = array(
            "btnDetail" => array(
                "replaces" => array("ntf_id"),
                "format" => "link",
                "url" => "ntf_id=ntf_id",
            ),
            "btnEdit" => array(
                "replaces" => array("ntf_id"),
                "format" => "link",
                "url" => "ntf_id=ntf_id",
            ),
            "btnDelete" => array(
                "replaces" => array("ntf_id"),
                "format" => "link",
                "url" => "ntf_id=ntf_id",
            ),
            "ntf_id" => array(
                "format" => "hidden",
            ),
            "template_id" => array(
                "format" => "hidden",
                "fieldAliases" => array(
                    "en" => "template",
                    "rus" => "Шаблон"
                ),
            ),
            "tName" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "template",
                    "rus" => "Шаблон"
                ),
            ),
            "subscriber_type" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "ntf type",
                    "rus" => "Тип увед."
                ),
            ),
            "type_id" => array(
                "format" => "hidden",
            ),
            "uName" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "Subscriber",
                    "rus" => "Подписчик",
                ),
            ),
            "add_date" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "created dt",
                    "rus" => "Дт. созд.",
                ),
            ),
            "template_params" => array(
                "format" => "hidden",
            ),
            "send_params" => array(
                "format" => "hidden",
            ),
            "send_date" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "send dt",
                    "rus" => "Дт. отпр.",
                ),
            ),
            "createdLogin" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "Owner",
                    "rus" => "Владелец",
                ),
            ),
            "send_res" => array(
                "format" => "tinyint",
                "fieldAliases" => array(
                    "en" => "result",
                    "rus" => "рез.",
                ),
            ),
            "send_log" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "log",
                    "rus" => "лог",
                ),
            ),
        );

        $this->searchFields = array(
            "add_date" => array(
                "sort" => 1,
                "search" => 1,
                "format" => "hidden",
                "fieldAliases" => array(
                    "en" => "created dt",
                    "rus" => "Дт. созд.",
                ),
            ),
            "ntf_id" => array(
                "format" => "varchar",
            ),
            "template_id" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "template",
                    "rus" => "Шаблон"
                ),
            ),
            "tName" => array(
                "format" => "varchar",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "template",
                    "rus" => "Шаблон"
                ),
                "use_table_name" => "ntfTemplates_dt",
            ),
            "subscriber_type" => array(
                "format" => "varchar",
            ),
            "type_id" => array(
                "format" => "varchar",
            ),

            "template_params" => array(
                "format" => "varchar",
            ),
            "send_params" => array(
                "format" => "varchar",
            ),
            "send_date" => array(
                "format" => "hidden",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "send date",
                    "rus" => "Отправлено"
                ),
            ),
            "created_by" => array(
                "format" => "varchar",
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
                "use_field_name" => "accAlias",
            ),
            "send_res" => array(
                "format" => "tinyint",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "result",
                    "rus" => "рез.",
                ),
            ),
            "send_log" => array(
                "format" => "varchar",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "log",
                    "rus" => "лог",
                ),
            ),
        );

        $this->editFields = array(
            "ntf_id" => array(
                "format" => "hidden",
            ),
            "template_id" => array(
                "format" => "select",
                "fieldAliases" => array(
                    "en" => "template",
                    "rus" => "Шаблон"
                ),
                "filling" => $this->fillTemplateId(),
            ),
            "subscriber_type" => array(
                "format" => "select",
                "fieldAliases" => array(
                    "en" => "type",
                    "rus" => "Тип"
                ),
                "filling" => array("" => "", "user" => "user", "group"=>"group"),
            ),
            "type_id" => array(
                "format" => "find-select",
                "fieldAliases" => array(
                    "en" => "subscriber",
                    "rus" => "подписчик"
                ),
                "fillName" => "uName",
            ),
            "add_date" => array(
                "format" => "varchar",
                "readonly" => true,
                "fieldAliases" => array(
                    "en" => "add date",
                    "rus" => "Создано"
                ),
            ),
            "template_params" => array(
                "format" => "text",
                "fieldAliases" => array(
                    "en" => "tpl params",
                    "rus" => "В шаблон"
                ),
            ),
            "send_params" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "send params",
                    "rus" => "Отправка"
                ),
            ),
            "send_date" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "send date",
                    "rus" => "Отправлено"
                ),
            ),
            "created_by" => array(
                "format" => "hidden",
                "readonly" => true,
                "fieldAliases" => array(
                    "en" => "Created by",
                    "rus" => "Создал(а)",
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
            "send_res" => array(
                "format" => "tinyint",
                "fieldAliases" => array(
                    "en" => "result",
                    "rus" => "рез.",
                ),
            ),
            "send_log" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "log",
                    "rus" => "лог",
                ),
            ),
        );

        $this->viewFields = array(
            "ntf_id" => array(
                "format" => "hidden",
                "readonly" => 1,
            ),
            "template_id" => array(
                "format" => "select",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "template",
                    "rus" => "Шаблон"
                ),
                "filling" => $this->fillTemplateId(),
            ),
            "subscriber_type" => array(
                "format" => "select",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "type",
                    "rus" => "Тип"
                ),
                "filling" => array("" => "", "user" => "user", "group"=>"group"),
            ),
            "type_id" => array(
                "format" => "find-select",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "subscriber",
                    "rus" => "подписчик"
                ),
                "fillName" => "uName",
            ),
            "add_date" => array(
                "format" => "varchar",
                "readonly" => true,
                "fieldAliases" => array(
                    "en" => "add date",
                    "rus" => "Создано"
                ),
            ),
            "template_params" => array(
                "format" => "text",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "tpl params",
                    "rus" => "В шаблон"
                ),
            ),
            "send_params" => array(
                "format" => "varchar",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "send params",
                    "rus" => "Отправка"
                ),
            ),
            "send_date" => array(
                "format" => "varchar",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "send date",
                    "rus" => "Отправлено"
                ),
            ),
            "created_by" => array(
                "format" => "hidden",
                "readonly" => true,
                "fieldAliases" => array(
                    "en" => "Created by",
                    "rus" => "Создал(а)",
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
            "send_res" => array(
                "format" => "tinyint",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "result",
                    "rus" => "рез.",
                ),
            ),
            "send_log" => array(
                "format" => "varchar",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "log",
                    "rus" => "лог",
                ),
            ),
        );


    }

    function fillTemplateId()
    {
        $fill_qry = "select template_id, tName from ntfTemplates_dt order by tName";
        $fill_res = $this->query($fill_qry);
        $fill_return = array("" => "",);
        if($fill_res->rowCount()){
            while($fill_row = $fill_res->fetch(PDO::FETCH_ASSOC)){
                $fill_return[$fill_row["template_id"]] = $fill_row["tName"];
            }
        }
        return $fill_return;
    }

    function countRecords($where = null)
    {
        $countList_qry = "select count(".
            $this->tableName.".ntf_id) as cnt ".
            "from ".$this->tableName." ".
            "left join users_dt udtcreated on ".$this->tableName.".created_by = udtcreated.user_id ".
            "left join ntfTemplates_dt on ntfTemplates_dt.template_id = ".$this->tableName.".template_id ";
        return $this->query($countList_qry." ".$where)->fetch(PDO::FETCH_ASSOC)["cnt"];
    }

    function copyCustomFields()
    {
        $findUType_qry = "(select user_id as utype_id, accAlias as uName from users_dt where user_id = '".$this->record["type_id"]["curVal"]."') union ".
            "(select group_id as utype_id, groupAlias_en as uName from usersGroups_dt where group_id = '".$this->record["type_id"]["curVal"]."')";

        $findUType_res = $this->query($findUType_qry);
        if($findUType_res->rowCount() == 1){
            $this->record["uName"]["curVal"] = $findUType_res->fetch(self::FETCH_ASSOC)["uName"];
        }else{
            $this->record["uName"]["curVal"] = "";
        }

        $findUCreated_qry = "select user_id, accAlias from users_dt where user_id = '".$this->record["created_by"]["curVal"]."'";
        $findUCreated_res = $this->query($findUCreated_qry);
        if($findUCreated_res->rowCount() == 1){
            $this->record["createdLogin"]["curVal"] = $findUCreated_res->fetch(self::FETCH_ASSOC)["accAlias"];
        }else{
            $this->record["createdLogin"]["curVal"] = "";
        }
        return true;
    }

    public function listRecords($where = null, $order = null, $limit = null)
    {
        $findList_qry = "select ".
            $this->tableName.".ntf_id, ".
            $this->tableName.".template_id, ".
            $this->tableName.".subscriber_type, ".
            $this->tableName.".type_id, ".
            $this->tableName.".add_date, ".
            $this->tableName.".template_params, ".
            $this->tableName.".send_params, ".
            $this->tableName.".send_date, ".
            $this->tableName.".created_by, ".
            $this->tableName.".send_res, ".
            $this->tableName.".send_log, ".
            "udtcreated.accAlias as createdLogin, ".
            "ntfTemplates_dt.tName, ".
            "unionId.uName as uName ".
            "from ".$this->tableName." ".
            "left join ((select user_id as utype_id, accAlias as uName from users_dt) union (select group_id as utype_id, groupAlias_en as uName from usersGroups_dt) ) unionId ".
            "on ".$this->tableName.".type_id = unionId.utype_id ".


            "left join users_dt udtcreated on ".$this->tableName.".created_by = udtcreated.user_id ".
            "left join ntfTemplates_dt on ntfTemplates_dt.template_id = ".$this->tableName.".template_id ".
            $where.$order.$limit;

        return $this->query($findList_qry);
    }


}