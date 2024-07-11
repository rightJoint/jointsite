<?php
//require_once "application/recordsStructureFiles/siteman/services/rsf_siteman_services_cards.php";
class m_model_serviceCards extends ModuleModel
{
    public $tableName = "srvCards_dt";
    public $modelAliases = array(
        "en" => "Services list",
        "rus" => "Список услуг",
    );

    function getRecordStructure()
    {
        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
            "/application/recordsStructureFiles/modules/services/rsf_siteman_services_cards.php";
        $this->recordStructureFields = new rsf_siteman_services_cards();
    }
}