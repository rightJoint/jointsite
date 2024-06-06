<?php
class model_user_password extends Model_User
{
    public $tableName = "users_dt";
    public $modelAliases = array(
        "en" => "Change password",
        "rus" => "Сменить пароль",
    );

    public function getRecordStructure()
    {
        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
            "/application/recordsStructureFiles/user/rsf_user_changePassword.php";
        $this->recordStructureFields = new rsf_user_changePassword();
    }
}
