<?php

class LangFiles_En_Views_JointSite_About_Api extends LangFiles_En_Views_JointSite_About
{
    static public function getLangHead():\stdClass
    {
        $langHead = parent::getLangHead();
        $langHead->description = 'API сайта';
        $langHead->title = 'Rest-api';
        return $langHead;
    }

    static public function getLangHeader():stdClass
    {
        $langHeader = parent::getLangHeader();
        $langHeader->h1 = 'Rest api';
        return $langHeader;
    }

    protected static function langContentBlock():stdClass
    {
        return new stdClass();
    }
}