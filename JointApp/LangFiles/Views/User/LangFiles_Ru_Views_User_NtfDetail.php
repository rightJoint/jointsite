<?php
class LangFiles_Ru_Views_User_NtfDetail extends LangFiles_Ru_Views_Templates_RecordDetail
{
    public static function getLangHead(): stdClass
    {
        $langHead = parent::getLangHead();
        $langHead->title = 'Чтение уведомления';
        /*
        $langHead->updateFromArray = function ($array = []) use (&$langHead){
            if(isset($array['title'])){
                $langHead->title.=$array['title'];
            }
        };
*/
        return $langHead;
    }

    public static function getLangHeader(): stdClass
    {
        $langHeader = parent::getLangHeader();
        $langHeader->updateFromArray = function ($array = []) use (&$langHeader){
            //if($array['type'] == 'edit'){
            $langHeader->h1 = 'Чтение уведомления';
            //}
        };
        return $langHeader;
    }
}