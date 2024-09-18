<?php
define("JOINT_SITE_EXEC_DIR", null);
define("JS_SAIK", "main");
$_SESSION[JS_SAIK]["lang"] = "rus";

global $request;
$request["routes"]["routes_path"] = "/";
$request["routes"][0] = null;
$request["routes"][1] = null;
$request["routes_cnt"] = 2;
$request["exec_path"] = null;
$request["exec_dir"][0] = null;
$request["exec_dir_cnt"] = 1;
$request["diff_cnt"][0] = 1;
$_SERVER["DOCUMENT_ROOT"] = "C:/OSPanel/domains/rj-test.local";

global $mct;
$mct['start_time'] = microtime(true);

define("JOINT_SITE_CONF_DIR", $_SERVER["DOCUMENT_ROOT"].$request["exec_path"]."/__loc_config");

require_once JOINT_SITE_CONF_DIR."/dir_const.php";
require_once JOINT_SITE_APP_CONFIG;