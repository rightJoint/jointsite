<?php


namespace Src\Views\Music;


use JointApp\Interfaces\LangWebViewInterface;

class View_Music_Main extends View_Music
{
    public $newAlbums;
    public $albumsCount;
    public $newTracks;
    public $tracksCount;


    public static function loadLangView(string $docRoot = __DIR__, string $viewLang = 'ru', $loads = []): LangWebViewInterface
    {
        $name = 'LangFiles_'.self::langNs($viewLang).'_Views_Music_Main';
        $loads[] = [$name => $docRoot.'/LangFiles/Views/Music/'.$name];
        return parent::loadLangView($docRoot, $viewLang, $loads);
    }

    public function addViewParams($addViewParams)
    {
        parent::addViewParams($addViewParams);
        $addParams = new \stdClass();
        $addParams->newAlbums = $this->newAlbums;
        $addParams->albumsCount = $this->albumsCount;
        $addParams->newTracks = $this->newTracks;
        $addParams->tracksCount = $this->tracksCount;
        //$addParams->logMessage = $this->logMessage;
        //$addParams->actionResult = $this->actionResult;
        //$addParams->editFields = $this->editFields;
        $addViewParams($addParams);
    }

    public static function createPageContent(\stdClass $langPageContent, \stdClass $viewParams):string
    {
        return '<div class="contentBlock-frame"><div class="contentBlock-center">'.
            '<div class="contentBlock-wrap music">'.
            self::musicMenu($langPageContent).
            '<section>'.
            '<h2>'.$langPageContent->albSection->h2.'</h2>'.
            self::printLastAlbums($langPageContent->fiterView->albBlock, $viewParams->newAlbums).
            '<div class="music-block-ref"><a href="/music/albums" title="albums list">'.
            $langPageContent->albSection->see_all_1.
            ' '.$viewParams->albumsCount.' '.$langPageContent->albSection->see_all_2.'</a></div>'.
            '</section>'.
            '<section>'.
            '<h2>'.$langPageContent->tracksSection->h2.'</h2>'.
            self::printMusicTracks($langPageContent->fiterView->albBlock, $viewParams->newTracks).
            '<div class="music-block-ref"><a href="/music/tracks" title="albums list">'.
            $langPageContent->tracksSection->see_all_1.
            ' '.$viewParams->tracksCount.' '.$langPageContent->tracksSection->see_all_2.'</a></div>'.
            '</section>'.
            '</div></div></div>';
    }

    public static function printLastAlbums(\stdClass $albBlock, array $newAlbums = []):string
    {
        if(count($newAlbums) > 0){
            foreach ($newAlbums as $album){
                return self::printMusicAlbum($albBlock, $album);
            }
        }
    }
}