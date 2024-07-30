<?php
class model_musictracks extends RecordsModel
{
    public $tableName = "musicTracks";

    public $modelAliases = array(
        "en" => "music tracks",
        "rus" => "мелодии"
    );

    function getRecordStructure()
    {
        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
            "/application/recordsStructureFiles/music/rsf_musictracks.php";
        $this->recordStructureFields = new rsf_musictracks();
    }
    function getNewTracks()
    {
        return $this->listRecords(null, " order by loadDate DESC ", " limit 0, 10", null);
    }
}