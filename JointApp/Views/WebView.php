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
    const USER_AVATARS_DIR = '/userdata/avatars';
    use LoggerAwareTrait;

    //**************ViewFactory PARAMS*********************************/
    //from JointAppRequest
    //need to require lang files
    public $docRoot = '';
    //calc on $viewlang
    public string $langNs = 'Ru';
    public string $langLw = 'ru';
    public string $langSl = '/ru';
    //ref to change language
    public string $langRef = '/';
    //routes to highlight ref is active
    public array $routes_ns = array('', '');
    //used in head canonical rel
    public string $siteName = '';
    //flag canonical rel
    public bool $langCanonical = false;

    //**************PARTS OF HTML PAGE********************************/
    private string $pageHead = '';
    private string $pageHeader = '';
    protected string $pageContent = '';
    public string $pageContentBefore = '';
    public string $pageContentAfter = '';
    private string $pageFooter = '';
    private string $pageModal = '';
    private string $pageOrder = '';

    public $basket = [];

    //**************HEAD LINKS****************************************/
    //add <meta name="robots" content="noindex">
    public bool $robotNoIndex = false;
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

    //new user notifications
    //modal-menu
    public int $ntfCount = 0;



    function __construct()
    {
        $this->setLogger(JointSiteLoggerFactory::getLoggerContext([$this->context => get_class($this)]));
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
        $viewParams->ntfCount = $this->ntfCount;
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

        $viewParams->basket = $this->basket;

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
            $this->pageOrder.
            '</body>'.
            '</html>';
        $this->lastEvent = $this->logger->logEndTime();

        $this->responseText .= $this->printMkt();
    }

    private function composePage():void
    {
        $langMap = static::loadLangView($this->docRoot, $this->langLw);

        $langHead = $langMap::getLangHead();

        $headParams = new \stdClass();
        $headParams->langRef = $this->langRef;
        $headParams->langLw = $this->langLw;
        $headParams->langSl = $this->langSl;
        $headParams->siteName = $this->siteName;
        $headParams->langCanonical = $this->langCanonical;
        $headParams->shortcutIcon = $this->shortcutIcon;
        $headParams->robotNoIndex = $this->robotNoIndex;

        $this->langHeadUpdate($langHead->updateFromArray);
        $this->pageHead = self::printHead($langHead, $headParams);


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
        $this->pageFooter = self::printFooter($langMap::getLangFooter(), $this->robotNoIndex);

        $this->pageModal = $this->printModal($langMap::getLangModal(), $viewParams);

        $this->pageOrder = $this->printOrder($langMap::getLangOrder(), $viewParams->basket);
    }

    private static function printHead(\stdClass $langHead, \stdClass $headParams):string
    {
        //add Meta, Styles, Scripts
        $styleLinks = array(
            '/css/default.css',
            '/css/header.css',
            '/css/header/modal-menu.css',
            '/css/site-footer.css',
            '/css/errors.css',
        );

        $addStyleLinks = function ($array = []) use (&$styleLinks){
            $styleLinks = array_merge($styleLinks, $array);
        };

        static::addStyleLinks($addStyleLinks);

        $scriptLinks = array(
            '/lib/js/googleapis.js',
            '/js/header.js',
            '/js/landing/landing-basket.js',
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
        if ($headParams->robotNoIndex) {
            $headText.= '<meta name="robots" content="noindex">';
        }else{
            //yandex metrika
            $headText.='<meta name="yandex-verification" content="xxx" />';

            //seo link canonical
            if($headParams->langCanonical){
                $headText .='<link rel="canonical" href="'.$headParams->siteName.$headParams->langRef.'" />';
            }

        }
        foreach ($metaLinks as $name => $content){
            $headText .= '<meta name="'.$name.'" content="'.$content.'">';
        }
        $headText.= '<title>'.$langHead->title.'</title>'.
            '<link rel="SHORTCUT ICON" href="'.$headParams->shortcutIcon.'" type="image/png">';
        foreach ($styleLinks as $style) {
            $headText.= '<link rel="stylesheet" href="'.$style.'" type="text/css" media="screen, projection"/>';
        }
        $headText.= '<script>'.
            'var jointAppLangSl="'.$headParams->langSl.'";'.
            '</script>';
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
            '<h1>'.$langHeader->h1.'</h1></div></div>';
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

        $headerText.= '<div class="orderBtn hi-icon-effect-1 hi-icon-effect-1a">'.
            '<span class="hi-icon hi-icon-mobile order ';
        if(isset($_SESSION['basket']['total']) and $_SESSION['basket']['total']>0){
            $headerText.= 'buy';
        }
        $headerText.= '"><span class="hi-text">'.
            $langHeader->orderBtnText.
            '</span></span>'.
            '</div>';

        $header_order_styles = '<style>    
            .hi-icon-mobile.order:before {
    background-image: url("/img/Services/order.png");
    z-index: 3;
    position: relative;
}
.hi-icon-mobile.order.buy:before {
    background-image: url("/img/Services/money.png");
}                
            </style>';

        $headerText.='</div></header>'.$header_order_styles;
        return $headerText;
    }

    private static function printFooter(\stdClass $langFooter, bool $robotNoIndex = true):string
    {
        global $currentUser;

        $authFlag = false;
        if(empty($currentUser->user_id)){
            $authFlag = true;
        }


        $pageFooter = '<div class="contentBlock-frame dark ft"><div class="contentBlock-center">'.
            '<div class="contentBlock-wrap">'.
            '<footer>'.
            '<div class="ft-service">';

        //no-index-image
        if($robotNoIndex){
            $pageFooter.='<img src="/img/popimg/no-index.png" style="height: 2em; width: auto; border:0; max-height: 31px; max-width: 88px;" '.
                'alt="'.$langFooter->metricBlock->noIndex->alt.'" title="'.$langFooter->metricBlock->noIndex->title.'"/>';
        }
        //metrika
        else{
            //$pageFooter.='<img src="/img/y_metrika.png" style="height: 2em; width: auto; border:0; max-height: 31px; max-width: 88px;" '.
            //    'alt="'.$langFooter->metricBlock->metrika->alt.'" title="'.$langFooter->metricBlock->metrika->title.'" '.
            //    'class="ym-advanced-informer" data-cid="44136454" data-lang="'.$langFooter->langLw.'" />';
            $pageFooter.= '<a href="https://metrika.yandex.ru/stat/?id=44136454&amp;from=informer" target="_blank" rel="nofollow">'.
                '<img src="https://informer.yandex.ru/informer/44136454/3_1_FFFFFFFF_EFEFEFFF_0_pageviews" '.
                'style="width:auto; height:2em; border:0; max-height: 31px; max-width: 88px;" '.
                'alt="'.$langFooter->metricBlock->metrika->alt.'" title="'.$langFooter->metricBlock->metrika->title.'" '.
                'class="ym-advanced-informer" data-cid="44136454" data-lang="'.$langFooter->langLw.'" /></a>'.
                '<script type="text/javascript" >
    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();
   for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
   k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(44136454, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true
   });
</script>'.
                '<noscript><div><img src="https://mc.yandex.ru/watch/44136454" style="position:absolute; left:-9999px;" alt="" /></div></noscript>';
        }

        //subscribe buttons
        if($authFlag){
            $buttons = '<span onclick="$(\'.modal.menu, .modal.menu .overlay\').css({\'opacity\': 1, \'visibility\': \'visible\'})">'.
                '<img src="/img/popimg/checkInNow-footer.png" title="'.$langFooter->socialButtons->mail->title.'" '.
                'alt="'.$langFooter->socialButtons->mail->alt.'"></span>';
            $buttons .= ModalAuthForms::printSocialButtons($langFooter->socialButtons);
        }
        //view cats
        else{
            $buttons = '<img src="/img/footer-cats.png" style="height: 2em; width: auto; border:0; max-height: 31px; max-width: 88px;" '.
                'alt="'.$langFooter->signInBlock->cats->alt.'" title="'.$langFooter->signInBlock->cats->title.'"/>';
        }

        $pageFooter.= '</div><div class="ft-center"><hr><span>by Right Joint</span></div>'.
            '<div class="ft-right">'.
            $buttons.
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

        $pageModals.= self::modalMenuSiteman($langModal->modulesMenu, $viewParams->userModules, $viewParams->langSl, $viewParams->routes_ns).
            static::createModalContent($langModal, $viewParams).
            self::modalSignPanel($langModal->modalSignUser, $langModal->authForms, $viewParams->authForms,
                $viewParams->langSl, $viewParams->ntfCount);

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

    public static function modalSignPanel(\stdClass $modalSignUser , \stdClass $langAuthForms, \stdClass $paramsAuthForm,
                                          string $langSl = 'ru', int $ntfCount = 0):string
    {
        global $currentUser;

        if(!empty($currentUser->user_id)){
            $user = '<div class="modal-line">'.
                '<div class="modal-line-img"><img src="';
            if(!empty($currentUser->photoLink)){
                if($currentUser->network == 'site'){
                    $user.= self::USER_AVATARS_DIR.'/'.$currentUser->photoLink;
                }else{
                    $user.= $currentUser->photoLink;
                }
            }else{
                $user.= '/img/popimg/avatar-default.png';
            }
            $user_link_add_class = null;
            $user_link_ref = '/user';
            //if ($this->controller_action == 'user') {
            //$user_link_add_class = ' decnone';
            $user_link_add_class = '';
            //$user_link_ref = '#';
            //}

            $user.= '"></div>'.
                '<div class="modal-line-text"><a class="m-l-blue'.$user_link_add_class.'" href="'.$user_link_ref . '" '.
                'title="'.$modalSignUser->title.'">'.
                $modalSignUser->siteUser.':</a>'.
                $currentUser->accAlias.'<sup><a href="/user/cmd?exit=userquit" title="'.$modalSignUser->exit_title.'">'.
                $modalSignUser->exit.'</a></sup>';
            if($ntfCount){
                $user.= '<div class="modal-line-user-info">'.
                    '<div class="modal-line-user-notifications">'.
                    '<a href="'.$langSl.'/user/notifications" title="Читать уведомления"><img src="/img/popimg/email-logo3.png"></a>'.
                    '<sup>'.$ntfCount.'</sup>'.
                    '</div>'.
                    '</div>'.
                    '</div>'.
                    '</div>';
            }
            return $user;
        }else{
            $modalAuthForms = new ModalAuthForms($langAuthForms, $paramsAuthForm, $langSl);
            return $modalAuthForms->printAuthForms();
        }
    }

    public static function printOrder(\stdClass $langOrder, array $basket):string
    {
        $returnOrder = '<div class="modal order"><div class="overlay"></div><div class="contentBlock-frame">'.
            '<div class="contentBlock-center"><div class="modal-right"><div class="modal-close"></div></div>'.
            '<div class="modal-left">'.
            '<div class="modal-line"><div class="modal-line-img">'.
            '<img src="/img/Services/logo-free.png"></div>'.
            '<div class="modal-line-text free"><a href="tel:+7(903)8887772" class="phone" target="_blank">+7 (903) 888-7772</a>'.
            '<p>'.$langOrder->hire_txt.'</p>'.
            '<div>'.
            '</div></div></div>'.
            '<div class="modal-line"><div class="modal-line-img">'.
            '<img src="/img/popimg/eMailLogo.png"></div><div class="modal-line-text mail">'.
            '<a href="mailto:rightjoint@yandex.ru" class="mailto" target="_blank">rightjoint@yandex.ru</a></div></div>'.
            '<div class="modal-line"><div class="modal-line-img">'.
            '<img src="/img/Services/telegram.png"></div><div class="modal-line-text">'.
            '<a href="https://t.me/rightjoint" class="mailto" target="_blank" title="'.$langOrder->telega_t.'">'.
            't.me/rightjoint</a>'.
            '</div></div>'.
            '<form class="auth-form order">'.
            '<div class="modal-line">'.
            '<div class="modal-line-text fbm-title ta-right">'.
            $langOrder->orderForm->leave_app.
            '<p>'.$langOrder->orderForm->app_txt.'</p>'.
            '</div>'.
            '<div class="modal-line-img"><img src="/img/Services/application-logo.png"></div>'.
            '</div>'.
            '<div class="modal-line" ';
        if (isset($_SESSION['basket']['total']) and $_SESSION['basket']['total'] > 0) {
            $returnOrder .= 'style="position: relative" ';
        } else {
            $returnOrder .= 'style="display: none" ';
        }
        if($langOrder->langLw == 'en'){
            $p_curr = '$';
        }else{
            $p_curr = 'руб';
        }

        $returnOrder.= '><div class="modal-line-img">'.
            '<img src="/img/Services/handsShake-color.png"></div><div class="modal-line-text basket">'.
            '<div>'.$langOrder->orderForm->basket_txt.': <span>';
        if(isset($_SESSION['basket']['total']) and $_SESSION['basket']['total']>0){
            $returnOrder.= $_SESSION['basket']['total'];
        }
        $returnOrder.= '</span> '.$p_curr.'.'.
            '<a href="/?basket-clear=1" onclick="event.preventDefault(); basketDrop();" class="basket-clear" '.
            'title="'.$langOrder->orderForm->cancel_order.'"><img src="/img/popimg/drop-icon.png"></a></div>'.
            '</div></div>'.
            '<div class="modal-basket-list">'.
            self::printBasket($basket, $langOrder->langLw).
            '</div>'.
            '<div class="modal-line">'.
            '<div class="modal-line-text">'.
            '<input type="text" name="clientName" placeholder="'.$langOrder->orderForm->name_ps.'.." required></div>'.
            '<div class="modal-line-img"><img src="/img/popimg/avatar-default.png"></div>'.
            '<div class="modal-line-err"></div>'.
            '</div>'.
            '<div class="modal-line">'.
            '<div class="modal-line-text">'.
            '<input type="email" name="clientMail" placeholder="'.$langOrder->orderForm->mail_ps.'.." required></div>'.
            '<div class="modal-line-img"><img src="/img/popimg/eMailLogo-2.png"></div>'.
            '<div class="modal-line-err"></div>'.
            '</div>'.
            '<div class="modal-line">'.
            '<div class="modal-line-text"><input type="text" name="clientPhone" placeholder="'.$langOrder->orderForm->phone_ps.'.."></div>'.
            '<div class="modal-line-img"><img src="/img/Services/typeNum.png"></div>'.
            '<div class="modal-line-err"></div>'.
            '</div>'.
            '<div class="modal-line">'.
            '<div class="modal-line-text"><textarea name="clientSubject" placeholder="'.$langOrder->orderForm->message_ps.'.."></textarea></div>'.
            '<div class="modal-line-img"><img src="/img/Services/appQuestion.png"></div>'.
            '<div class="modal-line-err"></div>'.
            '</div>'.
            '<div class="modal-line">'.
            '<div class="modal-line-err"></div>'.
            '<div class="modal-line-text ta-right"><input type="submit" name="mo-submit" value="'.$langOrder->orderForm->submit.'" '.
            'onclick="event.preventDefault(); mkApplication()"></div>'.
            '<div class="modal-line-img"></div>'.
            '<input type="hidden" name="feedBack-form-modal" value="newAppl">'.
            '</div>'.
            '</form>';
        $returnOrder.= '</div></div></div></div>';

        return $returnOrder;
    }

    public static function printBasket(array $basket, string $langLw = 'ru'):string
    {
        $return = '';
        foreach ($basket as $num=> $findProd_row){
            $return.= '<div class="mbl-line"><div class="mbl-line-img"><img src="'.
                '/img/Services/images/thumbs/'.$findProd_row['cardAlias'].'.png"></div>'.
                '<div class="mbl-line-info">';
            $return.=$findProd_row['cardName'];
            $val = $_SESSION['basket']['prod'][$findProd_row['cardAlias']];
            $return.= ' '.$val;
            $return.=' ('.$findProd_row['unit'].')';
            $return.=' * '.$findProd_row['cardPrice'].' = '.($val * $findProd_row['cardPrice']) .
                ' ('.$findProd_row['cardCurr'].')';
            $return.='</div></div>';
        }
        return $return;
    }
}