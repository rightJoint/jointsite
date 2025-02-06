<?php


class LangFiles_Ru_Views_WebView implements \JointApp\Interfaces\LangWebViewInterface
{
    static public function getLangHead():stdClass
    {
        $langHead = new stdClass();

        $langHead->description = 'Web сайт от Right Joint (www.rightjoint.ru)';
        $langHead->title = 'Web-3 сайт';

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

        $langHeader->langLw = 'ru';


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

        return $langHeader;
    }

    static public function getLangPageContent():stdClass
    {
        $langPageContent = new stdClass();
        $langPageContent->pageContent = 'вставьте сюда содержание страницы';
        $langPageContent->modulesMenu = static::modulesList();

        $langPageContent->langLw = 'ru';

        return $langPageContent;
    }

    static public function getLangFooter():stdClass
    {
        $langFooter = new stdClass();

        $langFooter->langLw = 'ru';

        $metrikBlock = new \stdClass();

        $noIndex = new \stdClass();
        $noIndex->alt = 'Не индексируется';
        $noIndex->title = 'Запрещено к индексированию';

        $metrikBlock->noIndex = $noIndex;

        $metrika = new \stdClass();
        $metrika->alt = 'Яндекс.Метрика';
        $metrika->title = 'Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)';

        $metrikBlock->metrika = $metrika;

        $signInBlock = new \stdClass();

        $cats = new \stdClass();
        $cats->alt = 'Вы уже авторизованы';
        $cats->title = 'Вы уже авторизованы';

        $signInBlock->cats = $cats;


        $socialButtons = new \stdClass();

        $ok = new \stdClass();
        $ok->title = 'Подписаться через Одноклассники';
        $ok->alt = 'ok-кнопка';
        $socialButtons->ok = $ok;

        $vk = new \stdClass();
        $vk->title = 'Подписаться через ВКонтакте';
        $vk->alt = 'vk-кнопка';
        $socialButtons->vk = $vk;

        $mail = new stdClass();
        $mail->title = 'Подписаться по eMail';
        $mail->alt = 'Регистрация';
        $socialButtons->mail = $mail;

        $langFooter->metricBlock = $metrikBlock;
        $langFooter->signInBlock = $signInBlock;
        $langFooter->socialButtons = $socialButtons;

        return $langFooter;
    }

    static public function getLangModal():stdClass
    {
        $langModal = new stdClass();

        $langModal->langLw = 'ru';

        $langModal->homeRefText = 'Главная';
        $langModal->homeRefTile = 'на главную';
        $langModal->homeRefDefText = 'Вы уже на главной';
        $langModal->homeRefDefTitle = 'Развернуть свой Web-3 сайт';
        $langModal->langPanelTextRus = 'смотреть на русском';
        $langModal->langPanelTextEn = 'view in english';
        $langModal->modulesMenu = static::modulesList();

        $authForms = new stdClass();
        $authForms->signInForm = self::modalSignInForm();
        $authForms->signUpForm = self::modalSignUpForm();
        $authForms->socialButtons = self::socialButtons();

        $langModal->authForms = $authForms;

        $modalSignUser = new stdClass();
        $modalSignUser->title = 'кабинет';
        $modalSignUser->siteUser = 'настройки';
        $modalSignUser->exit = 'выход';
        $modalSignUser->exit_title = 'выйти';

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
            'sitemap' => array(
                'refText' => 'карта сайта',
                'refTitle' => 'карта сайта',
                'usage' => true,
            ),
            'sitemapupdate' => array(
                'refText' => 'обновить карту сайта',
                'refTitle' => 'обновить карту сайта',
                'usage' => false,
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

    public static function socialButtons():stdClass
    {
        $socialButtons = new \stdClass();

        $ok = new \stdClass();
        $ok->title = 'Вход через Одноклассники';
        $ok->alt = 'ok-кнопка';
        $socialButtons->ok = $ok;

        $vk = new \stdClass();
        $vk->title = 'Вход через ВКонтакте';
        $vk->alt = 'vk-кнопка';
        $socialButtons->vk = $vk;

        return $socialButtons;
    }
}
