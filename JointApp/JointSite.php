<?php

namespace JointApp;

use JointApp\Factories\ModelFactory;
use JointApp\Views\ErrorsView;
use JointApp\Interfaces\RequestAdapterInterface;
use JointApp\Interfaces\ResponseAdapterInterface;
use JointApp\Router\JointSiteRoute;
use JointApp\Router\JointSiteRouteFinder;
use JointApp\Factories\WebViewFactory;
use JointFramework\Clock\JointSiteClockTrait;
use JointFramework\Logger\JointSiteLogger;
use JointFramework\Logger\JointSiteLoggerFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log;
use JointApp\Interfaces\ViewInterface;
use Psr\Http\Server\RequestHandlerInterface;


class JointSite implements RequestHandlerInterface
{

    use Log\LoggerAwareTrait;

    private $context = 'App';
    private JointAppRequest $request;

    public $langMap;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return $this->Run(self::requestAdapter($request));
    }

    public function Run(ServerRequestInterface $request):ResponseInterface
    {
        session_start();

        global $currentUser;
        $currentUser = new CurrentUser();

        global $jointAppResponse;
        $jointAppResponse = new JointAppResponse();

        $this->request = $request;

        $this->setLogger(JointSiteLoggerFactory::getLoggerContext([$this->context => __CLASS__]));

        $this->logger->logStartTime();

        $this->logger->logStartTime('router');

        $routeFinder = new JointSiteRouteFinder($this->request);
        $JointSiteRoute = $routeFinder->findRoute();

        $jointAppResponse->responseFormat = $JointSiteRoute->responseFormat;

        $this->logger->logEndTime('router');

        //check router errors
        if($jointAppResponse->getStatusCode() == 200){
            $view = $this->execActions($JointSiteRoute);

            //check controller action errors
            if($jointAppResponse->getStatusCode() == 200) {
                if ($JointSiteRoute->responseFormat == 'text') {
                    //check redirect
                    if(!$jointAppResponse->redirect){
                        $jointAppResponse->responseText = $view->getResponseText();
                    }
                }
                //json
                else {
                    $jointAppResponse->responseJson = $view->getResponseJson();
                }
            }

        }
        $this->logger->logEndTime($this->context);
        return $jointAppResponse;
    }

    private function execActions(JointSiteRoute $jointSiteRoute):ViewInterface
    {
        $this->logger->logStartTime('actions');

        $model = ModelFactory::createModelFromRequest($this->request, $jointSiteRoute->modelName, $jointSiteRoute->modelParams);

        $view_tmp = WebViewFactory::createViewFromRequest($this->request, $jointSiteRoute->viewName);

        $controller = new $jointSiteRoute->controllerName($this->request, $model,
            $view_tmp, $jointSiteRoute->controllerParams);

        global $jointAppResponse;

        //check construct errors
        if($jointAppResponse->getStatusCode() == 200) {
            foreach ($jointSiteRoute->actionsList as $actionName => $actionParams) {
                //check actions errors
                if ($jointAppResponse->getStatusCode() == 200) {
                    $controller->$actionName($actionParams);
                }
            }
        }


        $this->logger->logEndTime('actions');

        $newView = $controller->getView();

        $this->updateWebViewParams($newView, $jointSiteRoute->responseFormat);

        return $newView;
    }

    private function updateViewParams($newView, string $responseFormat)
    {
        if(is_subclass_of($newView, 'JointApp\Views\WebView')){
            if($responseFormat != 'json'){
                $nftModel = ModelFactory::createModelFromRequest($this->request, 'JointApp\Models\User\Model_User_Notifications');
                $newView->ntfCount = $nftModel->countRecords((new JointAppQueryBuilder())->where('read_date is null'));
            }
        }
    }

    public static function requestAdapter(ServerRequestInterface $request):ServerRequestInterface
    {

        $jointAppRequest = new JointAppRequest($request->getMethod(), $request->getUri(), [], null, '1.1', $request->getServerParams());
        $jointAppRequest = $jointAppRequest
            ->withQueryParams($request->getQueryParams())
            ->withParsedBody($request->getParsedBody())
            ->withCookieParams($request->getCookieParams());

        return $jointAppRequest;
    }

    public static function handleResponse(JointAppRequest $jointSiteRequest, JointAppResponse $jointAppResponse):void
    {
        $logger = new JointSiteLogger();
        if($jointAppResponse->getStatusCode() != 200){

            http_response_code($jointAppResponse->getStatusCode());

            if($jointAppResponse->responseFormat == 'text'){
                self::displayErr($jointSiteRequest);
            }else{
                header('Content-type: application/json; charset=utf-8');
                echo json_encode(array('result' =>false,
                    'log' => $jointAppResponse->getStatusCode().':'.$jointAppResponse->getReasonPhrase(),
                    'timestamp' => array('now' => date('Y-m-d H:i:s'),
                        'runTime:'=> $logger->calcRunTime())));
            }
        }else{
            if($jointAppResponse->redirect){
                header('Location: '.$jointAppResponse->redirect[0]);
            }elseif($jointAppResponse->responseFormat == 'text'){
                echo $jointAppResponse->responseText;
            }elseif($jointAppResponse->responseFormat == 'json'){
                header('Content-type: application/json; charset=utf-8');
                echo json_encode(
                    array(
                        'result' => true,
                        'viewData' => $jointAppResponse->responseJson,
                        'timeStamp' => array(
                            'now' => date('Y-m-d H:i:s'),
                            'runTime' => $logger->calcRunTime(),
                        )
                    )
                );
            }
        }
    }

    public static function displayErr(JointAppRequest $request)
    {
        global $jointAppResponse, $currentUser;

        $view = WebViewFactory::createViewFromRequest($request, 'JointApp\Views\ErrorsView');
        if($jointAppResponse->getStatusCode() == 403){
            $view->modalMenuActive = true;
        }
        echo $view->getResponseText();
    }
}