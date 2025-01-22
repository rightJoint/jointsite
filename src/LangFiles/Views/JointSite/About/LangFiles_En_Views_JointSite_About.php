<?php

class LangFiles_En_Views_JointSite_About extends LangFiles_En_Views_Main
{
    static public function getLangHead():\stdClass
    {
        $langHead = parent::getLangHead();
        $langHead->description = 'Назначение JointSite: ';
        $langHead->title = 'Назначение и функционал';
        return $langHead;
    }

    static public function getLangHeader():stdClass
    {
        $langHeader = parent::getLangHeader();
        $langHeader->h1 = 'Назначение и функционал';
        return $langHeader;
    }

    static public function getLangPageContent():stdClass
    {
        $langPageContent = parent::getLangPageContent();
        $langPageContent->contentBlock = static::langContentBlock();
        return $langPageContent;
    }

    protected static function langContentBlock():stdClass
    {
        return new stdClass();
    }
}