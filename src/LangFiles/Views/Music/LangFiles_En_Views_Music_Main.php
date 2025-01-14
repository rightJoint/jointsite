<?php
class LangFiles_En_Views_Music_Main extends LangFiles_En_Views_Music
{
    static public function getLangHeader():stdClass
    {
        $langHeader = parent::getLangHeader();
        $langHeader->h1 = 'Музыкальная коллекция';
        return $langHeader;
    }

    static public function getLangHead(): stdClass
    {
        $langHead = parent::getLangHead();
        $langHead->title = 'Музыкальная коллекция';
        return $langHead;
    }

    static public function getLangPageContent():stdClass
    {
        $langPageContent = parent::getLangPageContent();

        $albSection = new stdClass();

        $albSection->h2 = 'Новые альбомы';
        $albSection->see_all_1 = 'Смотреть все';
        $albSection->see_all_2 = 'альбома';

        $langPageContent->albSection = $albSection;

        $tracksSection = new stdClass();

        $tracksSection->h2 = 'Новые трэки';
        $tracksSection->see_all_1 = 'Слушать все';
        $tracksSection->see_all_2 = 'трэка';

        $langPageContent->tracksSection = $tracksSection;

        return $langPageContent;
    }

}