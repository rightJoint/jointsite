<?php
namespace Src\Views\Music;


use JointApp\Interfaces\LangWebViewInterface;

class View_Music_Albums extends View_Music
{

    public string $logo= '/img/popimg/albums.png';
    public string $shortcutIcon = '/img/popimg/music-logo.png';
    public $hasAccessCreate = false;
    public bool $robotNoIndex = true;

    public static function loadLangView(string $docRoot = __DIR__, string $viewLang = 'ru', $loads = []): LangWebViewInterface
    {
        $name = 'LangFiles_'.self::langNs($viewLang).'_Views_Music_Albums';
        $loads[] = [$name => $docRoot.'/LangFiles/Views/Music/'.$name];
        return parent::loadLangView($docRoot, $viewLang, $loads);
    }

    public static function createPageContent(\stdClass $langPageContent, \stdClass $viewParams):string
    {
        return '<div class="contentBlock-frame"><div class="contentBlock-center">'.
            '<div class="contentBlock-wrap music">'.
        self::musicMenu($langPageContent).
            '</div></div></div>'.
            parent::createPageContent($langPageContent, $viewParams);
    }

    public static function listViewTable($langFilterView, \stdClass $viewParams = null)
    {
        $return_text = null;

        if($viewParams->listRecords) {
            foreach ($viewParams->listRecords as $fieldName => $fieldInfo) {
                $return_text.= self::printMusicAlbum($langFilterView->albBlock, $fieldInfo);
            }
        }
        return $return_text;
    }

}