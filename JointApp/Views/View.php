<?php

namespace JointApp\Views;


use JointApp\Interfaces\ViewInterface;

class View implements ViewInterface
{
    //json result
    public $responseJson = [];

    public function getResponseText():string
    {
        return 'test response example';
    }

    public function getResponseJson():array
    {
        return $this->responseJson;
    }
}