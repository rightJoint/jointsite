<?php
class LangFiles_Ru_Views_BlogArts extends LangFiles_Ru_Views_SiteView
{
    static public function getLangPageContent():\stdClass
    {
        $langPageContent = parent::getLangPageContent();

        $artHeader = new stdClass();
        $artHeader->created = 'Опубликовано';
        $artHeader->refresh = 'Обновлено';
        $artHeader->tags = 'Тэги';

        $langPageContent->artHeader = $artHeader;

        $langPageContent->langArtContent = self::getLangArtContent();

        return $langPageContent;
    }

    static public function getLangArtContent():\stdClass
    {
        return new stdClass();
    }
}
