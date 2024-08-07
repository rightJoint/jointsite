<?php
class m_model_musicalb extends ModuleModel
{
    public $tableName = "musicAlb";

    public $tracksToAlb = "musicTracksToAlb";

    public $modelAliases = array(
        "en" => "music albums",
        "rus" => "альбомы музыки",
    );

    public $module_name = "music";

    function getRecordStructure()
    {
        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
            "/application/recordsStructureFiles/modules/music/m_rsf_musicalbums.php";
        $this->recordStructureFields = new m_rsf_musicalbums();
    }

    function listRecords($where = null, $order = null, $limit = null, $having = null)
    {
        $findList_qry = "select ".$this->tableName.".*, count(".$this->tracksToAlb.".album_id) as countRec   ";

        $findList_qry = substr($findList_qry, 0, strlen($findList_qry)-2);
        $findList_qry.= " from ".$this->tableName." ".
            "left join ".$this->tracksToAlb." on ".$this->tableName.".album_id = ".$this->tracksToAlb.".album_id ".
            $where.
            "group by ".$this->tableName.".album_id".
            $having.$order.$limit;

        return $this->fetchToArray($findList_qry);
    }
    function countRecords($where = null, $having = null)
    {
        return $this->query("select count(*) as cnt from (SELECT ".$this->tableName.".album_id, count(".$this->tracksToAlb.".album_id) as countRec from ".$this->tableName." ".
            "left join ".$this->tracksToAlb." on ".$this->tableName.".album_id = ".$this->tracksToAlb.".album_id ".
            $where." group by ".$this->tableName.".album_id ".$having.") xxx")->fetch(PDO::FETCH_ASSOC)["cnt"];
    }
}