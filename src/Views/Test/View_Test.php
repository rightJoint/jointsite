<?php

namespace Src\Views\Test;

use JointApp\Interfaces\LangWebViewInterface;
use JointApp\Views\SiteView;

class View_Test extends SiteView
{
    public string $logo = '/img/popimg/test-logo.png';
    public string $shortcut_icon = '/img/popimg/test-logo.png';

    public static function loadLangView(string $docRoot = __DIR__, string $viewLang = 'ru', $loads = []):LangWebViewInterface
    {
        $name = 'LangFiles_'.self::langNs($viewLang).'_Views_Test';
        $loads[] = [$name => $docRoot.'/LangFiles/Views/Test/'.$name];
        return parent::loadLangView($docRoot, $viewLang, $loads);
    }


    public static function createPageContent(\stdClass $langPageContent, \stdClass $viewParams):string
    {
        return '<div class="contentBlock-frame"><div class="contentBlock-center">'.
            '<div class="contentBlock-wrap">'.
            '<div class="test-menu" style="text-align: left">'.
            '<h2>'.$langPageContent->h2.'</h2>'.
            self::pageContentMenuFromArray($langPageContent->menuItems, $viewParams->langSl,'/test').
            '</div>'.
        '</div></div></div>';
    }

    public static function pageContentMenuFromArray($pageContentMenu = [], string $langSl = '', $rootUri = ''):string
    {
        $return = '';
        if(count($pageContentMenu)){
            $return.='<ul>';
            foreach ($pageContentMenu as $refUri => $refData){
                $return.= '<li><a href="'.$langSl.$rootUri.'/'.$refUri.'" title="'.$refData['refTitle'].'">'.$refData['refText'].'</a>';
                if(isset($refData['subMenu'])){
                    $return.= self::pageContentMenuFromArray($refData['subMenu'], $rootUri.'/'.$refUri);
                }
                $return.='</li>';
            }
            $return.='</ul>';
        }
        return $return;
    }
}