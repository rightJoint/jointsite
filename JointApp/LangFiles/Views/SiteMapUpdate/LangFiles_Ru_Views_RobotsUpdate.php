<?php


class LangFiles_Ru_Views_RobotsUpdate extends LangFiles_Ru_Views_SiteView
{
    static public function getLangHead():stdClass
    {
        $langHead = parent::getLangHead();

        $langHead->description = 'Robots.txt - обновление';
        $langHead->title = 'Robots.txt - обновление';
        return $langHead;
    }

    static public function getLangHeader():stdClass
    {
        $langHeader = parent::getLangHeader();

        $langHeader->h1 = 'Robots.txt - обновление';

        return $langHeader;
    }
}
