<?php
class LangFiles_En_Views_User_SignUp extends LangFiles_En_Views_SiteView
{
    static public function getLangHead():\stdClass
    {
        $langHead = parent::getLangHead();
        $langHead->description = 'Регистрация: ';
        $langHead->title = 'Регистрация';
        return $langHead;
    }

    static public function getLangHeader():stdClass
    {
        $langHeader = parent::getLangHeader();
        $langHeader->h1 = 'Регистрация на сайте';
        return $langHeader;
    }

    static public function getLangPageContent():stdClass
    {
        $lang = parent::getLangPageContent();
        $lang->registerDefault = 'Зарегистрируйтесь для продолжения';
        $lang->registerFail = 'Какие то ошибки при регистрации';
        $lang->registerSussess = 'Регистрация успешно. Для входа на сайт вам необходимо подтвердить ваш eMail переходом по ссылке в письме';
        return $lang;
    }
}