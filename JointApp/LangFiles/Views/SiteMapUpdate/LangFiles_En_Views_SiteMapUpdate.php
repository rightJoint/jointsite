<?php


class LangFiles_En_Views_SiteMapUpdate extends LangFiles_En_Views_SiteView
{
    static public function getLangHead():stdClass
    {
        $langHead = parent::getLangHead();

        $langHead->description = 'Sitemap - update';
        $langHead->title = 'Sitemap - update';
        return $langHead;
    }

    static public function getLangHeader():stdClass
    {
        $langHeader = parent::getLangHeader();

        $langHeader->h1 = 'Sitemap - update';

        return $langHeader;
    }
}
