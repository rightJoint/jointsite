<?php
$module_tables_conf = array(
    "moduleTable" => array(
        "tableName" => "templates",
        "aliases" => array(
            "en" => "eMail templates",
            "rus" => "Шаблоны уведомлений"
        ),
    ),
    "bindTables" => array(
        "ntflist" => array(
            "aliases" => array(
                "en" => "Notification list",
                "rus" => "Список уведомлений"
            ),
            "relationships" => array(
                "template_id" => "template_id",
            ),
        ),
        "ntfusers" => array(
            "aliases" => array(
                "en" => "Users notifications",
                "rus" => "Уведомления пользователей"
            ),
        ),
    )
);