<?php
class LangFiles_En_Views_ModulesListView extends LangFiles_En_Views_SiteView
{
    static public function getLangHead():\stdClass
    {
        $langHead = parent::getLangHead();
        $langHead->description = 'Admin - modules list';
        $langHead->title = 'Admin - modules list';
        return $langHead;
    }

    static public function getLangHeader():stdClass
    {
        $langHeader = parent::getLangHeader();
        $langHeader->h1 = 'Modules list';
        return $langHeader;
    }

    static public function getLangPageContent():stdClass
    {
        $langPageContent = new stdClass();
        $langPageContent->modulesMenu = self::modulesList();

        return $langPageContent;
    }
}