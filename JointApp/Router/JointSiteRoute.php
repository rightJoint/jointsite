<?php


namespace JointApp\Router;

class JointSiteRoute
{
    public string $controllerName = '';
    public $controllerParams = [];
    public $actionsList = [];
    //public string $actionName = '';
   // public $actionParams = [];
    public string $modelName = '';
    public $modelParams = [];
    public string $viewName = '';
    public $viewParams = [];
    public string $responseFormat = 'text';

    public function withController(string $controllerName, $controllerParams = []):self
    {
        $this->controllerName = $controllerName;
        $this->controllerParams = $controllerParams;
        return $this;
    }

    public function withAction(string $actionName, $actionParams = []):self
    {
        $this->actionsList[$actionName] = $actionParams;
        return $this;
    }

    public function withModel(string $modelName, $modelParams = []):self
    {
        $this->modelName = $modelName;
        $this->modelParams = $modelParams;
        return $this;
    }

    public function withView(string $viewName, $viewParams = []):self
    {
        $this->viewName = $viewName;
        $this->viewParams = $viewParams;
        return $this;
    }

    public function responseFormat(string $format):self
    {
        $this->responseFormat = $format;
        return $this;
    }
}