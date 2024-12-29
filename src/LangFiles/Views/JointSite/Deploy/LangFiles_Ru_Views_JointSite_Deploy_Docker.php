<?php

class LangFiles_Ru_Views_JointSite_Deploy_Docker extends LangFiles_Ru_Views_JointSite_Deploy
{
    static public function getLangHead():\stdClass
    {
        $langHead = parent::getLangHead();


        $langHead->description = 'Dockerhub JointSite: ';
        $langHead->title = 'JointSite-dockerhub';
        return $langHead;
    }

    static public function getLangHeader():stdClass
    {
        $langHeader = parent::getLangHeader();
        $langHeader->h1 = 'Dockerhub JointSite';
        return $langHeader;
    }
}