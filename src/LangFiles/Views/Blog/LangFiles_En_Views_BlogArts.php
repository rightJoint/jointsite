<?php
class LangFiles_En_Views_BlogArts extends LangFiles_En_Views_SiteView
{
    static public function getLangPageContent():\stdClass
    {
        $langPageContent = parent::getLangPageContent();

        $artHeader = new stdClass();
        $artHeader->created = 'Pub date';
        $artHeader->refresh = 'Refresh date';
        $artHeader->tags = 'Tags';

        $langPageContent->artHeader = $artHeader;

        $langPageContent->langArtContent = self::getLangArtContent();

        return $langPageContent;
    }

    static public function getLangArtContent():\stdClass
    {
        return new stdClass();
    }
}
