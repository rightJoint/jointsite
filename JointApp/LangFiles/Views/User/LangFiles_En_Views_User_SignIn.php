<?php

class LangFiles_En_Views_User_SignIn extends LangFiles_En_Views_SiteView
{
    static public function getLangHead():\stdClass
    {
        $langHead = parent::getLangHead();
        $langHead->description = 'Auth: ';
        $langHead->title = 'Auth';
        return $langHead;
    }

    static public function getLangHeader():stdClass
    {
        $langHeader = parent::getLangHeader();
        $langHeader->h1 = 'Auth on site';
        return $langHeader;
    }

    static public function getLangPageContent():stdClass
    {
        $lang = parent::getLangPageContent();
        $lang->pageContent = 'Auth for proceed';
        return $lang;
    }
}