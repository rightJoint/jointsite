<?php
class recordsitemapModel extends ModuleRecordsModel
{
    public $tableName = "siteMap_dt";
    public $modelAliases = array(
        "en" => "Site map",
        "rus" => "Карта сайта",
    );

    public function listRecords($where = null, $order = null, $limit = null)
    {
        $findList_qry = "select ".
            $this->tableName.".maploc, ".
            $this->tableName.".lastmod, ".
            $this->tableName.".changefreq, ".
            $this->tableName.".priority, ".
            $this->tableName.".comment, ".
            $this->tableName.".use_flag, ".
            $this->tableName.".date_created, ".
            $this->tableName.".created_by, ".
            "udtcreated.accLogin as createdLogin ".
            "from ".$this->tableName." ".
            "left join users_dt udtcreated on ".$this->tableName.".created_by = udtcreated.user_id ".
            $where.$order.$limit;

        return $this->query($findList_qry);
    }

    function countRecords($where = null)
    {
        $countList_qry = "select count(".
            $this->tableName.".maploc) as cnt ".
            "from ".$this->tableName." ".
            "left join users_dt udtcreated on ".$this->tableName.".created_by = udtcreated.user_id ";

        if($where){
            $where=" where ".$where;
        }

        return $this->query($countList_qry." ".$where)->fetch(PDO::FETCH_ASSOC)["cnt"];
    }

    function copyCustomFields()
    {
        $findUType_qry = "select accLogin as createdLogin from users_dt where user_id = '".$this->record["created_by"]["curVal"]."'";
        $findUType_res = $this->query($findUType_qry);
        if($findUType_res->rowCount() == 1){
            $this->record["createdLogin"]["curVal"] = $findUType_res->fetch(self::FETCH_ASSOC)["createdLogin"];
        }else{
            $this->record["createdLogin"]["curVal"] = "";
        }
        return true;
    }

