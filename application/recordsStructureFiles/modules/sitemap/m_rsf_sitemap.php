<?php
class m_rsf_sitemap extends recordStructureFields
{
    function __construct()
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
                "curVal" => $_SESSION[JS_SAIK]["site_user"]["user_id"],
            ),

            "createdLogin" => array(
                "format" => "varchar",
                "use_table_name" => "udtcreated",
                "curVal" => $_SESSION[JS_SAIK]["site_user"]["accLogin"],
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
                "filling" => array(),
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
                "filling" => array(),
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
                "filling" => array(),
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
}
