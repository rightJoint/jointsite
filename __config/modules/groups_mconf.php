<?php
$module_tables_conf = array(
    "moduleTable" => array(
        "tableName" => "groups",
        "aliases" => array(
            "en" => "Groups list",
            "rus" => "Список групп"
        ),
    ),
    "bindTables" => array(
        "groupstousers" => array(
            "aliases" => array(
                "en" => "Groups users",
                "rus" => "Пользователи группы"
            ),
            "relationships" => array(
                "group_id" => "group_id",
            ),
        ),
    )
);