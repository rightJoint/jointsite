<?php
require_once "application/core/jointSite.php";
$jointSite = new jointSite();
$jointSite->js_Run("/mirror", $_SERVER["DOCUMENT_ROOT"], $_SERVER["REQUEST_URI"]);
//jointSite::jointSiteRun(null, $_SERVER["DOCUMENT_ROOT"], $_SERVER["REQUEST_URI"]);