    function getRecordStructure()
    {
        $this->record = array(
            "maploc" => array(
                "format" => "varchar",
                "indexes" => true,
            ),
            "lastmod" => array(
                "format" => "date",
            ),
            "changefreq" => array(
                "format" => "varchar",
            ),
            "priority" => array(
                "format" => "varchar",
            ),
            "comment" => array(
                "format" => "varchar",
            ),
            "date_created" => array(
                "format" => "datetime",
                "curVal" => date("Y-m-d H:i:s"),
            ),
            "use_flag" => array(
                "format" => "tinyint",
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
        );

        $this->listFields = array(
            "btnDetail" => array(
                "replaces" => array("maploc"),
                "format" => "link",
                "url" => "maploc=maploc",
            ),
            "btnEdit" => array(
                "replaces" => array("maploc"),
                "format" => "link",
                "url" => "maploc=maploc",
            ),
            "btnDelete" => array(
                "replaces" => array("maploc"),
                "format" => "link",
                "url" => "maploc=maploc",
            ),
            "maploc" => array(
                "format" => "varchar",
                "indexes" => true,
                "fieldAliases" => array(
                    "en" => "maploc",
                    "rus" => "Адрес"
                ),
            ),
            "lastmod" => array(
                "format" => "date",
                "fieldAliases" => array(
                    "en" => "lastmod",
                    "rus" => "Обновлено"
                ),
            ),
            "changefreq" => array(
                "format" => "select",
                "fieldAliases" => array(
                    "en" => "changefreq",
                    "rus" => "Частота"
                ),
                "filling" => $this->fillChangefreq("y"),
            ),
            "priority" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "priority",
                    "rus" => "Важность"
                ),
            ),
            "comment" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "comment",
                    "rus" => "Комент"
                ),
            ),
            "date_created" => array(
                "format" => "datetime",
                "fieldAliases" => array(
                    "en" => "dt created",
                    "rus" => "Дт.созд."
                ),
            ),
            "use_flag" => array(
                "format" => "tinyint",
                "fieldAliases" => array(
                    "en" => "put on map",
                    "rus" => "Положить"
                ),
            ),
            "createdLogin" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "Owner",
                    "rus" => "Владелец"
                ),
            ),
        );

        $this->searchFields = array(
            "maploc" => array(
                "format" => "varchar",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "maploc",
                    "rus" => "Адрес"
                ),
            ),
            "lastmod" => array(
                "format" => "date",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "lastmod",
                    "rus" => "Обновлено"
                ),
            ),
            "changefreq" => array(
                "format" => "select",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "changefreq",
                    "rus" => "Частота"
                ),
                "filling" => $this->fillChangefreq("y"),
            ),
            "priority" => array(
                "format" => "varchar",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "priority",
                    "rus" => "Важность"
                ),
            ),
            "comment" => array(
                "format" => "varchar",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "comment",
                    "rus" => "Комент"
                ),
            ),
            "date_created" => array(
                "format" => "varchar",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "dt created",
                    "rus" => "Дт.созд."
                ),
            ),
            "use_flag" => array(
                "format" => "tinyint",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "put on map",
                    "rus" => "Положить"
                ),
            ),
            "createdLogin" => array(
                "format" => "varchar",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "Owner",
                    "rus" => "Владелец"
                ),
                "use_table_name" => "udtcreated",
                "use_field_name" => "accLogin",
            ),
        );

        $this->editFields = array(
            "maploc" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "maploc",
                    "rus" => "Адрес"
                ),
            ),
            "lastmod" => array(
                "format" => "date",
                "fieldAliases" => array(
                    "en" => "lastmod",
                    "rus" => "Обновлено"
                ),
            ),
            "changefreq" => array(
                "format" => "select",
                "fieldAliases" => array(
                    "en" => "changefreq",
                    "rus" => "Частота"
                ),
                "filling" => $this->fillChangefreq(),
            ),
            "priority" => array(
                "format" => "number",
                "max" => 10,
                "min" => 1,
                "step" => 1,
                "fieldAliases" => array(
                    "en" => "priority",
                    "rus" => "Важность"
                ),
            ),
            "comment" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "comment",
                    "rus" => "Комент"
                ),
            ),
            "date_created" => array(
                "format" => "datetime",
                "fieldAliases" => array(
                    "en" => "dt created",
                    "rus" => "Дт.созд."
                ),
            ),
            "created_by" => array(
                "format" => "hidden",
                "fieldAliases" => array(
                    "en" => "Owner",
                    "rus" => "Владелец"
                ),
            ),
            "use_flag" => array(
                "format" => "tinyint",
                "fieldAliases" => array(
                    "en" => "put on map",
                    "rus" => "Положить"
                ),
            ),
            "createdLogin" => array(
                "format" => "varchar",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "Owner",
                    "rus" => "Владелец"
                ),
                //"use_table_name" => "udtcreated",
                //"use_field_name" => "accLogin",
            ),
        );

        $this->viewFields = array(
            "maploc" => array(
                "format" => "varchar",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "maploc",
                    "rus" => "Адрес"
                ),
            ),
            "lastmod" => array(
                "format" => "date",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "lastmod",
                    "rus" => "Обновлено"
                ),
            ),
            "changefreq" => array(
                "format" => "varchar",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "changefreq",
                    "rus" => "Частота"
                ),
            ),
            "priority" => array(
                "format" => "varchar",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "priority",
                    "rus" => "Важность"
                ),
            ),
            "comment" => array(
                "format" => "varchar",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "comment",
                    "rus" => "Комент"
                ),
            ),
            "date_created" => array(
                "format" => "datetime",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "dt created",
                    "rus" => "Дт.созд."
                ),
            ),
            "use_flag" => array(
                "format" => "tinyint",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "put on map",
                    "rus" => "Положить"
                ),
            ),
            "created_by" => array(
                "format" => "varchar",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "Owner",
                    "rus" => "Владелец"
                ),
            ),/*
            "createdLogin" => array(
                "format" => "varchar",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "Owner",
                    "rus" => "Владелец"
                ),
                "use_table_name" => "udtcreated",
                "use_field_name" => "accLogin",
            ),*/
        );
    }

    function fillChangefreq($nullVall = "n")
    {
        $return_arr = null;
        if($nullVall == "y"){
            $return_arr[""] = "";
        }

        $return_arr["monthly"] = "Ежемесячно";
        $return_arr["weekly"] = "Еженедельно";
        $return_arr["daily"] = "Ежедневно";
        $return_arr["always"] = "Всегда";
        $return_arr["hourly"] = "Ежечасно";
        $return_arr["yearly"] = "Ежегодно";
        $return_arr["never"] = "Никогда";
        return $return_arr;
    }

}