<?php


class LangFiles_En_Views_RobotsUpdate extends LangFiles_En_Views_SiteView
{
    static public function getLangHead():stdClass
    {
        $langHead = parent::getLangHead();

        $langHead->description = 'Robots.txt - update';
        $langHead->title = 'Robots.txt - update';
        return $langHead;
    }

    static public function getLangHeader():stdClass
    {
        $langHeader = parent::getLangHeader();

        $langHeader->h1 = 'Robots.txt - update';

        return $langHeader;
    }
}
