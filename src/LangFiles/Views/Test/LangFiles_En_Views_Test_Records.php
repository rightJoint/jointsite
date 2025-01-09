<?php
class LangFiles_En_Views_Test_Records extends LangFiles_En_Views_Test
{
    //public $tblSelectorText = 'Выбор таблицы';

    static public function getLangHead():stdClass
    {
        $langHead = parent::getLangHead();
        $langHead->description = 'Тест-Все таблицы';
        $langHead->title = 'Тест-Все таблицы';

        return $langHead;
    }
    static public function getLangHeader():stdClass
    {
        $langHeader = parent::getLangHeader();
        $langHeader->h1 = 'Тест-Все таблицы';

        return $langHeader;
    }

    static public function getLangPageContent():stdClass
    {
        $langPageContent = parent::getLangPageContent();
        $langPageContent->tblSelectorText = 'Выбор таблицы';

        return $langPageContent;
    }
}
