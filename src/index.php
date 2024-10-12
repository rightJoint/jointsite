<?php
require __DIR__ . '/vendor/autoload.php';

use JointSite\Core\JointSite;

$jointSite = new JointSite();
$jointSite->document_root = $_SERVER["DOCUMENT_ROOT"];
$jointSite->request_uri = $_SERVER["REQUEST_URI"];
$jointSite->js_Run();