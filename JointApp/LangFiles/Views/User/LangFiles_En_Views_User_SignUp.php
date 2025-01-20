<?php
class LangFiles_En_Views_User_SignUp extends LangFiles_En_Views_SiteView
{
    static public function getLangHead():\stdClass
    {
        $langHead = parent::getLangHead();
        $langHead->description = 'Sign Up: ';
        $langHead->title = 'Sign Up';
        return $langHead;
    }

    static public function getLangHeader():stdClass
    {
        $langHeader = parent::getLangHeader();
        $langHeader->h1 = 'Sign up site';
        return $langHeader;
    }

    static public function getLangPageContent():stdClass
    {
        $lang = parent::getLangPageContent();
        $lang->registerDefault = 'Sign up for proceed';
        $lang->registerFail = 'Some err has occurred';
        $lang->registerSussess = 'Registration success. To sign in site you have to validate eMail by following ling in letter at your mail box';
        return $lang;
    }
}