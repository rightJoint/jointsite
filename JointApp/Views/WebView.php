<?php


namespace JointApp\Views;


use JointApp\ModulesAccessList;
use JointApp\Interfaces\LangWebViewInterface;
use JointApp\Interfaces\WebViewInterface;
use JointApp\Views\WebForms\ModalAuthForms;
use JointFramework\Logger\JointSiteLoggerFactory;
use Psr\Log\LoggerAwareTrait;

class WebView extends View implements WebViewInterface
{
    use LoggerAwareTrait;

    //**************CONSTRUCT PARAMS*********************************/
    //need to require lang files
    public $docRoot = '';
    //calc on $viewlang
    public string $langNs = 'Ru';
    public string $langLw = 'ru';
    public string $langSl = '/ru';

    //**************ViewFactory PARAMS********************************/
    //from JointAppRequest
    //ref to change language
    public string $langRef = '/';
    //routes to highlight ref is active
    public array $routes_ns = array('', '');

    //**************PARTS OF HTML PAGE********************************/
    private string $pageHead = '';
    private string $pageHeader = '';
    protected string $pageContent = '';
    public string $pageContentBefore = '';
    public string $pageContentAfter = '';
    private string $pageFooter = '';
    private string $pageModal = '';

    //**************HEAD LINKS****************************************/
    //add <meta name="robots" content="noindex">
    public $robotNoIndex = false;
    //add SHORTCUT ICON image
    public string $shortcutIcon = '/img/siteLogo/favicon.png';


    //**************HEADER OPTION*************************************/
    //display logo on header
    protected string $logo = '/img/popimg/menu-icon.png';

    //**************MODAL MENU OPTION**********************************/
    //activate modal menu on display page
    public $modalMenuActive = false;


    //**************RESPONSE TEXT RESULT******************************/
    private string $responseText = '';

    private string $context = 'WebView';


    //AUTH
    public string $switchForm = 'signIn';
    //signIn form
    public string $signInLogin = '';
    public string $signInPassword = '';
    public bool $signInErrLogin = false;
    public bool $signInErrPass = false;
    public bool $signInErrNotFound = false;
    public bool $signInErrEMailValid = false;
    public bool $signInErrBlackList = false;
    public bool $signInErrWrongPass = false;
    //signUn form
    public string $signUpLogin = '';
    public string $signUpPassword = '';
    public string $signUpPasswordRepeat = '';
    public string $signUpEMail = '';
    public bool $signUpErrPassMatch = false;
    public bool $signUpErrPassAccept = false;
    public bool $signUpErrLoginAccept = false;
    public bool $signUpErrLoginReserved = false;
    public bool $signUpErrEMailAccept = false;

    //calc view runTime in tests
    public int $firstEvent = 0;
    public int $lastEvent = 0;



    function __construct(string $docRoot, string $viewlang = '')
    {
        $this->setLogger(JointSiteLoggerFactory::getLoggerContext([$this->context => get_class($this)]));

        $this->docRoot = $docRoot;

        //lang params
        if(!empty($viewlang)){
            $this->langNs = ucfirst(strtolower($viewlang));
            $this->langLw = strtolower($viewlang);
            $this->langSl = '/'.strtolower($viewlang);
        }
        //default lang "ru"
        else{
            $this->langNs = 'Ru';
            $this->langLw = 'ru';
            $this->langSl = '';
        }
    }

    //rewrite parent View method
    public function getResponseText():string
    {
        $this->createResponseText();
        return $this->responseText;
    }

    public static function loadLangView(string $docRoot = __DIR__, string $viewLang = 'ru', $loads = []):LangWebViewInterface
    {
        $name = 'LangFiles_'.self::langNs($viewLang).'_Views_WebView';
        $loads[] = [$name => $docRoot.'/JointApp/LangFiles/Views/'.$name];

        $reverse = array_reverse($loads);

        $createName = $name;

        foreach ($reverse  as $n => $ns){
            $createName = key($ns);
            require_once $ns[$createName].'.php';
        }

        return new $createName;
    }

    public static function langNs(string $viewLang = 'ru'):string
    {
        if(!empty($viewLang)){
            return ucfirst(strtolower($viewLang));
        }
        //default lang "ru"
        else{
            return 'Ru';
        }
    }

    public function langHeadUpdate(callable $updateFromArray):void
    {

    }

