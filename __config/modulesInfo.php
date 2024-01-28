<?php
$modulesInfo["users"] = array(
    "accessGroups" => array("10DA61AA-63CE-491F-90B4-3493E02F2A81", "A8357ED4-D2FD-45B3-9ACD-950950BE3535"),
    "mUrl" => "siteman/users",
    "mImg" => "/img/popimg/user-logo.png",
    "mAliases" => array(
        "en" => "Users",
        "rus" => "Пользователи"
    ),
    "moduleTable" => array(
        "tableName" => "users_dt",
        "aliases" => array(
            "en" => "Users list",
            "rus" => "Список пользователей"
        ),
        "tUrl" => "users",
    ),
    "bindTables" => array(
        "usersToGroups_dt" => array(
            "aliases" => array(
                "en" => "Users groups",
                "rus" => "Группы пользователей"
            ),
            "tUrl" => "userstogroups",
            "relationships" => array(
                "user_id" => "user_id",
            ),
        ),
    )
);
$modulesInfo["groups"] = array(
    "accessGroups" => array("10DA61AA-63CE-491F-90B4-3493E02F2A81"),
    "mUrl" => "siteman/groups",
    "mImg" => "/img/popimg/user_group.png",
    "mAliases" => array(
        "en" => "Access groups",
        "rus" => "Группы доступа"
    ),
    "moduleTable" => array(
        "tableName" => "usersGroups_dt",
        "aliases" => array(
            "en" => "Groups list",
            "rus" => "Список групп"
        ),
        "tUrl" => "groups",
    ),

    "bindTables" => array(
        "usersToGroups_dt" => array(
            "aliases" => array(
                "en" => "Groups users",
                "rus" => "Пользователи группы"
            ),
            "tUrl" => "groupstousers",
            "relationships" => array(
                "group_id" => "group_id",
            ),
        ),
    )
);
$modulesInfo["notifications"] = array(
    "accessGroups" => array("admin-group-only"),
    "mUrl" => "siteman/notifications",
    "mImg" => "/img/popimg/eMailLogo-2.png",
    "mAliases" => array(
        "en" => "Notifications",
        "rus" => "Уведомления"
    ),
    "moduleTable" => array(
        "tableName" => "ntfTemplates_dt",
        "aliases" => array(
            "en" => "eMail templates",
            "rus" => "Шаблоны уведомлений"
        ),
        "tUrl" => "templates",
    ),
    "bindTables" => array(
        "ntfList_dt" => array(
            "aliases" => array(
                "en" => "Notification list",
                "rus" => "Список уведомлений"
            ),
            "tUrl" => "ntflist",
        ),
        "ntfRead_dt" => array(
            "aliases" => array(
                "en" => "Users notifications",
                "rus" => "Уведомления пользователей"
            ),
            "tUrl" => "ntfusers",
        ),
    )
);
$modulesInfo["music"] = array(
    "accessGroups" => array("E97601F3-B968-4826-8772-AA405B2F5B01"), //music group
    "mUrl" => "siteman/music",
    "mImg" => "/img/popimg/music-logo.png",
    "mAliases" => array(
        "en" => "Music",
        "rus" => "Музыка"
    ),
    "moduleTable" => array(
        "tableName" => "musicAlb_dt",
        "aliases" => array(
            "en" => "Albums",
            "rus" => "Альбомы"
        ),
        "tUrl" => "albums",
    ),

    "bindTables" => array(
        "musictracks_dt" => array(
            "aliases" => array(
                "en" => "Music tracks",
                "rus" => "Мелодии"
            ),
            "tUrl" => "musictracks",
        ),
        "musictrackstoalb_dt" => array(
            "aliases" => array(
                "en" => "Track to albums",
                "rus" => "Трэки в альбом"
            ),
            "tUrl" => "musictrackstoalb",
            "relationships" => array(
                "album_id" => "album_id",
            ),
        ),
    )
);