<?php
require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR."/application/recordsStructureFiles/test/rsf_musicalbums.php";
class model_records_musicalb extends RecordsModel
{
    public $tableName = "musicAlb_dt";
    public $modelAliases = array(
        "en" => "music albums",
        "rus" => "альбомы музыки",
    );
    function getRecordStructure()
    {
        $this->recordStructureFields = new rsf_musicalbums();
    }
}