    public function langHeaderUpdate(callable $updateFromArray)
    {

    }

    public static function addMetaLinks():array
    {

    }

    public static function addStyleLinks(callable $addStyleLinks):void
    {

    }

    public static function addScriptLinks(callable $addScriptLinks):void
    {

    }

    public function addViewParams(callable $addViewParams)
    {
        $viewParams = new \stdClass();
        $viewParams->routes_ns = $this->routes_ns;
        $viewParams->modalMenuActive = $this->modalMenuActive;
        $viewParams->langRef = $this->langRef;
        $viewParams->langSl = $this->langSl;
        $viewParams->userModules = ModulesAccessList::getUserModules();

        $authForms = new \stdClass();

        $signInForm = new \stdClass();

        $signInFVals = new \stdClass();
        $signInFVals->signInLogin = $this->signInLogin;
        $signInFVals->signInPassword = $this->signInPassword;
        $signInForm->fVals = $signInFVals;

        $signInErr = new \stdClass();
        $signInErr->signInErrLogin = $this->signInErrLogin;
        $signInErr->signInPassword = $this->signInErrPass;
        $signInErr->signInErrNotFound = $this->signInErrNotFound;
        $signInErr->signInErrEMailValid = $this->signInErrEMailValid;
        $signInErr->signInErrBlackList = $this->signInErrBlackList;
        $signInErr->signInErrWrongPass = $this->signInErrWrongPass;
        $signInForm->err = $signInErr;

        $authForms->signInForm = $signInForm;

        $signUpForm = new \stdClass();

        $signUpFVals = new \stdClass();
        $signUpFVals->signUpLogin = $this->signUpLogin;
        $signUpFVals->signUpPassword = $this->signUpPassword;
        $signUpFVals->signUpPasswordRepeat = $this->signUpPasswordRepeat;
        $signUpFVals->signUpEMail = $this->signUpEMail;
        $signUpForm->fVals = $signUpFVals;

        $signUpErr = new \stdClass();
        $signUpErr->signUpErrPassMatch = $this->signUpErrPassMatch;
        $signUpErr->signUpErrPassAccept = $this->signUpErrPassAccept;
        $signUpErr->signUpErrLoginAccept = $this->signUpErrLoginAccept;
        $signUpErr->signUpErrLoginReserved = $this->signUpErrLoginReserved;
        $signUpErr->signUpErrEMailAccept = $this->signUpErrEMailAccept;
        $signUpForm->err = $signUpErr;

        $authForms->signUpForm = $signUpForm;

        $authForms->switchForm = $this->switchForm;

        $viewParams->authForms = $authForms;

        $addViewParams($viewParams);
    }

    public static function createPageContent(\stdClass $langPageContent, \stdClass $viewParams):string
    {
        return $langPageContent->pageContent;
    }

    public function putPageContentBefore(string $beforeText):void
    {
        $this->pageContentBefore = $beforeText;
    }

    public function putPageContentAfter(string $afterText):void
    {
        $this->pageContentAfter = $afterText;
    }

    public static function createModalContent(\stdClass $langModal, \stdClass $viewParams):string
    {

        return 'createModalContent - put content';
    }

    private static function modalMenuSiteman(\stdClass $modulesMenu, $userModules = [], string $langSl = '', $routes_ns = ['', '']):string
    {
        if(count($userModules) == 0){
            return '';
        }

        foreach ($modulesMenu->menuItems as $mN => $mOpt){
            if(in_array($mN, $userModules) and $modulesMenu->menuItems[$mN]['usage'] == true){
                $modulesMenu->menuItems[$mN]['usage'] = true;
            }else{
                $modulesMenu->menuItems[$mN]['usage'] = false;
            }
        }

        $menuStyle = 'style="display: none"';
        $foldedStyle = 'folded';

        $menuItemsTxt = static::printMenuItems($modulesMenu->menuItems, '/siteman', $langSl, $routes_ns);

        if ($menuItemsTxt['is_valid_path']) {
            $menuStyle = null;
            $foldedStyle = null;
        }

        $returnMenu = '<div class="modal-line prod">'.
            '<div class="modal-line-img"><img src="/img/popimg/module-logo.png"></div>' .
            '<div class="modal-line-text"><a class="m-l-blue" href="'.$langSl.'/siteman" '.
            'title="'.$modulesMenu->menuLine['refTitle'].'">'.
            $modulesMenu->menuLine['refText'].'</a><sup>'.
            $modulesMenu->menuLine['supText'].'</sup>'.
            '<span class="opnSubMenu '.$foldedStyle.'">'.$modulesMenu->menuLine['dropText'].'</span>'.
            '<ul '.$menuStyle.'>'.
            $menuItemsTxt['text'].
            '</ul>'.
            '</div>'.
            '</div>';
        return $returnMenu;
    }

