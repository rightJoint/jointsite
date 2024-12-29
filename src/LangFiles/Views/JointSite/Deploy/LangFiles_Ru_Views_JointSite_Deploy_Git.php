<?php

class LangFiles_Ru_Views_JointSite_Deploy_Git extends LangFiles_Ru_Views_JointSite_Deploy
{
    static public function getLangHead():\stdClass
    {
        $langHead = parent::getLangHead();


        $langHead->description = 'Github JointSite: ';
        $langHead->title = 'JointSite-Github';
        return $langHead;
    }

    static public function getLangHeader():stdClass
    {
        $langHeader = parent::getLangHeader();
        $langHeader->h1 = 'Github JointSite';
        return $langHeader;
    }
}