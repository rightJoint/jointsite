<?php
class userNotificationsRead extends ModuleRecordsModel
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
            "put_date" => array(
                "format" => "datetime",
            ),
            "send_flag" => array(
                "format" => "tinyint",
            ),
            "del_flag" => array(
                "format" => "tinyint",
            ),
            "tHeader_en" => array(
                "format" => "varchar",
                "use_table_name" => "ntfTemplates_dt",
            ),
            "tHeader" => array(
                "format" => "varchar",
                "use_table_name" => 1,
            ),
            "tBody" => array(
                "format" => "text",
                "use_table_name" => 1,
            )
        );

        $this->listFields = array(
            "btnDetail" => array(
                "replaces" => array("ntf_id", "user_id"),
                "format" => "link",
                "url" => "ntf_id=ntf_id",
            ),
            "btnDelete" => array(
                "replaces" => array("ntf_id", "user_id"),
                "format" => "link",
                "url" => "ntf_id=ntf_id",
            ),
            "ntf_id" => array(
                "format" => "hidden",
            ),
            "user_id" => array(
                "format" => "hidden",
            ),
            "tHeader_en" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "Subject",
                    "rus" => "Тема"
                ),
            ),
            "subscriber_type" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "SubsrType",
                    "rus" => "ТипПодписч."
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
                "format" => "datetime",
                "fieldAliases" => array(
                    "en" => "added",
                    "rus" => "Добавлено."
                ),
            ),
            "send_flag" => array(
                "format" => "tinyint",
                "fieldAliases" => array(
                    "en" => "is send",
                    "rus" => "Отправка"
                ),
            ),
        );

        $this->searchFields = array(
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
                "format" => "datetime",
                "fieldAliases" => array(
                    "en" => "added",
                    "rus" => "Добавлено."
                ),
                "sort" => 1,
                "search" => 1,
            ),
            "send_flag" => array(
                "format" => "tinyint",
                "fieldAliases" => array(
                    "en" => "is send",
                    "rus" => "Отправка"
                ),
                "sort" => 1,
                "search" => 1,
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

        $this->editFields = array(
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
            "put_date" => array(
                "format" => "datetime",
            ),
            "send_flag" => array(
                "format" => "tinyint",
            ),
            "del_flag" => array(
                "format" => "tinyint",
            ),
            "tHeader_en" => array(
                "format" => "varchar",
                "use_table_name" => "ntfTemplates_dt",
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

    function filterWhere($method = "POST")
    {

        $sup_cond = parent::filterWhere($method); // TODO: Change the autogenerated stub

        $add_user_where = "ntfRead_dt.user_id='".$_SESSION["site_user"]["user_id"]."' and del_flag is not true";

        if($sup_cond["where"]){
            $sup_cond["where"] .= " and ".$add_user_where;
        }else{
            $sup_cond["where"] = "where ".$add_user_where;
        }

        return $sup_cond;
    }

    function checkAccessModel()
    {
        $this->access_rules = array(
            "read_rule" => 7,
            "create_rule" => 0,
            "edit_rule" => 0,
            "delete_rule" => 7,
        );
        return true;
    }

    function countRecords($where = null)
    {
        $countList_qry = "select count(".
            $this->tableName.".ntf_id) as cnt ".
            "from ".$this->tableName." ".
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
            "ntfList_dt.subscriber_type, ".
            "ntfTemplates_dt.tHeader_en ".
            "from ".$this->tableName." ".
            "inner join ntfList_dt on ntfList_dt.ntf_id = ".$this->tableName.".ntf_id ".
            "inner join ntfTemplates_dt on ntfTemplates_dt.template_id = ntfList_dt.template_id ".
            $where.$order.$limit;

        return $this->fetchToArray($findList_qry);
    }
}