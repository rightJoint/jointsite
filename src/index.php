<?php
require_once "application/core/jointSite.php";
$jointSite = new jointSite();
$jointSite->document_root = $_SERVER["DOCUMENT_ROOT"];
$jointSite->request_uri = $_SERVER["REQUEST_URI"];
$jointSite->js_Run();