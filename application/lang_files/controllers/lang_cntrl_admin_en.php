<?php
class lang_cntrl_admin_en extends lang_cntrl_en
{
    public $auth_required_err = "Authorization required";
    public $auth_err_login = "wrong login or password";
    public $no_connect_module = "not available without connection";
    public $admin_users = array(
        "login_reserved" => "login reserved",
        "login_unacceptable" => "login unacceptable",
        "password_unacceptable" => "password unacceptable",
        "unknown" => "cant save file",
        "Success" => "Success",
    );
    public $admin_sql = array(
        "susses" => "SUSSES",
        "row" => "row(s)",
        "susses_no_rows" => "SUSSES: no row(s)",
        "fail" => "QUERY FAIL",
    );
    public $admin_printquery = array(
        "fail" => "select query fail",
    );
    public $table_actions = array(
        "create" => "create",
        "drop" => "drop",
        "clear" => "clear",
        "download" => "download",
        "upLoad" => "upLoad",
        "use_table_name" => "tables",
        "fail" => "fail",
        "action" => "Action",
        "options" => "arguments",
        "tableName" => "tableName",
    );
}