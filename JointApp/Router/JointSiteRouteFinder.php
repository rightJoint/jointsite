<?php


namespace JointApp\Router;


use JointFramework\Logger\JointSiteLoggerFactory;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerAwareTrait;
use Src\RoutesCollection\Blog\RoutesCollection_Blog;
use Src\RoutesCollection\RoutesCollection_Applications;
use Src\RoutesCollection\RoutesCollection_Basket;
use Src\RoutesCollection\RoutesCollection_Cv;
use Src\RoutesCollection\RoutesCollection_JointSite;
use Src\RoutesCollection\RoutesCollection_Api;
use Src\RoutesCollection\RoutesCollection_Main;
use Src\RoutesCollection\RoutesCollection_Music;
use Src\RoutesCollection\RoutesCollection_Products;
use Src\RoutesCollection\RoutesCollection_Siteman;
use Src\RoutesCollection\RoutesCollection_Test;
use JointApp\Router\RoutesCollection\RoutesCollection_User;

class JointSiteRouteFinder
{
    use LoggerAwareTrait;

    use RoutesCollection_JointSite;
    use RoutesCollection_Main;
    use RoutesCollection_Test;
    use RoutesCollection_Api;
    use RoutesCollection_Siteman;
    use RoutesCollection_User;
    use RoutesCollection_Music;
    use RoutesCollection_Basket;
    use RoutesCollection_Applications;
    use RoutesCollection_Blog;
    use RoutesCollection_Products;
    use RoutesCollection_Cv;

    private $context = 'RouteFinder';

    public string $method;
    public $routes_ns = [];


    function __construct(ServerRequestInterface $request)
    {
        $this->setLogger(JointSiteLoggerFactory::getLoggerContext([$this->context => __CLASS__]));
        $this->routeFromRequest($request);
    }

    public function routeFromRequest(ServerRequestInterface $request)
    {
        $this->method = $request->getMethod();
        $this->routes_ns = $request->routes_ns;
    }

    function findRoute():JointSiteRoute
    {
        $routeName = 'Main';

        if(!empty($this->routes_ns[1])){
            $tmp_name_arr = explode('-', $this->routes_ns[1]);
            $routeName = null;
            foreach ($tmp_name_arr as $num=>$key){
                $routeName .= ucfirst($key);
            }
        }

        $getRoute = strtolower($this->method).'Route_'.$routeName;

        if(method_exists('JointApp\Router\JointSiteRouteFinder', $getRoute)){
            if($returnRoute = call_user_func('JointApp\Router\JointSiteRouteFinder::'.$getRoute, $this->routes_ns)){
                if(!empty($returnRoute->controllerName) and class_exists($returnRoute->controllerName)){
                    if(!empty($returnRoute->modelName) and class_exists($returnRoute->modelName)){
                        if(!empty($returnRoute->viewName) and class_exists($returnRoute->viewName)){
                            foreach ($returnRoute->actionsList as $aName=>$aData){
                                if(!method_exists($returnRoute->controllerName, $aName)){
                                    $this->logger->error('JointSiteRouteFinder::'.$getRoute.' action \''.$aName.'\' not found', $this->logger->logger_context);
                                }
                            }
                            return $returnRoute;
                        }else{
                            $this->logger->error('JointSiteRouteFinder::'.$getRoute.' view '.$returnRoute->viewName.' not found', $this->logger->logger_context);
                        }
                    }else{
                        $this->logger->error('JointSiteRouteFinder::'.$getRoute.' model not found', $this->logger->logger_context);
                    }
                }else{
                    $this->logger->error('JointSiteRouteFinder::'.$getRoute.' controller "'.$returnRoute->controllerName.'" not found', $this->logger->logger_context);
                }
                return $returnRoute;
            }else{
                $this->logger->error('JointSiteRouteFinder::'.$getRoute.' route not found', $this->logger->logger_context);
                return new JointSiteRoute();
            }
        }else{
            $this->logger->error('JointSiteRouteFinder::'.$getRoute.' method not exist', $this->logger->logger_context);
            return new JointSiteRoute();
        }
    }
}