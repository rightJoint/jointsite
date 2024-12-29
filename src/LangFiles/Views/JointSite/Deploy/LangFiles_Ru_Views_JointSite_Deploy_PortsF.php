<?php

class LangFiles_Ru_Views_JointSite_Deploy_PortsF extends LangFiles_Ru_Views_JointSite_Deploy
{
    static public function getLangHead():\stdClass
    {
        $langHead = parent::getLangHead();


        $langHead->description = 'Проброс портов JointSite: ';
        $langHead->title = 'JointSite-проброс портов';
        return $langHead;
    }

    static public function getLangHeader():stdClass
    {
        $langHeader = parent::getLangHeader();
        $langHeader->h1 = 'проброс портов JointSite';
        return $langHeader;
    }
}