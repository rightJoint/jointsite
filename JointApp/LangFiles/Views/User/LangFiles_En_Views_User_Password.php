<?php
class LangFiles_En_Views_User_Password extends LangFiles_En_Views_Templates_RecordEdit
{
    public static function getLangHead(): stdClass
    {
        $langHead = parent::getLangHead();

        $langHead->title = 'Change password';
        return $langHead;
    }

    public static function getLangHeader(): stdClass
    {
        $langHeader = parent::getLangHeader();

        $langHeader->updateFromArray = function ($array = []) use (&$langHeader){
            if($array['type'] == 'edit'){
                $langHeader->h1 = 'Change password';
            }
        };

        return $langHeader;
    }
}