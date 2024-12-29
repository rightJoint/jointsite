<?php

class LangFiles_Ru_Views_JointSite_Deploy extends LangFiles_Ru_Views_Main
{
    static public function getLangHead():\stdClass
    {
        $langHead = parent::getLangHead();


        $langHead->description = 'Установка JointSite: ';
        $langHead->title = 'JointSite-установка';
        return $langHead;
    }

    static public function getLangHeader():stdClass
    {
        $langHeader = parent::getLangHeader();
        $langHeader->h1 = 'Установка JointSite';
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