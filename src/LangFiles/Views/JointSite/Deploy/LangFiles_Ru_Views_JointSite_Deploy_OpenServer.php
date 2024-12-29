<?php

class LangFiles_Ru_Views_JointSite_Deploy_OpenServer extends LangFiles_Ru_Views_JointSite_Deploy
{
    static public function getLangHead():\stdClass
    {
        $langHead = parent::getLangHead();


        $langHead->description = 'OpenServer JointSite: ';
        $langHead->title = 'OpenServer-Github';
        return $langHead;
    }

    static public function getLangHeader():stdClass
    {
        $langHeader = parent::getLangHeader();
        $langHeader->h1 = 'OpenServer JointSite';
        return $langHeader;
    }
}