    public static function printMenuItems(array $itemsList,
                                          $disp_url = null,
                                          string $langSl = '',
                                          $routes_ns = ['', '']):array
    {
        $disp_url_ref = $langSl.$disp_url;
        $disp_url_exp = explode('/', $disp_url);
        $disp_url_count = count($disp_url_exp);

        $return = array(
            'is_valid_path' => false,
            'text' => null,
        );

        foreach ($disp_url_exp as $n => $disp_path ){
            if(isset($routes_ns[$n]) and $disp_path == $routes_ns[$n]){
                $return['is_valid_path'] = true;
            }else{
                $return['is_valid_path'] = false;
            }
        }

        foreach ($itemsList as $url_item => $item_info){
            if(isset($item_info['usage']) and $item_info['usage'] == true){
                $return['text'] .= '<li><a href="'.$disp_url_ref.'/'.$url_item.'" class="sub-lnk light ';
                if (isset($routes_ns[$disp_url_count]) and
                    (($routes_ns[$disp_url_count] ==  $url_item) and $return['is_valid_path'])) {
                    $return['text'] .= 'active';
                }
                $return['text'].= '" title="'.$item_info['refTitle'].'">'.$item_info['refText'].'</a></li>';
            }
        }
        return $return;
    }

    //create responseText
    public function createResponseText():void
    {
        $this->firstEvent = $this->logger->logStartTime();

        $this->composePage();

        $this->responseText = '<!DOCTYPE html>'.
            '<html lang="'.$this->langLw.'">'.
            $this->pageHead.
            '<body>'.
            '<div class="page-wrap">'.
            $this->pageHeader.
            $this->pageContentBefore.
            $this->pageContent.
            $this->pageContentAfter.
            $this->pageFooter.
            '</div>'.
            $this->pageModal.
            '</body>'.
            '</html>';
        $this->lastEvent = $this->logger->logEndTime();

        $this->responseText .= $this->printMkt();
    }

    private function composePage():void
    {
        $langMap = static::loadLangView($this->docRoot, $this->langLw);

        $langHead = $langMap::getLangHead();


        $this->langHeadUpdate($langHead->updateFromArray);
        $this->pageHead = self::printHead($langHead, $this->robotNoIndex, $this->shortcutIcon);


        $langHeader = $langMap::getLangHeader();
        $this->langHeaderUpdate($langHeader->updateFromArray);

        $this->pageHeader = $this->printHeader($langHeader, $this->langRef, $this->routes_ns, $this->logo);

        //display errors
        $this->pageHeader.=$this->displayErrorsLevels(['info', 'debug', 'notice']);

        $viewParams = new \stdClass();

        $addViewParams = function (\stdClass $addViewParams) use (&$viewParams){
            foreach ($addViewParams as $name => $val){
                $viewParams->$name = $val;
            }
        };

        $this->addViewParams($addViewParams);

        $this->pageContent .= $this->createPageContent($langMap::getLangPageContent(), $viewParams);
        $this->pageFooter = self::printFooter($langMap::getLangFooter());

        $this->pageModal = $this->printModal($langMap::getLangModal(), $viewParams);
    }

