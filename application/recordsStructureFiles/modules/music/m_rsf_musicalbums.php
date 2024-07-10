<?php
class m_rsf_musicalbums extends recordStructureFields
{
    function __construct()
    {
        $this->record = array(
            'album_id' => array(
                "indexes" => 1,
                "format" => "varchar",
            ),
            "albumName" => array(
                "format" => "varchar",
            ),
            "albumAlias" => array(
                "format" => "varchar",
            ),
            "metaDescr" => array(
                "format" => "text",
            ),
            "dateOfCr" => array(
                "format" => "date",
                "curVal" => date("Y-m-d"),
            ),
            "albumImg" => array(
                "format" => "varchar",
            ),
            "activeFlag" => array(
                "format" => "tinyint",
                "curVal" => 1,
            ),
            "refreshDate" => array(
                "format" => "date",
                "curVal" => date("Y-m-d"),
            ),
            "robIndex" => array(
                "format" => "tinyint",
                "curVal" => 1,
            ),
            "created_by" => array(
                "format" => "varchar",
            ),
        );

        $this->editFields = array(
            'album_id' => array(
                "indexes" => 1,
                "format" => "hidden",
            ),
            "albumName" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "Alb name",
                    "rus" => "Наимен. альб.",
                ),
            ),
            "albumAlias" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "url ref",
                    "rus" => "url ссылка",
                ),
            ),
            "metaDescr" => array(
                "format" => "text",
                "fieldAliases" => array(
                    "en" => "Meta",
                    "rus" => "Описание",
                ),
            ),
            "dateOfCr" => array(
                "format" => "date",
                "fieldAliases" => array(
                    "en" => "Create date",
                    "rus" => "Создан",
                ),
            ),
            "albumImg" => array(
                "format" => "file",
                "file_options" => array(
                    "load_dir" => MUSIC_COVERS_DIR,
                    "file_type" => "img",
                    "accept" => ".jpg,.jpeg,.png",
                ),
                "fieldAliases" => array(
                    "en" => "Cover",
                    "rus" => "Обложка",
                ),
            ),
            "activeFlag" => array(
                "format" => "tinyint",
                "fieldAliases" => array(
                    "en" => "use",
                    "rus" => "исп.",
                ),
            ),
            "refreshDate" => array(
                "format" => "date",
                "fieldAliases" => array(
                    "en" => "Updated",
                    "rus" => "обн.",
                ),
            ),
            "robIndex" => array(
                "format" => "tinyint",
                "fieldAliases" => array(
                    "en" => "seo-rob-index",
                    "rus" => "сео-индекс",
                ),
            ),
        );

        $this->listFields = array(
            "btnDetail" => array(
                "replaces" => array("album_id"),
                "format" => "link",
                "url" => "album_id=album_id",
            ),
            "btnEdit" => array(
                "replaces" => array("album_id"),
                "format" => "link",
                "url" => "album_id=album_id",
            ),
            "btnDelete" => array(
                "replaces" => array("album_id"),
                "format" => "link",
                "url" => "album_id=album_id",
            ),
            'album_id' => array(
                "indexes" => 1,
                "format" => "hidden",
                "search" => 1,
                "sort" => 1,
            ),
            "albumName" => array(
                "format" => "varchar",
                "maxLength" => 20,
                "fieldAliases" => array(
                    "en" => "Alb name",
                    "rus" => "Наимен. альб.",
                ),

            ),
            "albumAlias" => array(
                "format" => "varchar",
                "maxLength" => 20,
                "fieldAliases" => array(
                    "en" => "url ref",
                    "rus" => "url ссылка",
                ),
            ),
            "metaDescr" => array(
                "format" => "text",
                "maxLength" => 20,
                "fieldAliases" => array(
                    "en" => "meta",
                    "rus" => "описание",
                ),
            ),
            "dateOfCr" => array(
                "format" => "date",
                "maxLength" => 20,
                "fieldAliases" => array(
                    "en" => "Create date",
                    "rus" => "Создан",
                ),
            ),
            "albumImg" => array(
                "format" => "file",
                "file_options" => array(
                    "load_dir" => MUSIC_COVERS_DIR,
                    "file_type" => "img",
                ),
                "fieldAliases" => array(
                    "en" => "Cover",
                    "rus" => "Обложка",
                ),
            ),
            "activeFlag" => array(
                "format" => "tinyint",
                "maxLength" => 20,
                "fieldAliases" => array(
                    "en" => "use",
                    "rus" => "исп.",
                ),
            ),
            "refreshDate" => array(
                "format" => "date",
                "maxLength" => 20,
                "fieldAliases" => array(
                    "en" => "Updated",
                    "rus" => "обн.",
                ),
            ),
            "robIndex" => array(
                "format" => "tinyint",
                "maxLength" => 20,
                "fieldAliases" => array(
                    "en" => "seo-rob-index",
                    "rus" => "сео-индекс",
                ),
            ),
            "countRec" => array(
                "fieldAliases" => array(
                    "en" => "countInAlbum",
                    "rus" => "к-во в Альбоме",
                ),
                "format" => "int",
            ),
        );
        $this->searchFields = array(
            "albumName" => array(
                "format" => "varchar",
                "search" => 1,
                "sort" => 1,
                "fieldAliases" => array(
                    "en" => "Alb name",
                    "rus" => "Наимен. альб.",
                ),
            ),
            "albumAlias" => array(
                "format" => "varchar",
                "search" => 1,
                "sort" => 1,
                "fieldAliases" => array(
                    "en" => "url ref",
                    "rus" => "url ссылка",
                ),
            ),
            "metaDescr" => array(
                "format" => "text",
                "search" => 1,
                "sort" => 1,
                "fieldAliases" => array(
                    "en" => "meta",
                    "rus" => "описание",
                ),
            ),
            "dateOfCr" => array(
                "format" => "date",
                "search" => 1,
                "sort" => 1,
                "fieldAliases" => array(
                    "en" => "Create date",
                    "rus" => "Создан",
                ),
            ),
            "activeFlag" => array(
                "format" => "tinyint",
                "search" => 1,
                "sort" => 1,
                "fieldAliases" => array(
                    "en" => "use",
                    "rus" => "исп.",
                ),
            ),
            "refreshDate" => array(
                "format" => "date",
                "search" => 1,
                "sort" => 1,
                "fieldAliases" => array(
                    "en" => "Updated",
                    "rus" => "обн.",
                ),
            ),
            "robIndex" => array(
                "format" => "tinyint",
                "search" => 1,
                "sort" => 1,
                "fieldAliases" => array(
                    "en" => "seo-rob-index",
                    "rus" => "сео-индекс",
                ),
            ),
            "countRec" => array(
                "fieldAliases" => array(
                    "en" => "countInAlbum",
                    "rus" => "к-во в Альбоме",
                ),
                "format" => "int",
                "sort" => 1,
                "search" => 1,
                "group_by_field" =>1,
            ),
        );
        $this->viewFields = array(
            'album_id' => array(
                "indexes" => 1,
                "format" => "varchar",
                "readonly" => 1,
            ),
            "albumName" => array(
                "format" => "varchar",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "Alb name",
                    "rus" => "Наимен. альб.",
                ),
            ),
            "albumAlias" => array(
                "format" => "varchar",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "url ref",
                    "rus" => "url ссылка",
                ),
            ),
            "metaDescr" => array(
                "format" => "text",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "meta",
                    "rus" => "описание",
                ),
            ),
            "dateOfCr" => array(
                "format" => "date",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "Create date",
                    "rus" => "Создан",
                ),
            ),
            "albumImg" => array(
                "format" => "varchar",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "Cover",
                    "rus" => "Обложка",
                ),
            ),
            "activeFlag" => array(
                "format" => "tinyint",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "use",
                    "rus" => "исп.",
                ),
            ),
            "refreshDate" => array(
                "format" => "date",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "Updated",
                    "rus" => "обн.",
                ),
            ),
            "robIndex" => array(
                "format" => "tinyint",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "seo-rob-index",
                    "rus" => "сео-индекс",
                ),
            ),
        );
    }
}
