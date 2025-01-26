<?php

class LangFiles_Ru_Views_JointSite_About_Lang extends LangFiles_Ru_Views_JointSite_About
{
    static public function getLangHead():\stdClass
    {
        $langHead = parent::getLangHead();
        $langHead->description = 'Языковая оптимизация сайта';
        $langHead->title = 'Языковая оптимизация сайта';
        return $langHead;
    }

    static public function getLangHeader():stdClass
    {
        $langHeader = parent::getLangHeader();
        $langHeader->h1 = 'Языковая оптимизация сайта';
        return $langHeader;
    }

    protected static function langContentBlock():stdClass
    {
        return new stdClass();
    }
}