    private static function printHead(\stdClass $langHead, bool $robotNoIndex = false, string $shortcutIcon = '/img/siteLogo/favicon.png'):string
    {
        //add Meta, Styles, Scripts
        $styleLinks = array(
            '/css/default.css',
            '/css/header.css',
            '/css/errors.css',
        );

        $addStyleLinks = function ($array = []) use (&$styleLinks){
            $styleLinks = array_merge($styleLinks, $array);
        };

        static::addStyleLinks($addStyleLinks);

        $scriptLinks = array(
            '/lib/js/googleapis.js',
            '/js/header.js',
        );

        $addScriptLinks = function ($array = []) use (&$scriptLinks){
            $scriptLinks = array_merge($scriptLinks, $array);
        };

        static::addScriptLinks($addScriptLinks);

        $metaLinks = [];



        $headText = '<head>'.
            '<meta http-equiv="content-type" content="text/html"; charset="utf-8"/>'.
            '<meta name="viewport" content="width=device-width, initial-scale=1.0">'.
            '<meta name="description" content="'.$langHead->description.'"/>';
        if ($robotNoIndex) {
            $headText.= '<meta name="robots" content="noindex">';
        }
        foreach ($metaLinks as $name => $content){
            $headText .= '<meta name="'.$name.'" content="'.$content.'">';
        }
        $headText.= '<title>'.$langHead->title.'</title>'.
            '<link rel="SHORTCUT ICON" href="'.$shortcutIcon.'" type="image/png">';
        foreach ($styleLinks as $style) {
            $headText.= '<link rel="stylesheet" href="'.$style.'" type="text/css" media="screen, projection"/>';
        }
        foreach ($scriptLinks as $script) {
            $headText.= '<script src="'.$script.'"></script>';
        }
        $headText.= '</head>';

        return $headText;
    }

    //used in views do display included 200 status codes: DEBUG, NOTICE, INFO
    protected static function displayErrorsLevels($levels=[]):string
    {
        global $jointAppResponse;

        $return = '';

        if(isset($jointAppResponse->customLog)){
            if(count($jointAppResponse->customLog)){
                foreach ($jointAppResponse->customLog as $num=>$errInfo){
                    $level = key($errInfo);
                    $logText='<div class="logger-errors '.$level.'">'.
                        $level.' --> '.$errInfo[$level].'<br></div>';
                    if(count($levels)){
                        if(in_array($level, $levels)){
                            $return.=$logText;
                        }
                    }else{
                        $return.=$logText;
                    }
                }
            }
        }

        return $return;
    }

    private static function printHeader(\stdClass $langHeader,
                                        string $langRef = '',
                                        $routes_ns = ['', ''],
                                        string $logo = '/img/popimg/menu-icon.png'
    ):string
    {
        $headerText= '<header><div class="headerCenter">';
        $headerText.= '<div class="lang-panel">'.
            '<a class="lang-cntrl ';
        if ($langHeader->langLw == 'ru') {
            $headerText.= 'active ';
        }
        $headerText.= 'rus" href="/ru'.$langRef.'" title="'.$langHeader->langPanelTextRus.'"><span>Рус</span></a>'.
            '<a class="lang-cntrl ';
        if ($langHeader->langLw == 'en') {
            $headerText.= 'active ';
        }
        $headerText.= 'en" href="/en'.$langRef.'" title="'.$langHeader->langPanelTextEn.'"><span>En</span></a>'.
            '</div>';
        $headerText.= '<div class="menuBtn hi-icon-effect-1 hi-icon-effect-1a">'.
            '<span class="hi-icon hi-icon-mobile menu"><span class="hi-text">'.
            $langHeader->menuBtnText.
            '</span></span></div>'.
            '<div class="h-caption">'.
            '<div class="textBlock ';

        if (empty($routes_ns[1])) {
            $headerText.= 'landing';
        }
        $headerText.= '"><span class="firmName">'.$langHeader->firmName.'</span>'.
            '<h1>'.$langHeader->h1.'</h1></div></div>'.
            '</div></header>';
        $header_add_styles = '<style>
        .hi-icon-mobile.menu:before {background-image: url('.$logo.');}
        .modal-right .modal-close{
                background-image: url("/img/popimg/closeModal.png");
            }
            @media only screen and (max-width : 1024px) and (orientation : portrait){
            .modal-right:not(.signIn) .modal-close:not(.signIn){
                    background-image: url("/img/popimg/closeModal-white.png");
            }
            }                      
            </style>';

        $headerText.= $header_add_styles;
        return $headerText;
    }

    private static function printFooter(\stdClass $langFooter):string
    {
        $pageFooter = '<div class="contentBlock-frame dark ft"><div class="contentBlock-center">'.
            '<div class="contentBlock-wrap">'.
            '<footer>'.
            '<div class="ft-service">';
        /*
        if ($this->metrik_block) {
            $pageFooter.= $this->metrika;
        }
        */
        $pageFooter.= '</div><div class="ft-center"><hr><span>by Right Joint</span></div>'.
            '<div class="ft-right">'.
            '</div>'.
            '</footer>'.
            '</div></div></div>';
        return $pageFooter;
    }

