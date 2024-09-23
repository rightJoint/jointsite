<?php
class rsf_musictrackstoalb extends recordStructureFields
{
    function __construct()
    {
        $this->record = array(
            "track_id" => array(
                "indexes" => 1,
                "format" => "varchar",
            ),
            "album_id" => array(
                "indexes" => 1,
                "format" => "varchar",
            ),
            "comment" => array(
                "format" => "text",
            ),
            "sortDate" => array(
                "format" => "date",
            ),
            "mActive" => array(
                "format" => "tinyint",
                "curVal" => 1,
            ),
            "track_name" => array(
                "format" => "varchar",
                "use_table_name" => "musicTracks_dt",
            ),
            "albumName" => array(
                "format" => "varchar",
                "use_table_name" => "musicTracks_dt",
            ),
        );
        $this->editFields = array(
            "track_id" => array(
                "indexes" => 1,
                "format" => "find-select",
                "fillName" => "track_name",
                "fieldAliases" => array(
                    "en" => "Track name",
                    "rus" => "Наимен. мелодии",
                ),
            ),
            "album_id" => array(
                "indexes" => 1,
                "format" => "find-select",
                "fillName" => "albumName",
                "fieldAliases" => array(
                    "en" => "Alb name",
                    "rus" => "Наимен. альб.",
                ),
            ),
            "comment" => array(
                "format" => "text",
            ),
            "sortDate" => array(
                "format" => "date",
                "fieldAliases" => array(
                    "en" => "sort date",
                    "rus" => "Сорт.Дт.",
                ),
            ),
            "mActive" => array(
                "format" => "tinyint",
            ),
        );
        $this->listFields = array(
            "btnDetail" => array(
                "replaces" => array("track_id", "album_id"),
                "format" => "link",
                "url" => "track_id=track_id&album_id=album_id",
            ),
            "btnEdit" => array(
                "replaces" => array("track_id", "album_id"),
                "format" => "link",
                "url" => "track_id=track_id&album_id=album_id",
            ),
            "btnDelete" => array(
                "replaces" => array("track_id", "album_id"),
                "format" => "link",
                "url" => "track_id=track_id&album_id=album_id",
            ),
            "track_id" => array(
                "format" => "hidden",
                "maxLength" => 20,
            ),
            "album_id" => array(
                "format" => "hidden",
                "maxLength" => 20,
            ),
            "albumName" => array(
                "format" => "varchar",
                "maxLength" => 20,
                "fieldAliases" => array(
                    "en" => "Alb name",
                    "rus" => "Наимен. альб.",
                ),
            ),
            "track_name" => array(
                "format" => "varchar",
                "maxLength" => 20,
                "fieldAliases" => array(
                    "en" => "Track name",
                    "rus" => "Наимен. мелодии",
                ),
            ),
            "comment" => array(
                "format" => "text",
                "maxLength" => 20,
            ),

            "mActive" => array(
                "format" => "tinyint",
                "maxLength" => 20,
            ),
            "sortDate" => array(
                "format" => "date",
                "fieldAliases" => array(
                    "en" => "sort date",
                    "rus" => "Сорт.Дт.",
                ),
            ),
        );

        $this->searchFields = array(
            "album_id" => array(
                "indexes" => 1,
                "format" => "hidden",
                "sort" => 1,
                "search" =>1,
            ),

            "albumName" => array(
                "format" => "varchar",
                "sort" => 1,
                "search" =>1,
                "use_table_name" => "musicAlb_dt",
                "fieldAliases" => array(
                    "en" => "Alb name",
                    "rus" => "Наимен. альб.",
                ),
            ),
            "track_name" => array(
                "format" => "varchar",
                "sort" => 1,
                "search" =>1,
                "use_table_name" => "musicTracks_dt",
                "fieldAliases" => array(
                    "en" => "Track name",
                    "rus" => "Наимен. мелодии",
                ),
            ),
            "comment" => array(
                "format" => "varchar",
                "sort" => 1,
                "search" =>1,
            ),
            "mActive" => array(
                "format" => "tinyint",
                "sort" => 1,
                "search" =>1,
            ),
            "sortDate" => array(
                "sort" => 1,
                "search" =>1,
                "format" => "date",
                "fieldAliases" => array(
                    "en" => "sort date",
                    "rus" => "Сорт.Дт.",
                ),
            ),

        );

        $this->viewFields = array(
            "track_id" => array(
                "indexes" => 1,
                "format" => "varchar",
                "readonly" => 1,
            ),
            "album_id" => array(
                "indexes" => 1,
                "format" => "varchar",
                "readonly" => 1,
            ),
            "comment" => array(
                "format" => "varchar",
                "readonly" => 1,
            ),
            "mActive" => array(
                "format" => "tinyint",
                "readonly" => 1,
            ),
            "track_name" => array(
                "format" => "varchar",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "Track name",
                    "rus" => "Наимен. мелодии",
                ),
            ),
            "albumName" => array(
                "format" => "varchar",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "Alb name",
                    "rus" => "Наимен. альб.",
                ),
            ),
            "sortDate" => array(
                "readonly" => 1,
                "format" => "date",
                "fieldAliases" => array(
                    "en" => "sort date",
                    "rus" => "Сорт.Дт.",
                ),
            ),
        );
    }
}
