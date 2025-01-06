<?php

namespace JointApp\Interfaces;

use JointApp\JointAppRequest;

interface ControllerInterface
{
    /*
     * return className controller->langMap
     * to message multi language texts
     */
    public function loadLangController():string;

    /*
     * set up controller params from construct params $controllerParams
     */
    public function controllerFilterParams($controllerParams = []):void;

    /*
    * set up controller params from request parsedBody
    */
    public function controllerFilterBody($bodyParams = []):void;

    /*
    * set up controller params from request query
    */
    public function controllerFilterQuery($queryParams = []):void;

    public function actionIndex();
}