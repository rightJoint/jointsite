<?php


namespace JointApp;


use JointApp\Interfaces\RequestAdapterInterface;
use JointFramework\Http\ServerRequest;
use Psr\Http\Message\ServerRequestInterface;

class JointAppRequest extends ServerRequest
{
    //dir from require files DOCUMENT_ROOT
    public $docRoot = '';

    public string $uri_r = '';
    //  public string $method = 'GET';
    //request $_GET, $_POST, etc
    // public $reqParams = [];
    public $routes = [];

    //lang params:
    //acceptable lang
    private $acceptableLangs = ['en', 'ru',];
    //defined page lang
    public string $viewLang = '';
    //wildcard for namespaces
    public string $langNs = '';
    //wildcard for lang_arrays
    public string $langLw = '';
    //wildcard for hrefs contains slash
    public string $langSl = '';
    //wildcard for hrefs parts after lang
    public string $langRef = '';
    //faced in view head meta rel page of default lang
    public string $langDefault = 'ru';
    //canonical
    public bool $langCanonical = false;
    //routes_ns is logic part of request
    public $routes_ns = [];

    //from .env
    //
    public string $configDir = '';
    //
    public string $usersDir = '';
    //site name
    public string $siteName = '';

    function __construct(string $method, $uri, array $headers = [], $body = null, string $version = '1.1', array $serverParams = [])
    {
        parent::__construct($method, $uri, $headers, $body, $version, $serverParams);
        $this->prepareRequest();
    }

    private function prepareRequest()
    {
        $this->docRoot = $this->getServerParams()['DOCUMENT_ROOT'];
        $uri_r = $this->getUri();
        $this->uri_r = $uri_r->getPath();
        if($query = $uri_r->getQuery()){
            $this->uri_r.='?'.$query;
        }
        $this->routes = explode('/', $uri_r->getPath());

        $this->langDetector();

        $this->fromEnv();
    }

    public function langDetector()
    {
        $this->routes_ns = $this->routes;
        if(isset($this->routes[1]) and in_array(strtolower($this->routes[1]), $this->acceptableLangs)){

            $this->langNs = ucfirst($this->routes[1]);
            $this->langLw = strtolower($this->routes[1]);
            $this->viewLang = $this->langLw;
            $this->langSl = '/'.strtolower($this->routes[1]);
            $pos_lang = strpos($this->uri_r, $this->langSl);
            $this->langRef = substr($this->uri_r, $pos_lang + strlen($this->langSl),
                strlen($this->uri_r));
            array_splice($this->routes_ns, 1,1);

            if($this->langLw == $this->langDefault){
                $this->langCanonical = true;
            }
        }else{
            //default lang: ru
            $this->viewLang = '';
            $this->langNs = ucfirst($this->langDefault);
            $this->langLw = $this->langDefault;
            $this->langSl = '';
            $this->langRef = $this->uri_r;
        }
    }

    function fromEnv()
    {
        $env = parse_ini_file('.env');
        $this->configDir = $this->docRoot.'/'.$env['JOINT_SITE_CONFIG_DIR'];
        $this->usersDir = $this->docRoot.'/'.$env['JOINT_SITE_USERS_DIR'];
        $this->siteName = $env['JOINT_SITE_NAME'];
    }
}