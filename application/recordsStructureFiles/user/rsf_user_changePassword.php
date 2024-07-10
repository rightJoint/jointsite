<?php
class rsf_user_changePassword extends recordStructureFields
{
    function __construct()
    {
        $this->record = array(
            "user_id" => array(
                "indexes" => 1,
                "format" => "varchar",
                "curVal" => $_SESSION[JS_SAIK]["site_user"]["user_id"],
            ),
            "pw_hash" => array(
                "format" => "varchar",
            ),
            "password" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "Password",
                    "rus" => "Пароль",
                ),
                "use_table_name" => "no-db",
            ),
            "new_password" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "New password",
                    "rus" => "Новый пароль",
                ),
                "use_table_name" => "no-db",
            ),
            "password_repeat" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "Repeat pass",
                    "rus" => "Повторите пароль",
                ),
                "use_table_name" => "no-db",
            ),
        );
        $this->editFields = array(
            "password" => array(
                "format" => "password",
                "fieldAliases" => array(
                    "en" => "Password",
                    "rus" => "Пароль",
                ),
            ),
            "new_password" => array(
                "format" => "password",
                "fieldAliases" => array(
                    "en" => "New password",
                    "rus" => "Новый пароль",
                ),
            ),
            "password_repeat" => array(
                "format" => "password",
                "fieldAliases" => array(
                    "en" => "Repeat pass",
                    "rus" => "Повторите пароль",
                ),
            ),
        );
    }
}