<?php
require __DIR__ . '/vendor/autoload.php';

use jointSite\core\jointSite;

$jointSite = new jointSite();
$jointSite->document_root = $_SERVER["DOCUMENT_ROOT"];
$jointSite->request_uri = $_SERVER["REQUEST_URI"];
$jointSite->js_Run();