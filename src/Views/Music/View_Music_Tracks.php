<?php
namespace Src\Views\Music;


use JointApp\Interfaces\LangWebViewInterface;

class View_Music_Tracks extends \Src\Views\Music\View_Music
{
    public string $logo= '/img/popimg/record.png';
    public string $shortcut_icon = '/img/popimg/music-logo.png';

    public $hasAccessCreate = false;

    public static function loadLangView(string $docRoot = __DIR__, string $viewLang = 'ru', $loads = []): LangWebViewInterface
    {
        $name = 'LangFiles_'.self::langNs($viewLang).'_Views_Music_Tracks';
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
        return self::printMusicTracks($langFilterView->albBlock, $viewParams->listRecords);
    }
}