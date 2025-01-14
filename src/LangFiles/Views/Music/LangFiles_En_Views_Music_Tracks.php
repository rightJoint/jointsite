<?php
class LangFiles_En_Views_Music_Tracks extends LangFiles_En_Views_Music
{
    static public function getLangHead():stdClass
    {
        $langHead = parent::getLangHead();

        $langHead->updateFromArray = function ($array = []) use (&$langHead){
            if(isset($array['title'])){
                $langHead->title = 'Список трэков';
            }
        };

        return $langHead;
    }

    static public function getLangHeader():stdClass
    {
        $langHead = parent::getLangHeader();

        $langHead->updateFromArray = function ($array = []) use (&$langHead){
            if(isset($array['h1'])){
                $langHead->h1='Список трэков';
            }
        };

        return $langHead;
    }
}