<?php
class recordmusictracksModel extends ModuleRecordsModel
{
    public $tableName = "musictracks_dt";
    public $modelAliases = array(
        "en" => "music tracks",
        "rus" => "мелодии"
    );

    function getRecordStructure()
    {

        $this->record = array(
            "track_id" => array(
                "indexes" => 1,
                "format" => "varchar",
            ),
            "track_name" => array(
                "format" => "varchar",
            ),
            "track_artist" => array(
                "format" => "varchar",
            ),
            "track_file" => array(
                "format" => "varchar",
            ),
            "loadDate" => array(
                "format" => "date",
                "curVal" => date("Y-m-d"),
            ),
        );
        $this->editFields = array (
            "track_id" => array(
                "indexes" => 1,
                "format" => "hidden",
            ),
            "track_name" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "Track name",
                    "rus" => "Наимен. мелодии",
                ),
            ),
            "track_artist" => array(
                "format" => "list",
                "fieldAliases" => array(
                    "en" => "Artist",
                    "rus" => "Исполнитель",
                ),
                "filling" => $this->fill_artist_list(),
            ),
            "track_file" => array(
                "format" => "file",
                "fieldAliases" => array(
                    "en" => "play file",
                    "rus" => "Файл мелодии",
                ),
                "file_options" => array(
                    "load_dir" => MUSIC_TRACKS_DIR,
                    //"file_type" => "img",
                    "accept" => "mp3",
                ),

                "with_name" => "GUID",
            ),
            "loadDate" => array(
                "format" => "date",
                "fieldAliases" => array(
                    "en" => "load-date",
                    "rus" => "Дт. загр.",
                ),
            ),
        );
        $this->listFields = array (
            "btnDetail" => array(
                "replaces" => array("track_id"),
                "format" => "link",
                "url" => "track_id=track_id",
            ),
            "btnEdit" => array(
                "replaces" => array("track_id"),
                "format" => "link",
                "url" => "track_id=track_id",
            ),
            "btnDelete" => array(
                "replaces" => array("track_id"),
                "format" => "link",
                "url" => "track_id=track_id",
            ),
            "track_id" => array(
                "indexes" => 1,
                "format" => "hidden",
                "maxLength" => 20,
            ),
            "track_name" => array(
                "format" => "varchar",
                "maxLength" => 20,
                "fieldAliases" => array(
                    "en" => "Track name",
                    "rus" => "Наимен. мелодии",
                ),
            ),
            "track_artist" => array(
                "format" => "varchar",
                "maxLength" => 20,
                "fieldAliases" => array(
                    "en" => "Artist",
                    "rus" => "Исполнитель",
                )
            ),
            "track_file" => array(
                "format" => "varchar",
                "maxLength" => 20,
                "fieldAliases" => array(
                    "en" => "play file",
                    "rus" => "Файл мелодии",
                ),
            ),
            "loadDate" => array(
                "format" => "date",
                "maxLength" => 20,
                "fieldAliases" => array(
                    "en" => "load-date",
                    "rus" => "Дт. загр.",
                ),
            ),
        );
        $this->searchFields = array(
            "loadDate" => array(
                "format" => "date",
                "sort" => 1,
                "sortOrder" => "DESC",
                "fieldAliases" => array(
                    "en" => "load-date",
                    "rus" => "Дт. загр.",
                ),
            ),
            "track_name" => array(
                "format" => "varchar",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "Track name",
                    "rus" => "Наимен. мелодии",
                ),
            ),
            "track_artist" => array(
                "format" => "varchar",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "Artist",
                    "rus" => "Исполнитель",
                )
            ),
            "track_file" => array(
                "format" => "varchar",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "play file",
                    "rus" => "Файл мелодии",
                ),
            ),
        );
        $this->viewFields = array(
            "track_id" => array(
                "indexes" => 1,
                "format" => "varchar",
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
            "track_artist" => array(
                "format" => "varchar",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "Artist",
                    "rus" => "Исполнитель",
                )
            ),
            "track_file" => array(
                "format" => "varchar",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "play file",
                    "rus" => "Файл мелодии",
                ),
            ),
            "loadDate" => array(
                "format" => "date",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "load-date",
                    "rus" => "Дт. загр.",
                ),
            ),
        );
    }

    function fill_artist_list()
    {
        $return = array();
        $qry = "select track_artist from musicTracks_dt group by track_artist order by track_artist";
        $res = $this->query($qry);
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
                $return[$row["track_artist"]] = $row["track_artist"];
            }
        }
        return $return;
    }

    function deleteRecord()
    {
        $clearAlb_qry = "delete from musicTracksToAlb_dt where track_id='".$this->record["track_id"]["curVal"]."'";
        $this->query($clearAlb_qry);
        return parent::deleteRecord(); // TODO: Change the autogenerated stub
    }
}