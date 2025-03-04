<?php


class LangFiles_En_Views_WebView implements \JointApp\Interfaces\LangWebViewInterface
{
    static public function getLangHead():stdClass
    {
        $langHead = new stdClass();

        $langHead->description = 'Web site by Right Joint (www.rightjoint.ru)';
        $langHead->title = 'Web-3 site';

        $langHead->updateFromArray = function ($array = []) use (&$langHead){
            if(count($array)){
                foreach ($array as $key => $value){
                    $langHead->$key = $value;
                }
            }
        };

        return $langHead;
    }

    static public function getLangHeader():stdClass
    {
        $langHeader = new stdClass();

        $langHeader->langLw = 'en';


        $langHeader->h1 = 'Web-3 tech';
        $langHeader->firmName = 'RIGHT JOINt';
        $langHeader->menuBtnText = 'MENU';
        $langHeader->langPanelTextRus = 'смотреть на русском';
        $langHeader->langPanelTextEn = 'view in english';

        $langHeader->updateFromArray = function ($array = []) use (&$langHeader){
            if(count($array)){
                foreach ($array as $key => $value){
                    $langHeader->$key = $value;
                }
            }
        };

        $langHeader->orderBtnText = 'HIRE';

        return $langHeader;
    }

    static public function getLangPageContent():stdClass
    {
        $langPageContent = new stdClass();
        $langPageContent->pageContent = 'put there page content';
        $langPageContent->modulesMenu = static::modulesList();

        $langPageContent->langLw = 'en';

        return $langPageContent;
    }

    static public function getLangFooter():stdClass
    {
        $langFooter = new stdClass();

        $langFooter->langLw = 'en';

        $metrikBlock = new \stdClass();

        $noIndex = new \stdClass();
        $noIndex->alt = 'No index';
        $noIndex->title = 'Index forbidden';

        $metrikBlock->noIndex = $noIndex;

        $metrika = new \stdClass();
        $metrika->alt = 'Yandex.Metrika';
        $metrika->title = 'Yandex.Metrika: data for today (views, visits and unique visitors)';

        $metrikBlock->metrika = $metrika;

        $signInBlock = new \stdClass();

        $cats = new \stdClass();
        $cats->alt = 'You already auth on site';
        $cats->title = 'You are in';

        $signInBlock->cats = $cats;


        $socialButtons = new \stdClass();

        $ok = new \stdClass();
        $ok->title = 'Subscribe via Odnoklassniki';
        $ok->alt = 'ok-button';
        $socialButtons->ok = $ok;

        $vk = new \stdClass();
        $vk->title = 'Subscribe via VKontakte';
        $vk->alt = 'vk-button';
        $socialButtons->vk = $vk;

        $mail = new stdClass();
        $mail->title = 'Subscribe by eMail';
        $mail->alt = 'SignUp on site';
        $socialButtons->mail = $mail;

        $langFooter->metricBlock = $metrikBlock;
        $langFooter->signInBlock = $signInBlock;
        $langFooter->socialButtons = $socialButtons;

        return $langFooter;
    }

    static public function getLangModal():stdClass
    {
        $langModal = new stdClass();

        $langModal->langLw = 'en';

        $langModal->homeRefText = 'Home';
        $langModal->homeRefTile = 'home page';
        $langModal->homeRefDefText = 'You are on main page';
        $langModal->homeRefDefTitle = 'Deploy your own Web-3 site';
        $langModal->langPanelTextRus = 'смотреть на русском';
        $langModal->langPanelTextEn = 'view in english';
        $langModal->modulesMenu = static::modulesList();

        $authForms = new stdClass();
        $authForms->signInForm = self::modalSignInForm();
        $authForms->signUpForm = self::modalSignUpForm();
        $authForms->socialButtons = self::socialButtons();

        $langModal->authForms = $authForms;

        $modalSignUser = new stdClass();
        $modalSignUser->title = 'personal page';
        $modalSignUser->siteUser = 'settings';
        $modalSignUser->exit = 'quit';
        $modalSignUser->exit_title = 'exit';

        $langModal->modalSignUser = $modalSignUser;

        return $langModal;
    }

