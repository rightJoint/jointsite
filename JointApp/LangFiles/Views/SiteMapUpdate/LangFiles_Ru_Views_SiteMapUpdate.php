<?php


class LangFiles_Ru_Views_SiteMapUpdate extends LangFiles_Ru_Views_SiteView
{
    static public function getLangHead():stdClass
    {
        $langHead = parent::getLangHead();

        $langHead->description = 'Карта сайта - обновление';
        $langHead->title = 'Карта сайта - обновление';
        return $langHead;
    }

    static public function getLangHeader():stdClass
    {
        $langHeader = parent::getLangHeader();

        $langHeader->h1 = 'Карта сайта - обновление';

        return $langHeader;
    }

    static public function getLangPageContent():stdClass
    {
        $langPageContent = new stdClass();
        $langPageContent->pageContent = 'вставьте сюда содержание страницы';
        $langPageContent->modulesMenu = self::modulesList();

        $langPageContent->langLw = 'ru';

        return $langPageContent;
    }

}
