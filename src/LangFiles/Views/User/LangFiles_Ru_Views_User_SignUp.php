<?php

class LangFiles_Ru_Views_User_SignUp extends LangFiles_Ru_Views_SiteView
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
        $lang->pageContent = 'Зарегистрируйтесь для продолжения';
        return $lang;
    }
}