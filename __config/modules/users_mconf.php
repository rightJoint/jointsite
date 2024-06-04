<?php
$module_tables_conf = array(
    "moduleTable" => array(
        "tableName" => "users",
        "aliases" => array(
            "en" => "Users list",
            "rus" => "Список пользователей"
        ),
    ),
    "bindTables" => array(
        "userstogroups" => array(
            "aliases" => array(
                "en" => "Users groups",
                "rus" => "Группы пользователей"
            ),
            "relationships" => array(
                "user_id" => "user_id",
            ),
        ),
    )
);