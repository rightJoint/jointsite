<?php

class LangFiles_En_Views_JointSite_About_Notifications extends LangFiles_En_Views_JointSite_About
{
    static public function getLangHead():\stdClass
    {
        $langHead = parent::getLangHead();
        $langHead->description = 'Уведомления';
        $langHead->title = 'Уведомления';
        return $langHead;
    }

    static public function getLangHeader():stdClass
    {
        $langHeader = parent::getLangHeader();
        $langHeader->h1 = 'Уведомления';
        return $langHeader;
    }

    protected static function langContentBlock():stdClass
    {
        return new stdClass();
    }
}