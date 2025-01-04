<?php
class LangFiles_Ru_Views_Music_Albums extends  LangFiles_Ru_Views_Music
{
    static public function getLangHead():stdClass
    {
        $langHead = parent::getLangHead();

        $langHead->updateFromArray = function ($array = []) use (&$langHead){
            if(isset($array['title'])){
                $langHead->title = 'Список альбомов';
            }
        };

        return $langHead;
    }

    static public function getLangHeader():stdClass
    {
        $langHeader = parent::getLangHeader();

        $langHeader->updateFromArray = function ($array = []) use (&$langHeader){
            if(isset($array['h1'])){
                $langHeader->h1='Список альбомов';
            }
        };

        return $langHeader;
    }
}