    private static function printModal( \stdClass $langModal, \stdClass $viewParams):string
    {
        $active_modal_menu_style = null;

        if ($viewParams->modalMenuActive) {
            $active_modal_menu_style = 'style="opacity: 1; visibility: visible"';
        }

        $pageModals = '<div class="modal menu" '.$active_modal_menu_style.'>'.
            '<div class="overlay" '.$active_modal_menu_style.'></div><div class="contentBlock-frame">'.
            '<div class="contentBlock-center"><div class="modal-right"><div class="modal-close"></div>'.
            '</div><div class="modal-left">'.
            '<div class="modal-line" style="position: relative; min-height: 3.8em" >'.
            '<div class="lang-panel mp">'.
            '<a class="lang-cntrl ';
        if ($langModal->langLw == 'ru') {
            $pageModals.= 'active ';
        }
        $pageModals.= 'rus" href="/ru'.$viewParams->langRef.'" title="'.$langModal->langPanelTextRus.'"><span>Рус</span></a>'.
            '<a class="lang-cntrl ';
        if ($langModal->langLw == 'en') {
            $pageModals.= 'active ';
        }
        $pageModals.= 'en" href="/en'.$viewParams->langRef.'" title="'.$langModal->langPanelTextEn.'"><span>En</span></a>'.
            '</div>'.
            '<div class="mm-htl">';
        $mainPage_ref = '/';
        if($viewParams->langSl){
            $mainPage_ref = $viewParams->langSl;
        }
        $pageModals.= '<a href="'.$mainPage_ref.'" title="';

        if (empty($routes_ns[1])) {
            $pageModals.= $langModal->homeRefDefTitle;
        } else {
            $pageModals.= $langModal->homeRefTile;
        }
        $pageModals.= '">'.
            '<img src="/img/siteLogo/rightjoint-logo-150.png" alt="RJ-logo">' .
            $langModal->homeRefText.
            '</a>'.
            '<p>'.$langModal->homeRefTile.'</p>'.
            '</div>'.
            '</div>';

        $pageModals.= self::modalMenuSiteman($langModal->modulesMenu, $viewParams->userModules, $viewParams->langSl = '', $viewParams->routes_ns).
            static::createModalContent($langModal, $viewParams).
            self::modalSignPanel($langModal->modalSignUser, $langModal->authForms, $viewParams->authForms);

        $pageModals.= '</div></div></div></div>';
        return $pageModals;
    }

    private function printMkt():string
    {
        return '<script>$("body").after("<span style=\'color: silver; position: relative; bottom: 1.2em; left: 0,5em; '.
            ' display: block; height:0; width:0; font-size:0.7em;\'>'.$this->logger->calcRuntime().'</span>")</script>';
    }

    public function getViewTime()
    {
        return $this->logger->calcRuntime($this->firstEvent-1, $this->lastEvent-1);
    }

    public static function modalSignPanel(\stdClass $modalSignUser , \stdClass $langAuthForms, \stdClass $paramsAuthForm):string
    {
        global $currentUser;

        if(!empty($currentUser->user_id)){
            $user = '<div class="modal-line">'.
                '<div class="modal-line-img"><img src="';
            if(!empty($currentUser->photoLink)){
                $user.= '/'.$currentUser->photoLink;
            }else{
                $user.= '/img/popimg/avatar-default.png';
            }
            $user_link_add_class = null;
            $user_link_ref = '/user';
            //if ($this->controller_action == 'user') {
            $user_link_add_class = ' decnone';
            $user_link_ref = '#';
            //}

            $user.= '"></div>'.
                '<div class="modal-line-text"><a class="m-l-blue'.$user_link_add_class.'" href="'.$user_link_ref . '" '.
                'title="'.$modalSignUser->title.'">'.
                $modalSignUser->siteUser.':</a>'.
                $currentUser->accAlias.'<sup><a href="/user/cmd?exit=userquit">'.
                $modalSignUser->exit.'</a></sup></div>'.
                '</div>';
            return $user;
        }else{
            $modalAuthForms = new ModalAuthForms($langAuthForms, $paramsAuthForm);
            return $modalAuthForms->printAuthForms();
        }
    }
}