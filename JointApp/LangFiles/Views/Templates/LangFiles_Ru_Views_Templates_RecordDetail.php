<?php
class LangFiles_Ru_Views_Templates_RecordDetail extends LangFiles_Ru_Views_SiteView
{
    public static function getLangHeader(): stdClass
    {
        $langHeader = parent::getLangHeader();

        $langHeader->updateFromArray = function ($array = []) use (&$langHeader){
                $langHeader->h1 = 'Просмотр записи в таблице '.$array['tableName'];
        };
        return $langHeader;
    }
}
