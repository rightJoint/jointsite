<?php
require_once "application/core/jointSite.php";
jointSite::js_get_env_params(__DIR__."/.env");
$jointSite = new jointSite();
$jointSite->js_Run($_SERVER["DOCUMENT_ROOT"], $_SERVER["REQUEST_URI"]);