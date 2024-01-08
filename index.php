<?php
global $mct;
$mct['start_time'] = microtime(true);

require_once 'application/core/model.php';
require_once 'application/core/view.php';
require_once 'application/core/controller.php';
require_once 'application/core/application.php';

session_start();

function throwErr($errType, $message)
{
    include "application/core/Alerts_model.php";
    include "application/core/Alerts_controller.php";
    include "application/core/alerts_view.php";
    $controller = new Alerts_controller();
    $controller->generateErr($errType, $message);
    exit;
}

Application::run();