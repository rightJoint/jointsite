<?php
class m_rsf_groupstousers extends recordStructureFields
{
    function __construct()
    {
        $this->record = array(
            "group_id" => array(
                "indexes" => 1,
                "format" => "varchar",
                "use_table_name" => "usersToGroups_dt",
            ),
            "user_id" => array(
                "indexes" => 1,
                "format" => "varchar",
                "use_table_name" => "usersToGroups_dt",
            ),
            "read_rule" => array(
                "format" => "varchar",
            ),
            "create_rule" => array(
                "format" => "varchar",
            ),
            "edit_rule" => array(
                "format" => "varchar",
            ),
            "delete_rule" => array(
                "format" => "varchar",
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
            "groupAlias" => array(
                "format" => "varchar",
                "use_table_name" => "usersGroups_dt",
                "use_filed_name" => "groupAlias",
            ),
            "send_ntf" => array(
                "format" => "tinyint",
            ),
        );

        $this->editFields = array(
            "group_id" => array(
                "indexes" => 1,
                "format" => "select",
                "filling" => array(),
                "fieldAliases" => array(
                    "en" => "Group",
                    "rus" => "Группа",
                ),
            ),
            "user_id" => array(
                "indexes" => 1,
                "format" => "select",
                "filling" => array(),
                "fieldAliases" => array(
                    "en" => "Login",
                    "rus" => "Логин",
                ),
            ),
            "read_rule" => array(
                "format" => "select",
                "fieldAliases" => array(
                    "en" => "View",
                    "rus" => "Просмотр",
                ),
                "filling" => array(),
            ),
            "create_rule" => array(
                "format" => "select",
                "fieldAliases" => array(
                    "en" => "Create",
                    "rus" => "Создание",
                ),
                "filling" => array(),
            ),
            "edit_rule" => array(
                "format" => "select",
                "fieldAliases" => array(
                    "en" => "Edit",
                    "rus" => "Редактирование",
                ),
                "filling" => array(),
            ),
            "delete_rule" => array(
                "format" => "select",
                "fieldAliases" => array(
                    "en" => "Delete",
                    "rus" => "Удаление",
                ),
                "filling" => array(),
            ),
            "send_ntf" => array(
                "format" => "tinyint",
                "fieldAliases" => array(
                    "en" => "Notification",
                    "rus" => "Оповещение",
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
                "replaces" => array("group_id", "user_id"),
                "format" => "link",
                "url" => "group_id=group_id&user_id=user_id",
            ),
            "btnEdit" => array(
                "replaces" => array("group_id", "user_id"),
                "format" => "link",
                "url" => "group_id=group_id&user_id=user_id",
            ),
            "btnDelete" => array(
                "replaces" => array("group_id", "user_id"),
                "format" => "link",
                "url" => "group_id=group_id&user_id=user_id",
            ),

            "group_id" => array(
                "format" => "hidden",
                "maxLength" => 20,
                "fieldAliases" => array(
                    "en" => "Group",
                    "rus" => "Группа",
                )
            ),
            "groupAlias" => array(
                "format" => "varchar",
                "maxLength" => 20,
                "fieldAliases" => array(
                    "en" => "groupAlias",
                    "rus" => "Назв. гр.",
                )
            ),
            "userLogin" => array(
                "format" => "varchar",
                "maxLength" => 20,
                "fieldAliases" => array(
                    "en" => "Login",
                    "rus" => "Логин",
                ),
            ),


            "user_id" => array(
                "format" => "hidden",
                "maxLength" => 20,
            ),

            "read_rule" => array(
                "format" => "select",
                "fieldAliases" => array(
                    "en" => "View",
                    "rus" => "Просмотр",
                ),
                "filling" => array(),
            ),
            "create_rule" => array(
                "format" => "select",
                "fieldAliases" => array(
                    "en" => "Create",
                    "rus" => "Создание",
                ),
                "filling" => array(),
            ),
            "edit_rule" => array(
                "format" => "select",
                "fieldAliases" => array(
                    "en" => "Edit",
                    "rus" => "Редактирование",
                ),
                "filling" => array(),
            ),
            "delete_rule" => array(
                "format" => "select",
                "fieldAliases" => array(
                    "en" => "Delete",
                    "rus" => "Удаление",
                ),
                "filling" => array(),
            ),
            "send_ntf" => array(
                "format" => "tinyint",
                "fieldAliases" => array(
                    "en" => "Notification",
                    "rus" => "Оповещение",
                ),
            ),
            "createdLogin" => array(
                "format" => "varchar",
                "maxLength" => 20,
                "fieldAliases" => array(
                    "en" => "Owner",
                    "rus" => "Владелец",
                ),
            ),

        );

        $this->searchFields = array(
            "groupAlias" => array(
                "format" => "varchar",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "Group",
                    "rus" => "Группа",
                ),
                "use_table_name" => "usersGroups_dt",
                "use_field_name" => "groupAlias_".$_SESSION[JS_SAIK]["lang"],
            ),
            "userLogin" => array(
                "indexes" => 1,
                "format" => "varchar",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "Login",
                    "rus" => "Логин",
                ),
                "use_table_name" => "udtuser",
                "use_field_name" => "accLogin",
            ),
            "read_rule" => array(
                "format" => "select",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "View",
                    "rus" => "Просмотр",
                ),
                "filling" => array(),
            ),
            "create_rule" => array(
                "format" => "select",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "Create",
                    "rus" => "Создание",
                ),
                "filling" => array(),
            ),
            "edit_rule" => array(
                "format" => "select",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "Edit",
                    "rus" => "Редактирование",
                ),
                "filling" => array(),
            ),
            "delete_rule" => array(
                "format" => "select",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "Delete",
                    "rus" => "Удаление",
                ),
                "filling" => array(),
            ),
            "send_ntf" => array(
                "format" => "tinyint",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "Notification",
                    "rus" => "Оповещение",
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
            "group_id" => array(
                "indexes" => 1,
                "format" => "varchar",
                "readonly" => 1,
            ),
            "user_id" => array(
                "indexes" => 1,
                "format" => "varchar",
                "readonly" => 1,
            ),
            "read_rule" => array(
                "format" => "varchar",
                "readonly" => 1,
            ),
            "create_rule" => array(
                "format" => "varchar",
                "readonly" => 1,
            ),
            "edit_rule" => array(
                "format" => "varchar",
                "readonly" => 1,
            ),
            "delete_rule" => array(
                "format" => "varchar",
                "readonly" => 1,
            ),
            "send_ntf" => array(
                "format" => "tinyint",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "Notification",
                    "rus" => "Оповещение",
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
}
