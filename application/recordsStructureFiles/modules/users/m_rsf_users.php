<?php
class m_rsf_users extends recordStructureFields
{
    function s_site_user($param){
        if($param == "readonly"){
            if(isset($_SESSION["site_user"]["is_admin"]) and $_SESSION["site_user"]["is_admin"] == true){
                return true;
            }else{
                return false;
            }
        }
        if(isset($_SESSION["site_user"][$param])){
            return $_SESSION["site_user"][$param];
        }else{
            return null;
        }
    }
    function __construct()
    {
        $this->record = array(
            "user_id" => array(
                "indexes" => 1,
                "format" => "varchar",
            ),
            "accLogin" => array(
                "format" => "varchar",
            ),
            "accAlias" => array(
                "format" => "varchar",
            ),
            "pw_hash" => array(
                "format" => "varchar",
            ),
            "vldCode" => array(
                "format" => "varchar",
            ),
            "regDate" => array(
                "format" => "datetime",
                "curVal" => date("Y-m-d H:i:s"),
            ),
            "netWork" => array(
                "format" => "varchar",
            ),
            "validDate" => array(
                "format" => "datetime",
            ),
            "photoLink" => array(
                "format" => "varchar",
            ),
            "eMail" => array(
                "format" => "varchar",
            ),
            "birthDay" => array(
                "format" => "date",
            ),
            "socProf" => array(
                "format" => "varchar",
            ),
            "blackList" => array(
                "format" => "tinyint",
            ),
            "created_by" => array(
                "format" => "varchar",
                "curVal" => $this->s_site_user("user_id"),
            ),
            "createdLogin" => array(
                "format" => "varchar",
                "use_table_name" => "udtcreated",
                "curVal" => $this->s_site_user("accLogin"),
            ),
            "send_ntf" => array(
                "format" => "tinyint",
            ),
            "is_admin" => array(
                "format" => "tinyint",
            ),
        );
        $this->editFields = array(
            "user_id" => array(
                "indexes" => 1,
                "format" => "hidden",
            ),
            "accLogin" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "Login",
                    "rus" => "Логин",
                ),
            ),
            "accAlias" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "User alias",
                    "rus" => "Псевдоним",
                ),
            ),
            "pw_hash" => array(
                "format" => "varchar",
            ),
            "vldCode" => array(
                "format" => "varchar",
            ),
            "regDate" => array(
                "format" => "datetime",
                "fieldAliases" => array(
                    "en" => "Reg date",
                    "rus" => "Дата регистр.",
                ),
            ),
            "netWork" => array(
                "format" => "select",
                "fieldAliases" => array(
                    "en" => "Network",
                    "rus" => "Способ",
                ),
                "filling" => array(),
            ),
            "validDate" => array(
                "format" => "datetime",
                "fieldAliases" => array(
                    "en" => "Valid mail date",
                    "rus" => "Дата подтвержд.",
                ),
            ),
            "photoLink" => array(
                "fieldAliases" => array(
                    "en" => "Avatar",
                    "rus" => "Аватарка",
                ),
                "format" => "file",
                "file_options" => array(
                    "accept" => "jpg,.jpeg,.png",
                    "load_dir" => USERS_AVATARS_DIR,
                    "file_type" => "img",
                ),
            ),
            "eMail" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "Mail",
                    "rus" => "Почта",
                ),
            ),
            "birthDay" => array(
                "format" => "date",
                "fieldAliases" => array(
                    "en" => "birthday",
                    "rus" => "Д.р.",
                ),
            ),
            "socProf" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "soc-profile",
                    "rus" => "Соц. профиль",
                ),
            ),
            "blackList" => array(
                "format" => "tinyint",
                "fieldAliases" => array(
                    "en" => "Block user",
                    "rus" => "Заблокирован",
                ),
            ),
            "send_ntf" => array(
                "format" => "tinyint",
                "fieldAliases" => array(
                    "en" => "Notification",
                    "rus" => "Оповещение",
                ),
            ),
            "created_by" => array(
                "format" => "hidden",
                "readonly" => true,
                "fieldAliases" => array(
                    "en" => "Created by",
                    "rus" => "Создал(а)",
                ),
            ),
            "createdLogin" => array(
                "format" => "varchar",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "Owner",
                    "rus" => "Владелец",
                ),
            ),
            "is_admin" => array(
                "format" => "tinyint",
                "readonly" => $this->s_site_user("readonly"),
                "fieldAliases" => array(
                    "en" => "admin",
                    "rus" => "админ",
                ),
            ),
        );

        $this->listFields = array(
            "btnDetail" => array(
                "replaces" => array("user_id"),
                "format" => "link",
                "url" => "user_id=user_id"
            ),
            "btnEdit" => array(
                "replaces" => array("user_id"),
                "format" => "link",
                "url" => "user_id=user_id"
            ),
            "btnDelete" => array(
                "replaces" => array("user_id"),
                "format" => "link",
                "url" => "user_id=user_id"
            ),
            "user_id" => array(
                "format" => "hidden",
                "maxLength" => 20,
            ),
            "accLogin" => array(
                "format" => "varchar",
                "maxLength" => 20,
                "fieldAliases" => array(
                    "en" => "Login",
                    "rus" => "Логин",
                ),
            ),
            "accAlias" => array(
                "format" => "varchar",
                "maxLength" => 20,
                "fieldAliases" => array(
                    "en" => "User alias",
                    "rus" => "Псевдоним",
                ),
            ),
            "regDate" => array(
                "format" => "datetime",
                "maxLength" => 20,
                "fieldAliases" => array(
                    "en" => "Reg date",
                    "rus" => "Дата регистр.",
                ),
            ),
            "netWork" => array(
                "format" => "varchar",
                "maxLength" => 20,
                "fieldAliases" => array(
                    "en" => "Network",
                    "rus" => "Способ",
                ),
            ),
            "validDate" => array(
                "format" => "datetime",
                "maxLength" => 20,
                "fieldAliases" => array(
                    "en" => "Valid mail date",
                    "rus" => "Дата подтвержд.",
                ),
            ),
            "photoLink" => array(
                "format" => "file",
                "file_options" => array(
                    "load_dir" => USERS_AVATARS_DIR,
                    "file_type" => "img",
                ),
                "fieldAliases" => array(
                    "en" => "Avatar",
                    "rus" => "Аватарка",
                ),
            ),
            "eMail" => array(
                "format" => "varchar",
                "maxLength" => 20,
                "fieldAliases" => array(
                    "en" => "Mail",
                    "rus" => "Почта",
                ),
            ),
            "birthDay" => array(
                "format" => "date",
                "fieldAliases" => array(
                    "en" => "birthday",
                    "rus" => "Д.р.",
                ),
            ),
            "socProf" => array(
                "format" => "varchar",
                "maxLength" => 20,
                "fieldAliases" => array(
                    "en" => "soc-profile",
                    "rus" => "Соц. профиль",
                ),
            ),
            "blackList" => array(
                "format" => "tinyint",
                "maxLength" => 20,
                "fieldAliases" => array(
                    "en" => "Block user",
                    "rus" => "Заблокирован",
                ),
            ),
            "send_ntf" => array(
                "format" => "tinyint",
                "fieldAliases" => array(
                    "en" => "Notification",
                    "rus" => "Оповещение",
                ),
            ),
            "createdLogin" => array(
                "format" => "varchar",
                "maxLength" => 20,
                "fieldAliases" => array(
                    "en" => "Owner",
                    "rus" => "Владелец",
                ),
            ),
            "is_admin" => array(
                "format" => "tinyint",
                "fieldAliases" => array(
                    "en" => "admin",
                    "rus" => "админ",
                ),
            ),
        );

        $this->searchFields = array(
            "accLogin" => array(
                "format" => "varchar",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "Login",
                    "rus" => "Логин",
                ),
            ),
            "accAlias" => array(
                "format" => "varchar",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "User alias",
                    "rus" => "Псевдоним",
                ),
            ),
            "regDate" => array(
                "format" => "date",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "Reg date",
                    "rus" => "Дата регистр.",
                ),
            ),
            "netWork" => array(
                "format" => "varchar",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "Network",
                    "rus" => "Способ",
                ),
            ),
            "validDate" => array(
                "format" => "date",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "Valid mail date",
                    "rus" => "Дата подтвержд.",
                ),
            ),
            "eMail" => array(
                "format" => "varchar",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "Mail",
                    "rus" => "Почта",
                ),
            ),
            "birthDay" => array(
                "format" => "date",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "birthday",
                    "rus" => "Д.р.",
                ),
            ),
            "blackList" => array(
                "format" => "tinyint",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "Block user",
                    "rus" => "Заблокирован",
                ),
            ),
            "send_ntf" => array(
                "format" => "tinyint",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "Notification",
                    "rus" => "Оповещение",
                ),
            ),
            "created_by" => array(
                "format" => "varchar",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "Created by",
                    "rus" => "Создал(а)",
                ),
            ),
            "createdLogin" => array(
                "format" => "varchar",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "Owner",
                    "rus" => "Владелец",
                ),
                "use_table_name" => "udtcreated",
                "use_field_name" => "accLogin",
            ),
            "is_admin" => array(
                "format" => "tinyint",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "admin",
                    "rus" => "админ",
                ),
            ),
        );

        $this->viewFields = array(
            "user_id" => array(
                "indexes" => 1,
                "format" => "varchar",
                "readonly" => 1,
            ),
            "accLogin" => array(
                "format" => "varchar",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "Login",
                    "rus" => "Логин",
                ),
            ),
            "accAlias" => array(
                "format" => "varchar",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "User alias",
                    "rus" => "Псевдоним",
                ),
            ),
            "pw_hash" => array(
                "format" => "varchar",
                "readonly" => 1,
            ),
            "vldCode" => array(
                "format" => "varchar",
                "readonly" => 1,
            ),
            "regDate" => array(
                "format" => "datetime",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "Reg date",
                    "rus" => "Дата регистр.",
                ),
            ),
            "netWork" => array(
                "format" => "varchar",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "Network",
                    "rus" => "Способ",
                ),
            ),
            "validDate" => array(
                "format" => "datetime",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "Valid mail date",
                    "rus" => "Дата подтвержд.",
                ),
            ),
            "photoLink" => array(
                "format" => "varchar",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "Avatar",
                    "rus" => "Аватарка",
                ),
            ),
            "eMail" => array(
                "format" => "varchar",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "Mail",
                    "rus" => "Почта",
                ),
            ),
            "birthDay" => array(
                "format" => "date",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "birthday",
                    "rus" => "Д.р.",
                ),
            ),
            "socProf" => array(
                "format" => "varchar",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "soc-profile",
                    "rus" => "Соц. профиль",
                ),
            ),
            "blackList" => array(
                "format" => "tinyint",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "Block user",
                    "rus" => "Заблокирован",
                ),
            ),
            "send_ntf" => array(
                "format" => "tinyint",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "Notification",
                    "rus" => "Оповещение",
                ),
            ),
            "created_by" => array(
                "format" => "varchar",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "Created by",
                    "rus" => "Создал(а)",
                ),
            ),
            "is_admin" => array(
                "format" => "tinyint",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "admin",
                    "rus" => "админ",
                ),
            ),
        );
    }
}
