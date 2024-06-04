<?php
class rsf_user_simple extends recordStructureFields
{
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
            "send_ntf" => array(
                "format" => "tinyint",
            ),
        );
        $this->editFields = array(
            "accLogin" => array(
                "format" => "varchar",
                "readonly" => true,
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
            "regDate" => array(
                "format" => "datetime",
                "readonly" => true,
                "fieldAliases" => array(
                    "en" => "Reg date",
                    "rus" => "Дата регистр.",
                ),
            ),
            "netWork" => array(
                "format" => "select",
                "readonly" => true,
                "fieldAliases" => array(
                    "en" => "Network",
                    "rus" => "Способ",
                ),
                "filling" => array(),
            ),
            "validDate" => array(
                "format" => "datetime",
                "readonly" => true,
                "fieldAliases" => array(
                    "en" => "Valid mail date",
                    "rus" => "Дата подтвержд.",
                ),
            ),
            "photoLink" => array(
                "format" => "file",
                "file_options" => array(
                    "accept" => "jpg,.jpeg,.png",
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
                "readonly" => true,
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
                "readonly" => true,
                "fieldAliases" => array(
                    "en" => "soc-profile",
                    "rus" => "Соц. профиль",
                ),
            ),
            "send_ntf" => array(
                "format" => "tinyint",
                "fieldAliases" => array(
                    "en" => "notify email",
                    "rus" => "Уведомления",
                ),
            ),
        );
    }
}