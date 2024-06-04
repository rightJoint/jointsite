<?php
class rsf_user_notificarionsRead extends recordStructureFields
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
                //"indexes" => true,
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
}