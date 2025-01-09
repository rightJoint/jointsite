<?php
class LangFiles_En_Views_Test_Migrations extends LangFiles_En_Views_Test
{
    static public function getLangHead():stdClass
    {
        $langHead = parent::getLangHead();
        $langHead->description = 'тесты миграции';
        $langHead->title = 'Тесты-Миграции';

        return $langHead;
    }
    static public function getLangHeader():stdClass
    {
        $langHeader = parent::getLangHeader();
        $langHeader->h1 = 'Тесты-Миграции';

        return $langHeader;
    }
}
