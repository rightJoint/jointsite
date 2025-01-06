<?php
class LangFiles_Ru_Views_Music_PlayAlb extends  LangFiles_Ru_Views_Music
{
    static public function getLangHead():stdClass
    {
        $langHead = parent::getLangHead();

        $langHead->updateFromArray = function ($array = []) use (&$langHead){
            if(isset($array['title'])){
                $langHead->title = 'Альбом '.$array['title'];
            }
        };

        return $langHead;
    }

    static public function getLangHeader():stdClass
    {
        $langHeader = parent::getLangHeader();

        $langHeader->updateFromArray = function ($array = []) use (&$langHeader){
            if(isset($array['h1'])){
                $langHeader->h1='Альбом '.$array['h1'];
            }
        };

        return $langHeader;
    }
}