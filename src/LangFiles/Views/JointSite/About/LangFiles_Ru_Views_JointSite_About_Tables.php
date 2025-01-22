<?php

class LangFiles_Ru_Views_JointSite_About_Tables extends LangFiles_Ru_Views_JointSite_About
{
    static public function getLangHead():\stdClass
    {
        $langHead = parent::getLangHead();
        $langHead->description = 'Работа с таблицами';
        $langHead->title = 'Таблицы';
        return $langHead;
    }

    static public function getLangHeader():stdClass
    {
        $langHeader = parent::getLangHeader();
        $langHeader->h1 = 'Работа с таблицами';
        return $langHeader;
    }

    protected static function langContentBlock():stdClass
    {
        return new stdClass();
    }
}