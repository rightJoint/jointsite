<?php
class LangFiles_Ru_Views_BlogArts extends LangFiles_Ru_Views_SiteView
{
    static public function getLangHead():stdClass
    {
        $langHead = new stdClass();

        $langHead->updateFromArray = function ($array = []) use (&$langHead){
            if(count($array)){
                foreach ($array as $key => $value){
                    if($key=='title'){
                        $langHead->title = 'Блог-'.$value;
                    }else{
                        $langHead->$key = $value;
                    }
                }
            }
        };

        return $langHead;
    }

    static public function getLangPageContent():\stdClass
    {
        $langPageContent = parent::getLangPageContent();

        $artHeader = new stdClass();
        $artHeader->created = 'Опубликовано';
        $artHeader->refresh = 'Обновлено';
        $artHeader->tags = 'Тэги';

        $langPageContent->artHeader = $artHeader;

        $langPageContent->langArtContent = static::getLangArtContent();

        return $langPageContent;
    }

    static public function getLangArtContent():\stdClass
    {
        return new stdClass();
    }
}
