<?php
class LangFiles_En_Views_Test_Migrations_CreateTables extends LangFiles_En_Views_Test_Migrations
{
    static public function getLangHead():stdClass
    {
        $langHead = parent::getLangHead();
        $langHead->description = 'Тесты-таблицы миграций';
        $langHead->title = 'Тесты-таблицы миграций';

        return $langHead;
    }
    static public function getLangHeader():stdClass
    {
        $langHeader = parent::getLangHeader();
        $langHeader->h1 = 'Тесты-таблицы миграций';

        return $langHeader;
    }
}
