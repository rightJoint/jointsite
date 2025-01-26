<?php

class LangFiles_En_Views_JointSite_About_Migrations extends LangFiles_En_Views_JointSite_About
{
    static public function getLangHead():\stdClass
    {
        $langHead = parent::getLangHead();
        $langHead->description = 'Проведение миграций';
        $langHead->title = 'Миграции';
        return $langHead;
    }

    static public function getLangHeader():stdClass
    {
        $langHeader = parent::getLangHeader();
        $langHeader->h1 = 'Миграции';
        return $langHeader;
    }

    protected static function langContentBlock():stdClass
    {
        return new stdClass();
    }
}