    public static function modulesList():stdClass
    {

        $modulesMenu = new stdClass();

        $modulesMenu->menuItems = array(
            'users' => array(
                'refText' => 'users',
                'refTitle' => 'manage users',
                'usage' => true,
            ),
            'groups' => array(
                'refText' => 'groups',
                'refTitle' => 'Manage groups',
                'usage' => true,
            ),
            'userstogroups' => array(
                'refText' => 'users groups',
                'refTitle' => 'Manage users groups',
                'usage' => false,
            ),
            'ntftemplates' => array(
                'refText' => 'notification templates',
                'refTitle' => 'Manage notification templates',
                'usage' => true,
            ),
            'ntflist' => array(
                'refText' => 'notification list',
                'refTitle' => 'notification list',
                'usage' => false,
            ),
            'ntfread' => array(
                'refText' => 'notification read',
                'refTitle' => 'notification read',
                'usage' => false,
            ),
            'musicalb' => array(
                'refText' => 'music albums',
                'refTitle' => 'manage albus',
                'usage' => true,
            ),
            'musictracks' => array(
                'refText' => 'tracks list',
                'refTitle' => 'music - tracks list',
                'usage' => false,
            ),
            'musictrackstoalb' => array(
                'refText' => 'tracks to albums',
                'refTitle' => 'tracks to albums',
                'usage' => false,
            ),
            'sitemap' => array(
                'refText' => 'site map',
                'refTitle' => 'site map',
                'usage' => true,
            ),
            'sitemapupdate' => array(
                'refText' => 'site map update',
                'refTitle' => 'site map update',
                'usage' => false,
            ),
            'robots' => array(
                'refText' => 'robots - txt',
                'refTitle' => 'robots - txt',
                'usage' => false,
            ),
            'robotsupdate' => array(
                'refText' => 'update robots - txt',
                'refTitle' => 'update robots - txt',
                'usage' => false,
            ),
        );

        $modulesMenu->menuLine = array(
            'refText' => 'Manage site',
            'refTitle' => 'Go to admin',
            'supText' => '',
            'dropText' => 'units',
        );

        return $modulesMenu;
    }

    public static function modalSignInForm():stdClass
    {
        $modalSignInForm = new stdClass();
        $modalSignInForm->form_title = 'Sign In';
        $modalSignInForm->placeholder_login = 'login...';
        $modalSignInForm->placeholder_password = 'password...';
        $modalSignInForm->submit_btn = 'SignIn';

        $err = new stdClass();
        $err->signInErrLogin = 'wrong login';
        $err->signInErrPass = 'wrong password';
        $err->signInErrLP = 'wrong login or password';
        $err->signInErrNotFound = 'user not found';
        $err->signInErrEMailValid = 'eMail not valid';
        $err->signInErrBlackList = 'user in black list';
        $err->signInErrWrongPass = 'wrong password';
        $modalSignInForm->err = $err;

        return $modalSignInForm;
    }

    public static function modalSignUpForm():stdClass
    {
        $modalSignUpForm = new stdClass();

        $modalSignUpForm->form_title = 'Sign Up';
        $modalSignUpForm->placeholder_login = 'make up login...';
        $modalSignUpForm->placeholder_password = 'make up password...';
        $modalSignUpForm->placeholder_repeat = 'repeat password...';
        $modalSignUpForm->placeholder_mail = 'Your email...';
        $modalSignUpForm->placeholder_catpcha = 'check code';
        $modalSignUpForm->submit_btn = 'SignUp';

        $err = new stdClass();
        $err->signUpErrPassMatch = 'pass doent match';
        $err->signUpErrPassAccept = 'password unacceptable';
        $err->signUpErrLoginAccept = 'login unacceptable';
        $err->signUpErrLoginReserved = 'login reserved';
        $err->signUpErrEMailAccept = 'email unacceptable';
        $err->signUpErrCaptchaEmpty = 'captcha params unacceptable';
        $err->signUpErrCaptchaWrong = 'wrong check code';
        $modalSignUpForm->err = $err;

        return $modalSignUpForm;
    }

    static public function getLangOrder():stdClass
    {
        $langOrder = new stdClass();

        $langOrder->hire_txt = 'Looking for an opportunity for mutually beneficial collaboration. Ready to begin work by agreement';
        $langOrder->telega_t = 'Contact via Telegram';
        $langOrder->cv_text = 'CV';
        $langOrder->cv_title = 'My work experience, professional skill, answers to frequently asked questions';

        $orderForm = new stdClass();

        $orderForm->basket_txt = 'Your order';
        $orderForm->leave_app = 'New application';
        $orderForm->cancel_order = 'Cancel application';
        $orderForm->cancel_order = 'Cancel application';
        $orderForm->app_txt = 'Next you will be redirected to the page, where you can watch status of your '.
            'application, add details or attachments';
        $orderForm->name_ps = 'Your name';
        $orderForm->mail_ps = 'Your email';
        $orderForm->phone_ps = 'Phone number';
        $orderForm->message_ps = 'Subject';
        $orderForm->submit = 'Send';

        $langOrder->orderForm = $orderForm;

        $langOrder->langLw = 'en';

        return $langOrder;
    }

    public static function socialButtons():stdClass
    {
        $socialButtons = new \stdClass();

        $ok = new \stdClass();
        $ok->title = 'Subscribe via Odnoklassniki';
        $ok->alt = 'ok-button';
        $socialButtons->ok = $ok;

        $vk = new \stdClass();
        $vk->title = 'Subscribe via Vk';
        $vk->alt = 'vk-button';
        $socialButtons->vk = $vk;

        return $socialButtons;
    }
}
