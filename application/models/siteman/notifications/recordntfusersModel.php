<?php
class recordntfusersModel extends ModuleRecordsModel
{
    public $tableName = "ntfRead_dt";
    public $modelAliases = array(
        "en" => "Users notifications",
        "rus" => "Уведомления пользователей",
    );

    function getRecordStructure()
    {
        $this->record = array(
            "ntf_id" => array(
                "format" => "varchar",
                "indexes" => true,
            ),
            "user_id" => array(
                "format" => "varchar",
                "indexes" => true,
            ),
            "read_date" => array(
                "format" => "datetime",
            ),
            "accAlias" => array(
                "format" => "varchar",
                "use_table_name" => "users_dt",
            ),
            "subscriber_type" => array(
                "format" => "varchar",
                "use_table_name" => "ntfList_dt",
            ),
            "tName" => array(
                "format" => "varchar",
                "use_table_name" => "ntfTemplates_dt",
            ),
            "tHeader_en" => array(
                "format" => "varchar",
                "use_table_name" => "ntfTemplates_dt",
            ),
            "put_date" => array(
                "format" => "datetime",
            ),
            "send_flag" => array(
                "format" => "tinyint",
            ),
            "del_flag" => array(
                "format" => "tinyint",
            ),
            "tHeader" => array(
                "use_table_name" => 1,
                "format" => "varchar",
            ),
            "tBody" => array(
                "use_table_name" => 1,
                "format" => "varchar",
            ),
        );

        $this->listFields = array(
            "btnDetail" => array(
                "replaces" => array("ntf_id", "user_id"),
                "format" => "link",
                "url" => "ntf_id=ntf_id&user_id=user_id",
            ),
            "btnEdit" => array(
                "replaces" => array("ntf_id", "user_id"),
                "format" => "link",
                "url" => "ntf_id=ntf_id&user_id=user_id",
            ),
            "btnDelete" => array(
                "replaces" => array("ntf_id", "user_id"),
                "format" => "link",
                "url" => "ntf_id=ntf_id&user_id=user_id",
            ),
            "ntf_id" => array(
                "format" => "hidden",
            ),
            "user_id" => array(
                "format" => "hidden",
            ),
            "accAlias" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "accAlias",
                    "rus" => "Псевдоним"
                ),
            ),
            "subscriber_type" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "SubsrType",
                    "rus" => "ТипПодписч."
                ),
            ),
            "tName" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "Template",
                    "rus" => "Шаблон"
                ),
            ),
            "tHeader_en" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "Subject",
                    "rus" => "Тема"
                ),
            ),
            "put_date" => array(
                "format" => "datetime",
                "fieldAliases" => array(
                    "en" => "add date",
                    "rus" => "Дт. доб."
                ),
            ),
            "send_flag" => array(
                "format" => "tinyint",
                "fieldAliases" => array(
                    "en" => "Mailed",
                    "rus" => "Отослано"
                ),
            ),
            "read_date" => array(
                "format" => "datetime",
                "fieldAliases" => array(
                    "en" => "read date",
                    "rus" => "Дт. прочит."
                ),
            ),
            "del_flag" => array(
                "format" => "tinyint",
                "fieldAliases" => array(
                    "en" => "Deleted",
                    "rus" => "Удалено"
                ),
            ),
        );

        $this->searchFields = array(
            "accAlias" => array(
                "format" => "varchar",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "accAlias",
                    "rus" => "Псевдоним"
                ),
                "use_table_name" => "users_dt",
            ),
            "subscriber_type" => array(
                "format" => "varchar",
                "sort" => 1,
                "search" => 1,
                "use_table_name" => "ntfList_dt",
                "fieldAliases" => array(
                    "en" => "SubsrType",
                    "rus" => "ТипПодписч."
                ),
            ),
            "tName" => array(
                "format" => "varchar",
                "use_table_name" => "ntfTemplates_dt",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "Template",
                    "rus" => "Шаблон"
                ),
            ),
            "tHeader_en" => array(
                "format" => "varchar",
                "use_table_name" => "ntfTemplates_dt",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "Subject",
                    "rus" => "Тема"
                ),
            ),
            "read_date" => array(
                "format" => "datetime",
                "fieldAliases" => array(
                    "en" => "read date",
                    "rus" => "Дт. прочит."
                ),
            ),
            "put_date" => array(
                "sort" => 1,
                "search" => 1,
                "format" => "datetime",
                "fieldAliases" => array(
                    "en" => "add date",
                    "rus" => "Дт. доб."
                ),
            ),
        );

        $this->editFields = array(
            "ntf_id" => array(
                "format" => "varchar",
            ),
            "user_id" => array(
                "format" => "varchar",
            ),
            "read_date" => array(
                "format" => "datetime",
                "fieldAliases" => array(
                    "en" => "read date",
                    "rus" => "Дт. прочит."
                ),
            ),
            "put_date" => array(
                "format" => "datetime",
                "fieldAliases" => array(
                    "en" => "add date",
                    "rus" => "Дт. доб."
                ),
            ),
            "send_flag" => array(
                "format" => "tinyint",
                "fieldAliases" => array(
                    "en" => "Mailed",
                    "rus" => "Отослано"
                ),
            ),
            "del_flag" => array(
                "format" => "tinyint",
                "fieldAliases" => array(
                    "en" => "Deleted",
                    "rus" => "Удалено"
                ),
            ),

        );

        $this->viewFields = array(
            "ntf_id" => array(
                "format" => "hidden",
                "readonly" => 1,
            ),
            "user_id" => array(
                "format" => "hidden",
                "readonly" => 1,
            ),
            "tHeader" => array(
                "readonly" => 1,
                "format" => "varchar",
                "style" => array(
                    "class" => "wd100",
                ),
            ),
            "tBody" => array(
                "readonly" => 1,
                "format" => "text-block",
                "style" => array(
                    "class" => "wd100",
                ),
            ),
            "send_flag" => array(
                "readonly" => 1,
                "format" => "tinyint",
            ),
            "put_date" => array(
                "readonly" => 1,
                "format" => "datetime",
            ),
            "read_date" => array(
                "format" => "datetime",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "read date",
                    "rus" => "Дт. прочит."
                ),
            ),

        );


    }

    function copyCustomFields()
    {
        $ntfList_qry = "select * from ntfList_dt where ntf_id='".$this->record["ntf_id"]["curVal"]."'";
        $ntfList_res = $this->query($ntfList_qry);
        if($ntfList_res->rowCount() === 1){
            $ntfList_row = $ntfList_res->fetch(PDO::FETCH_ASSOC);
            $template_qry = "select * from ntfTemplates_dt where template_id = '".$ntfList_row["template_id"]."'";
            $template_res = $this->query($template_qry);

            if($template_res->rowCount() == 1){
                $template_row = $template_res->fetch(PDO::FETCH_ASSOC);
                $this->record["tHeader"]["curVal"] = $template_row["tHeader_".$_SESSION["lang"]];
                $template_params = json_decode($ntfList_row["template_params"], true);
                $replaced_text = $template_row["tBody_".$_SESSION["lang"]];

                if($template_params){
                    foreach ($template_params as $tp_key => $tp_val){
                        $replaced_text = str_replace("$".$tp_key, $tp_val, $replaced_text);
                    }
                }

                $this->record["tBody"]["curVal"] = $replaced_text;
            }else{

            }
        }
    }


    function countRecords($where = null)
    {
        $countList_qry = "select count(".
            $this->tableName.".ntf_id) as cnt ".
            "from ".$this->tableName." ".
            "inner join users_dt on ".$this->tableName.".user_id = users_dt.user_id ".
            "inner join ntfList_dt on ntfList_dt.ntf_id = ".$this->tableName.".ntf_id ".
            "inner join ntfTemplates_dt on ntfTemplates_dt.template_id = ntfList_dt.template_id ";
        return $this->query($countList_qry." ".$where)->fetch(PDO::FETCH_ASSOC)["cnt"];
    }

    public function listRecords($where = null, $order = null, $limit = null)
    {
        $findList_qry = "select ".
            $this->tableName.".ntf_id, ".
            $this->tableName.".user_id, ".
            $this->tableName.".read_date, ".
            $this->tableName.".put_date, ".
            $this->tableName.".send_flag, ".
            $this->tableName.".del_flag, ".
            "users_dt.accAlias as accAlias, ".
            "ntfList_dt.subscriber_type, ".
            "ntfTemplates_dt.tName, ".
            "ntfTemplates_dt.tHeader_en ".
            "from ".$this->tableName." ".
            "inner join users_dt on ".$this->tableName.".user_id = users_dt.user_id ".
            "inner join ntfList_dt on ntfList_dt.ntf_id = ".$this->tableName.".ntf_id ".
            "inner join ntfTemplates_dt on ntfTemplates_dt.template_id = ntfList_dt.template_id ".
            $where.$order.$limit;

        return $this->fetchToArray($findList_qry);
    }
}