<?php
require_once "application/core/jointSite.php";
$jointSite = new jointSite();
$jointSite->js_Run(null, $_SERVER["DOCUMENT_ROOT"], $_SERVER["REQUEST_URI"]);