<?php

namespace JointApp\Controllers;

use JointApp\Interfaces\ViewInterface;
use JointApp\JointAppRequest;
use JointFramework\Logger\JointSiteLoggerFactory;
use JointApp\Interfaces\ControllerInterface;
use Psr\Log;

class Controller implements ControllerInterface
{
    use Log\LoggerAwareTrait;

    protected $requestParams = [];
    protected $model;
    protected $view;
    protected $langMap;

    protected $context = 'Controller';

    private $request;

    protected $actionName = '';


    /*controllerRequestAdapter-------------------------------------------*/
    protected string $docRoot = '';
    protected string $langNs = '';
    private string $configDir = '';
    protected string $langLw = '';
    protected string $langRef = '';
    protected string $langSl = '';
    protected $routes_ns = [];
    protected string $langDir = '';
    protected $routes = [];

    protected string $httpRef = '';

    /*controllerFilterParams---------------------------------------------*/

    /*controllerFilterBody or controllerFilterQuery----------------------*/

    /*loadLangController from lang files---------------------------------*/
    //public $langMap;

    function __construct(JointAppRequest $request, $model, $view, $controllerParams = [])
    {
        $this->request = $request;

        $this->setLogger(JointSiteLoggerFactory::getLoggerContext([$this->context => get_class($this)]));

        $this->model = $model;

        $this->docRoot = $request->docRoot;
        $this->langNs = $request->langNs;
        $langName = $this->loadLangController();
        $this->langMap = new $langName;

        $this->langLw = $request->langLw;
        $this->langSl = $request->langSl;
        $this->routes = $request->routes;
        $this->routes_ns = $request->routes_ns;
        $this->configDir = $request->configDir;

        if(isset($request->getServerParams()['HTTP_REFERER'])){
            $this->httpRef = $request->getServerParams()['HTTP_REFERER'];
        }

        $this->controllerFilterParams($controllerParams);

        if($request->getMethod() == 'POST'){
            $this->requestParams = $request->getParsedBody();
            $this->controllerFilterBody($request->getParsedBody());
        }else{
            $this->requestParams = $request->getQueryParams();
            $this->controllerFilterQuery($request->getQueryParams());
        }

        if(!$this->checkAccessController()){
            $this->logger->warning('check-access-controller __construct return false', $this->logger->logger_context);
        }

        $this->view = $this->checkViewInstance($view);
    }

    public function checkAccessController():bool
    {
        return true;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getConfigDir()
    {
        return $this->configDir;
    }

    public function loadLangController():string
    {

        $name = 'LangFiles_'.$this->langNs.'_Controller';
        require_once $this->docRoot.'/JointApp/LangFiles/Controllers/'.$name.'.php';
        return $name;
    }

    public function controllerFilterParams($controllerParams = []):void
    {
        if(isset($controllerParams['actionName'])){
            $this->actionName = $controllerParams['actionName'];
        }
    }

    public function controllerFilterBody($bodyParams = []):void
    {

    }

    public function controllerFilterQuery($queryParams = []):void
    {

    }

    public function actionIndex()
    {

    }

    public function checkViewInstance(ViewInterface $view):ViewInterface
    {
        return $view;
    }

    public function getView()
    {
        return $this->view;
    }
}