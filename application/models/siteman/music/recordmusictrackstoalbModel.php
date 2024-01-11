<?php
class recordmusictrackstoalbModel extends ModuleRecordsModel
{
    public $tableName = "musicTracksToAlb_dt";
    public $modelAliases = array(
        "en" => "music tracks to albums",
        "rus" => "мелодии в альбом"
    );

    function getRecordStructure()
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

    public function copyRecord()
    {

        $query_text="select ".$this->tableName.".track_id, ".$this->tableName.".album_id, ".
            $this->tableName.".comment, ".$this->tableName.".mActive, ".$this->tableName.".sortDate ".
            //", musicAlb_dt.albumName ".
            "from ".$this->tableName.
            // " left join musicAlb_dt on musicTracksToAlb_dt.album_id = musicAlb_dt.album_id ".
            // " left join musicTracks_dt on musicTracks_dt.track_id = musicTracksToAlb_dt.track_id ".
            " where ";
        foreach ($this->record as $fieldName=>$fieldInfo) {
            if ($fieldInfo["indexes"]) {
                $query_text.=$this->tableName.".".$fieldName."='".$fieldInfo["curVal"]."' and " ;
            }
        }
        $query_text = substr($query_text, 0, strlen($query_text)-4);
        $query_res = $this->query($query_text);
        if($query_res->rowCount()===1){
            $result=$query_res->fetch(PDO::FETCH_ASSOC);
            foreach ($this->record as $fieldName=>$fieldInfo) {
                $this->record[$fieldName]["curVal"] = $result[$fieldName];
                $this->record[$fieldName]["fetchVal"] = $result[$fieldName];
            }
            return true;
        }
        $this->log_message = "copyRecord fail";
        return false;
    }

    function copyCustomFields()
    {
        $albName_qry = "select albumName from musicAlb_dt where album_id = '".$this->record["album_id"]["curVal"]."'";
        $albName_res = $this->query($albName_qry);
        if($albName_res->rowCount() == 1){
            $this->record["albumName"]["curVal"] = $albName_res->fetch(self::FETCH_ASSOC)["albumName"];
        }

        $trackName_qry = "select track_name from musicTracks_dt where track_id = '".$this->record["track_id"]["curVal"]."'";
        $trackName_res = $this->query($trackName_qry);
        if($trackName_res->rowCount() == 1){
            $this->record["track_name"]["curVal"] = $trackName_res->fetch(self::FETCH_ASSOC)["track_name"];
        }

        return true;
    }

    public function listRecords($where = null, $order = null, $limit = null)
    {
        $findList_qry = "select musicTracksToAlb_dt.track_id, 
musicTracksToAlb_dt.album_id, 
musicTracksToAlb_dt.comment,
musicTracksToAlb_dt.mActive,
musicTracksToAlb_dt.sortDate, 
musicTracks_dt.track_name, 
musicTracks_dt.track_artist, 
musicTracks_dt.loadDate, 
musicAlb_dt.albumName, 
musicAlb_dt.albumImg 
from musicTracksToAlb_dt 
left join musicTracks_dt on musicTracks_dt.track_id = musicTracksToAlb_dt.track_id 
left join musicAlb_dt on musicTracksToAlb_dt.album_id = musicAlb_dt.album_id  ".
            $where.$order.$limit;

        return $this->fetchToArray($findList_qry);
    }

    public function countRecords($where = null)
    {
        return $this->query("SELECT COUNT(*) as cnt from ".$this->tableName." ".
            "left join musicTracks_dt on musicTracks_dt.track_id = musicTracksToAlb_dt.track_id 
left join musicAlb_dt on musicTracksToAlb_dt.album_id = musicAlb_dt.album_id  ".
            $where)->fetch(PDO::FETCH_ASSOC)["cnt"];
    }

    function copyGetId()
    {
        parent::copyGetId();
        $this->copyCustomFields();
    }

    function insertRecord()
    {
        if(!$this->record["album_id"]["curVal"]){

        }elseif (!$this->record["album_id"]["curVal"]){

        }else{
            return parent::insertRecord(); // TODO: Change the autogenerated stub
        }
    }
}