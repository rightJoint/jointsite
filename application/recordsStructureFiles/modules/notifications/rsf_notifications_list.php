<?php
class rsf_notifications_list extends recordStructureFields
{
    function __construct()
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
                "filling" => array(),
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
                "filling" => array(),
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
}
