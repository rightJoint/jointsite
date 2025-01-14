<?php
class LangFiles_En_Views_Test_Migrations_Connect extends LangFiles_En_Views_Test_Migrations
{
    static public function getLangHead():stdClass
    {
        $langHead = parent::getLangHead();
        $langHead->description = 'Тесты-Коннект ДБ';
        $langHead->title = 'Тесты-Коннект ДБ';

        return $langHead;
    }
    static public function getLangHeader():stdClass
    {
        $langHeader = parent::getLangHeader();
        $langHeader->h1 = 'Тесты-Коннект ДБ';

        return $langHeader;
    }
}
