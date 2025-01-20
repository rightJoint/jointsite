<?php
class LangFiles_En_Views_User_NtfDetail extends LangFiles_En_Views_Templates_RecordDetail
{
    public static function getLangHead(): stdClass
    {
        $langHead = parent::getLangHead();
        $langHead->title = 'Read notification';
        return $langHead;
    }

    public static function getLangHeader(): stdClass
    {
        $langHeader = parent::getLangHeader();
        $langHeader->updateFromArray = function ($array = []) use (&$langHeader){
            $langHeader->h1 = 'Read notification';
        };
        return $langHeader;
    }
}