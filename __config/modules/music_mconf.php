<?php
$module_tables_conf = array(
    "moduleTable" => array(
        "tableName" => "musicalb",
        "aliases" => array(
            "en" => "Albums",
            "rus" => "Альбомы"
        ),
    ),

    "bindTables" => array(
        "musictracks" => array(
            "aliases" => array(
                "en" => "Music tracks",
                "rus" => "Мелодии"
            ),
        ),
        "musictrackstoalb" => array(
            "aliases" => array(
                "en" => "Track to albums",
                "rus" => "Трэки в альбом"
            ),
            "relationships" => array(
                "album_id" => "album_id",
            ),
        ),
    )
);