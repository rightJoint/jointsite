<?php
class rsf_notifications_templates extends recordStructureFields
{
    function __construct()
    {
        $this->record = array(
            "template_id" => array(
                "indexes" => 1,
                "format" => "varchar",
            ),
            "tName" => array(
                "format" => "varchar",
            ),
            "tHeader_en" => array(
                "format" => "varchar",
            ),
            "tHeader_rus" => array(
                "format" => "varchar",
            ),
            "tBody_en" => array(
                "format" => "text",
            ),
            "tBody_rus" => array(
                "format" => "text",
            ),
            "date_created" => array(
                "format" => "datetime",
                "curVal" => date("Y-m-d H:i:s"),
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
        $this->editFields = array(
            "template_id" => array(
                "indexes" => 1,
                "format" => "hidden",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "template id",
                    "rus" => "id шаблона",
                ),
            ),
            "tName" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "template name",
                    "rus" => "Назв. шаблона",
                ),
            ),
            "tHeader_en" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "subject-en",
                    "rus" => "Тема-en",
                ),
            ),
            "tHeader_rus" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "subject-rus",
                    "rus" => "Тема-rus",
                ),
            ),
            "tBody_en" => array(
                "format" => "tinymce",
                "fieldAliases" => array(
                    "en" => "body-en",
                    "rus" => "Тело-en",
                ),
                "id" => "tBody_en",
                "style" => array(
                    "class" => "wd100",
                ),
            ),
            "tBody_rus" => array(
                "format" => "tinymce",
                "fieldAliases" => array(
                    "en" => "body-rus1",
                    "rus" => "Тело-rus",
                ),
                "id" => "tBody_rus",
                "style" => array(
                    "class" => "wd100",
                ),
            ),
            "date_created" => array(
                "format" => "varchar",
                "readonly" => true,
                "fieldAliases" => array(
                    "en" => "created",
                    "rus" => "Создано",
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
        );


        $this->listFields = array (
            "btnDetail" => array(
                "replaces" => array("template_id"),
                "format" => "link",
                "url" => "template_id=template_id",
            ),
            "btnEdit" => array(
                "replaces" => array("template_id"),
                "format" => "link",
                "url" => "template_id=template_id",
            ),
            "btnDelete" => array(
                "replaces" => array("template_id"),
                "format" => "link",
                "url" => "template_id=template_id",
            ),
            "template_id" => array(
                "indexes" => 1,
                "format" => "hidden",
                "maxLength" => 20,
            ),
            "tName" => array(
                "format" => "varchar",
                "maxLength" => 20,
                "fieldAliases" => array(
                    "en" => "template name",
                    "rus" => "Назв. шаблона",
                ),
            ),
            "tHeader_en" => array(
                "format" => "varchar",
                "maxLength" => 20,
                "fieldAliases" => array(
                    "en" => "subject-en",
                    "rus" => "Тема-en",
                ),
            ),
            "tHeader_rus" => array(
                "format" => "varchar",
                "maxLength" => 20,
                "fieldAliases" => array(
                    "en" => "subject-rus",
                    "rus" => "Тема-rus",
                ),
            ),
            "date_created" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "created",
                    "rus" => "Создано",
                ),
            ),
            "createdLogin" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "Owner",
                    "rus" => "Владелец",
                ),
            ),
        );

        $this->searchFields = array(
            "date_created" => array(
                "format" => "hidden",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "Dt created",
                    "rus" => "Создано",
                ),
            ),
            "tName" => array(
                "format" => "varchar",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "template name",
                    "rus" => "Назв. шаблона",
                ),
            ),
            "tHeader_en" => array(
                "format" => "varchar",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "subject-en",
                    "rus" => "Тема-en",
                ),
            ),
            "tHeader_rus" => array(
                "format" => "varchar",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "subject-rus",
                    "rus" => "Тема-rus",
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
        );
        $this->viewFields = array(
            "tName" => array(
                "format" => "varchar",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "template name",
                    "rus" => "Назв. шаблона",
                ),
            ),
            "tHeader_en" => array(
                "format" => "varchar",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "subject-en",
                    "rus" => "Тема-en",
                ),
            ),
            "tHeader_rus" => array(
                "format" => "varchar",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "subject-rus",
                    "rus" => "Тема-rus",
                ),
            ),
            "tBody_en" => array(
                "format" => "text-block",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "body-en",
                    "rus" => "Тело-en",
                ),
                "id" => "tBody_en",
                "style" => array(
                    "class" => "wd100",
                ),

            ),
            "tBody_rus" => array(
                "format" => "text-block",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "body-rus",
                    "rus" => "Тело-rus",
                ),
                "id" => "tBody_rus",
                "style" => array(
                    "class" => "wd100",
                ),
            ),
            "date_created" => array(
                "format" => "varchar",
                "readonly" => true,
                "fieldAliases" => array(
                    "en" => "created",
                    "rus" => "Создано",
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
        );
    }
}
