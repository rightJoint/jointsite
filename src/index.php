<?php
//echo $_SERVER["DOCUMENT_ROOT"];
$env = parse_ini_file('.env');
require_once "application/core/jointSite.php";
$jointSite = new jointSite();
$jointSite->js_Run($env["JOINT_SITE_EXEC_DIR"], $_SERVER["DOCUMENT_ROOT"], $_SERVER["REQUEST_URI"]);