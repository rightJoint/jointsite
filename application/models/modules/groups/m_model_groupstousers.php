<?php
require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
    "/application/models/modules/users/m_model_userstogroups.php";

class m_model_groupstousers extends m_model_userstogroups
{
    public $modelAliases = array(
        "en" => "Groups of users",
        "rus" => "Пользователи группы",
    );
    public $module_name = "groups";
}