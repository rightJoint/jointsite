<?php


class LangFiles_En_Views_WebView implements \JointApp\Interfaces\LangWebViewInterface
{
    static public function getLangHead():stdClass
    {
        $langHead = new stdClass();

        $langHead->description = 'Web сайт от Right Joint (www.rightjoint.ru)';
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


        $langHeader->h1 = 'Web-3 технологии';
        $langHeader->firmName = 'РАЙТ ДЖОЙНt';
        $langHeader->menuBtnText = 'МЕНЮ';
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
        $langPageContent->pageContent = 'вставьте сюда содержание страницы';
        $langPageContent->modulesMenu = self::modulesList();

        $langPageContent->langLw = 'en';

        return $langPageContent;
    }

    static public function getLangFooter():stdClass
    {
        $langFooter = new stdClass();
        return $langFooter;
    }

    static public function getLangModal():stdClass
    {
        $langModal = new stdClass();

        $langModal->langLw = 'en';

        $langModal->homeRefText = 'Главная';
        $langModal->homeRefTile = 'на главную';
        $langModal->homeRefDefText = 'Вы уже на главной';
        $langModal->homeRefDefTitle = 'Развернуть свой Web-3 сайт';
        $langModal->langPanelTextRus = 'смотреть на русском';
        $langModal->langPanelTextEn = 'view in english';
        $langModal->modulesMenu = self::modulesList();

        $authForms = new stdClass();
        $authForms->signInForm = self::modalSignInForm();
        $authForms->signUpForm = self::modalSignUpForm();

        $langModal->authForms = $authForms;

        $modalSignUser = new stdClass();
        $modalSignUser->title = 'personal page';
        $modalSignUser->siteUser = 'settings';
        $modalSignUser->exit = 'exit';
        $modalSignUser->exit_title = 'quit';

        $langModal->modalSignUser = $modalSignUser;

        return $langModal;
    }

    public static function modulesList():stdClass
    {

        $modulesMenu = new stdClass();

        $modulesMenu->menuItems = array(
            'users' => array(
                'refText' => 'пользователи',
                'refTitle' => 'управление пользователями',
                'usage' => true,
            ),
            'groups' => array(
                'refText' => 'группы',
                'refTitle' => 'Управление группами',
                'usage' => true,
            ),
            'userstogroups' => array(
                'refText' => 'группы пользователей',
                'refTitle' => 'Управление группами пользователей',
                'usage' => false,
            ),
            'ntftemplates' => array(
                'refText' => 'шаблоны уведомлений',
                'refTitle' => 'управление шаблонами уведомлениями',
                'usage' => true,
            ),
            'ntflist' => array(
                'refText' => 'список уведомлений',
                'refTitle' => 'список уведомлений',
                'usage' => false,
            ),
            'ntfread' => array(
                'refText' => 'чтение уведомлений',
                'refTitle' => 'чтение уведомлений',
                'usage' => false,
            ),
            'musicalb' => array(
                'refText' => 'альбомы музыки',
                'refTitle' => 'управление музыкой',
                'usage' => true,
            ),
            'musictracks' => array(
                'refText' => 'список трэков',
                'refTitle' => 'музыка - список трэков',
                'usage' => false,
            ),
            'musictrackstoalb' => array(
                'refText' => 'трэки в альбом',
                'refTitle' => 'музыка трэки в альбом',
                'usage' => false,
            ),
            'services' => array(
                'refText' => 'услуги',
                'refTitle' => 'список и описание услуг',
                'usage' => true,
            ),
            'blogarts' => array(
                'refText' => 'блог',
                'refTitle' => 'статьи блога',
                'usage' => true,
            ),
        );

        $modulesMenu->menuLine = array(
            'refText' => 'Управление сайтом',
            'refTitle' => 'Перейти к управлению',
            'supText' => '',
            'dropText' => 'модули',
        );

        return $modulesMenu;
    }

    public static function modalSignInForm():stdClass
    {
        $modalSignInForm = new stdClass();
        $modalSignInForm->form_title = 'Вход на сайт';
        $modalSignInForm->placeholder_login = 'Ваш логин...';
        $modalSignInForm->placeholder_password = 'введите пароль...';
        $modalSignInForm->submit_btn = 'Войти';

        $err = new stdClass();
        $err->signInErrLogin = 'неправильный логин';
        $err->signInErrPass = 'неправильный пароль';
        $err->signInErrLP = 'неправильный логин или пароль';
        $err->signInErrNotFound = 'пользователь не найден';
        $err->signInErrEMailValid = 'eMail не подтвержден';
        $err->signInErrBlackList = 'пользователь в чёрном списке';
        $err->signInErrWrongPass = 'неправильный пароль';
        $modalSignInForm->err = $err;

        return $modalSignInForm;
    }

    public static function modalSignUpForm():stdClass
    {
        $modalSignUpForm = new stdClass();

        $modalSignUpForm->form_title = 'Регистрация на сайте';
        $modalSignUpForm->placeholder_login = 'Придумайте логин...';
        $modalSignUpForm->placeholder_password = 'пароль...';
        $modalSignUpForm->placeholder_repeat = 'повторите пароль...';
        $modalSignUpForm->placeholder_mail = 'Ваш email...';
        $modalSignUpForm->submit_btn = 'Зарегистрировать';

        $err = new stdClass();
        $err->signUpErrPassMatch = 'пароли не совпадают';
        $err->signUpErrPassAccept = 'недопустимый пароль';
        $err->signUpErrLoginAccept = 'недопустимый логин';
        $err->signUpErrLoginReserved = 'логин зарезервирован';
        $err->signUpErrEMailAccept = 'недопустимый eMail';
        $modalSignUpForm->err = $err;

        return $modalSignUpForm;
    }

    static public function getLangOrder():stdClass
    {
        $langOrder = new stdClass();

        $langOrder->hire_txt = 'Присматриваю варианты для взаимовыгодного сотрудничества. Готов приступить к работе по договоренности';
        $langOrder->telega_t = 'связаться по телеграмм';

        $orderForm = new stdClass();

        $orderForm->basket_txt = 'Ваш заказ';
        $orderForm->leave_app = 'Оставить заявку';
        $orderForm->cancel_order = 'Отменить заказ';
        $orderForm->cancel_order = 'Отменить заказ';
        $orderForm->app_txt = 'Далее вы будете переадресованы на страницу, '.
            'на которой всегда сможете отследить статус вашей заявки, добавить описание и вложение';
        $orderForm->name_ps = 'Ваше имя';
        $orderForm->mail_ps = 'Ваш email';
        $orderForm->phone_ps = 'Номер телефона';
        $orderForm->message_ps = 'Сообщение';
        $orderForm->submit = 'Отправить';

        $langOrder->orderForm = $orderForm;

        $langOrder->langLw = 'ru';

        return $langOrder;
    }
}
