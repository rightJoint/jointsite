<?php
class rsf_notifications_users extends recordStructureFields
{
    function __construct()
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
}