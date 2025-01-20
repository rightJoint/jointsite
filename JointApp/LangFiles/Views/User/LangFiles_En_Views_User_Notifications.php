<?php
class LangFiles_En_Views_User_Notifications extends LangFiles_En_Views_Templates_RecordsList
{
    public static function getLangHead(): stdClass
    {
        $langHead = parent::getLangHead();
        $langHead->title = '';
        return $langHead;
    }

    public static function getLangHeader(): stdClass
    {
        $langHeader = parent::getLangHeader();

        $langHeader->updateFromArray = function ($array = []) use (&$langHeader){
            $langHeader->h1 = 'Notifications';
        };

        return $langHeader;
    }
}