<?php
require_once "application/core/jointSite.php";
jointSite::jointSiteRun(null, $_SERVER["DOCUMENT_ROOT"], $_SERVER["REQUEST_URI"]);