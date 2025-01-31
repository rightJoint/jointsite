<?php
class LangFiles_En_Views_User_Validate extends LangFiles_En_Views_SiteView
{
    public static function getLangHead(): stdClass
    {
        $langHead = parent::getLangHead();

        $langHead->title = 'Validate email';
        return $langHead;
    }

    public static function getLangHeader(): stdClass
    {
        $langHeader = parent::getLangHeader();
        $langHeader->h1 = 'Validate email';

        return $langHeader;
    }

    public static function getLangPageContent(): stdClass
    {
        $langPageContent = parent::getLangPageContent();
        $langPageContent->vldErr['undefined'] = 'undefined error validation email???';
        $langPageContent->vldErr['repeated'] = 'no needs validate eMail again?!';
        $langPageContent->vldErr['success'] = 'Validation eMail success))) Use menu for continue';
        return $langPageContent;
    }
}