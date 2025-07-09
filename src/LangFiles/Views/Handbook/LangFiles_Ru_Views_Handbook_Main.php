<?php
class LangFiles_Ru_Views_Handbook_Main extends LangFiles_Ru_Views_SiteView
{
    static public function getLangHead():stdClass
    {
        $langHead = parent::getLangHead();

        $langHead->description = 'Web site by Right Joint (www.rightjoint.ru)';
        $langHead->title = 'Справочник';

        return $langHead;
    }

    static public function getLangHeader():stdClass
    {
        $langHeader = parent::getLangHeader();

        $langHeader->h1 = 'Справочник';

        return $langHeader;
    }
}
