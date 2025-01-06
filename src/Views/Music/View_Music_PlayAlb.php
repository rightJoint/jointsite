<?php
namespace Src\Views\Music;


use JointApp\Interfaces\LangWebViewInterface;

class View_Music_PlayAlb extends \Src\Views\Music\View_Music
{
    public string $logo = '/img/popimg/albums.png';
    public string $shortcutIcon = '/img/popimg/music-logo.png';
    public $hasAccessCreate = false;

    public $playAlbTracks = [];
    public $playAlbList = [];
    public $playAlb = [];

    const MUSIC_ALB_DIR = '/userdata/music/covers';
    const MUSIC_TRACKS_DIR = '/userdata/music/tracks';

    public static function loadLangView(string $docRoot = __DIR__, string $viewLang = 'ru', $loads = []): LangWebViewInterface
    {
        $name = 'LangFiles_'.self::langNs($viewLang).'_Views_Music_PlayAlb';
        $loads[] = [$name => $docRoot.'/LangFiles/Views/Music/'.$name];
        return parent::loadLangView($docRoot, $viewLang, $loads);
    }

    function langHeaderUpdate(callable $updateFromArray):void
    {
        $updateFromArray(['h1' => $this->playAlb['albumAlias']]);
    }

    function langHeadUpdate(callable $updateFromArray):void
    {
        $updateFromArray(['title' => $this->playAlb['albumAlias']]);
    }

    public function addViewParams($addViewParams)
    {
        parent::addViewParams($addViewParams);
        $addParams = new \stdClass();
        $addParams->playAlbTracks = $this->playAlbTracks;
        $addParams->playAlbList = $this->playAlbList;
        $addParams->playAlb = $this->playAlb;

        $addViewParams($addParams);
    }

    public static function createPageContent(\stdClass $langPageContent, \stdClass $viewParams):string
    {
     $return = '<div class="contentBlock-frame"><div class="contentBlock-center">'.
            '<div class="contentBlock-wrap">'.
            '<div class="music-menu">'.
            self::musicNavMenu($langPageContent->navMenu).
            self::albListMenu($viewParams->playAlb['albumAlias'], $viewParams->playAlbList).
            '</div>'.
            self::printMusicAlbum($langPageContent->fiterView->albBlock, $viewParams->playAlb).
            '<div class="ac-wrap">'.
            '<audio controls="controls" autoplay id="htmlMusicPlayer">'.
            '</audio>'.
            '</div>'.
            '<div class="tracks-list" id="music-album">';

        if(count($viewParams->playAlbTracks) > 0){
            $return.= '<div class="track-line caption">'.
                '<div class="track-num">No</div>'.
                '<div class="track-artist">'.$langPageContent->fiterView->albBlock->t_art.'</div>'.
                '<div class="track-name">'.$langPageContent->fiterView->albBlock->t_song.'</div>'.
                '<div class="track-play">'.$langPageContent->fiterView->albBlock->t_play.'</div>'.
                '</div>';

            $track_num = 0;

            foreach ($viewParams->playAlbTracks as $num=>$track_row){
                $print_track_file = self::MUSIC_TRACKS_DIR.'/'.$track_row['track_file'];
                //if(strpos(' '.$track_row['track_file'], 'http', 0)!=1){
                //    $print_track_file='/'.$print_track_file;
                //}

                $track_num++;
                $return.= '<div class="track-line">'.
                    '<div class="track-num">'.$track_num.'</div>'.
                    '<div class="track-artist">'.$track_row['track_artist'].'</div>'.
                    '<div class="track-name">'.
                    '<a href="'.$print_track_file.'">'.$track_row['track_name'].'</a>'.
                    '</div>'.
                    '<div class="track-play"><input type="button" value="Play"></div>'.
                    '</div>';
            }
        }

        $return.= '</div>'.
            '</div></div></div>';

        return $return;
    }

    public static function albListMenu(string $playAlbAlias = '', array $playAlbList = []):string
    {
        $list_alb_menu = null;
        $list_alb_first = null;

        if(!empty($playAlbAlias)){
            if(count($playAlbList)){
                foreach ($playAlbList as $num => $alb_row){

                    if($playAlbAlias == $alb_row['albumAlias']){
                        $list_alb_first.= '<a href="'.'/music/playalbum/'.$alb_row['albumAlias'].'" class="active">'.
                            $alb_row['albumName'].'</a>';
                    }else{
                        $list_alb_menu.= '<a href="'.'/music/playalbum/'.$alb_row['albumAlias'].'">'.$alb_row['albumName'].'</a>';
                    }
                }
            }
        }

        return '<div class="alb-menu">'.$list_alb_first.$list_alb_menu.'</div>';
    }
}