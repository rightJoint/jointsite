<?php
class simpleUserModel extends ModuleModel
{
    public $tableName = "users_dt";
    public $modelAliases = array(
        "en" => "Main",
        "rus" => "Основное",
    );

    function getRecordStructure()
    {
        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
            "/application/recordsStructureFiles/user/rsf_user_simple.php";

        $this->recordStructureFields = new rsf_user_simple();
        $this->recordStructureFields->editFields["netWork"]["filling"] = $this->lang_map->network_select;
    }

    function load_lang_files()
    {
        parent::load_lang_files();

        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
            "/application/lang_files/models/modules/m_lang_model_users_".$_SESSION[JS_SAIK]["lang"].".php";
        return "m_lang_model_users_".$_SESSION[JS_SAIK]["lang"];

    }

    function get_access_groups()
    {
        $this->access_groups = null;
    }
}
