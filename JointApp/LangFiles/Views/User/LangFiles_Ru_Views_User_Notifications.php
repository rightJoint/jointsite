<?php
class LangFiles_Ru_Views_User_Notifications extends LangFiles_Ru_Views_Templates_RecordsList
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
            $langHeader->h1 = 'Уведомления';
        };

        return $langHeader;
    }
}