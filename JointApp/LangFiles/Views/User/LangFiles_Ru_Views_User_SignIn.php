<?php

class LangFiles_Ru_Views_User_SignIn extends LangFiles_Ru_Views_SiteView
{
    static public function getLangHead():\stdClass
    {
        $langHead = parent::getLangHead();
        $langHead->description = 'Авторизация: ';
        $langHead->title = 'Авторизация';
        return $langHead;
    }

    static public function getLangHeader():stdClass
    {
        $langHeader = parent::getLangHeader();
        $langHeader->h1 = 'Авторизация на сайте';
        return $langHeader;
    }

    static public function getLangPageContent():stdClass
    {
        $lang = parent::getLangPageContent();
        $lang->pageContent = 'Авторизуйтесь для продолжения';
        return $lang;
    }
}