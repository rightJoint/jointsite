<?php

namespace Src\Views;

use JointApp\Interfaces\LangWebViewInterface;
use JointApp\JointAppRequest;
use JointApp\Views\SiteView;

class View_Main extends SiteView
{
    function __construct(string $docRoot, string $langNs)
    {
        parent::__construct($docRoot, $langNs);
        $this->styles[] = '/css/main_view.css';
    }

    public static function loadLangView(string $docRoot = __DIR__, string $viewLang = 'ru', $loads = []):LangWebViewInterface
    {
        $lang = 'LangFiles_'.self::langNs($viewLang).'_Views_Main';
        $loads[] = [$lang => $docRoot.'/LangFiles/Views/'.$lang];
        return parent::loadLangView($docRoot, $viewLang, $loads);
    }

    public static function addStyleLinks(callable $addStyleLinks):void
    {
        parent::addStyleLinks($addStyleLinks);
        $addStyleLinks(['/css/main_view.css']);
    }

    public static function createPageContent(\stdClass $langPageContent, \stdClass $viewParams):string
    {

        $pageContent =
            '<div class="contentBlock-frame"><div class="contentBlock-center">'.
            '<div class="contentBlock-wrap">'.
            '<section class="js-title">'.
            '<h2>Web - приложение JointSite</h2>'.
            '<div class="js-about">'.
            '<p>'.
            'Двуязычный сайт с меню в модальном окне. Технологии: php, js. Шаблон: MVC, PSR-стандарты.'.
            ' CI/CD: ДокерХаб. Отладка: xDebug. Тестирование: phpUnit'.
            '<br>'.
            '<small>Это все еще довольно сырой проект, обновления готовятся и выйдут скоро.</small>'.
            '</p>'.
            '</div>'.
            '<div class="js-download">'.
            '<div class="js-download-row">'.
            '<div class="js-download-image">'.
            '<img src="/img/siteLogo/rightjoint-logo-400.png" alt="rightjoint-logo">'.
            '</div>'.
            '<div class="js-download-docker">'.
            '<a href="/docker" title="Скачать образ с докер-хаба">Скачать докер-контейнер</a>'.
            '</div>'.
            '<div class="js-download-git">'.
            '<a href="/git" title="Скачать ветку репозитория">Скачать git-репозиторий</a>'.
            '</div>'.
            '</div>'.
            '</div>'.

            '<div class="js-version">'.
            '<div class="js-version-title">'.
            'Текущие версии'.
            '</div>'.
            '<div class="js-version-line">'.
            '<div class="js-versions-softType">'.
            'JointApp'.
            '</div>'.
            '<div class="js-versions-softV">'.
            'v1.0'.
            '</div>'.
            '<div class="js-versions-components">'.
            '<a href="/record" title="Record">Record</a>'.
            '<a href="/migrations" title="Record">Migrations</a>'.
            '</div>'.
            '</div>'.

            '<div class="js-version-line">'.
            '<div class="js-versions-softType">'.
            'Apache'.
            '</div>'.
            '<div class="js-versions-softV">'.
            'v8.3'.
            '</div>'.
            '<div class="js-versions-components">'.
            '<a href="/record" title="Record">xre-comp</a>'.
            //'<a href="/migrations" title="Record">Migrations</a>'.
            '</div>'.
            '</div>'.

            '<div class="js-version-line">'.
            '<div class="js-versions-softType">'.
            'php'.
            '</div>'.
            '<div class="js-versions-softV">'.
            'v8.3'.
            '</div>'.
            '<div class="js-versions-components">'.
            '<a href="/record" title="Record">xDebug</a>'.
            //'<a href="/migrations" title="Record">Migrations</a>'.
            '</div>'.
            '</div>'.

            '<div class="js-version-line">'.
            '<div class="js-versions-softType">'.
            'mySql'.
            '</div>'.
            '<div class="js-versions-softV">'.
            'v1.0'.
            '</div>'.
            '<div class="js-versions-components">'.
            '<a href="/record" title="Record">no-components</a>'.
            //'<a href="/migrations" title="Record">Migrations</a>'.
            '</div>'.
            '</div>'.

            '</div>'.
            '</section>'.
            '</div>'.
            '</div>'.
            '</div>';



        $pageContent.=
            '<div class="contentBlock-frame"><div class="contentBlock-center">'.
            '<div class="contentBlock-wrap">'.
            '<section class="contents-tbl">'.
            '<h2>Содержание</h2>'.
            '<ul>'.
            static::jointSiteMenu($langPageContent->jointSiteMenu, $viewParams->langSl, '/jointsite').
            '</ul>'.
            '</section>'.
            '</div></div>'.
            '</div>';
        return $pageContent;

    }

    public static function jointSiteMenu(array $jointSiteMenu, string $langSl = '', $dispUri = '/jointsite')
    {
        $returnText = '<ul>';
        foreach ($jointSiteMenu as $refUri => $refMeta){
            $returnText .= '<li>'.
                '<a href="'.$langSl.$dispUri.'/'.$refUri.'" title="'.$refMeta['titleText'].'">'.
                $refMeta['refText'].'</a>';
            if(isset($refMeta['subMenu'])){
                $returnText .=self::jointSiteMenu($refMeta['subMenu'], $langSl, $dispUri.'/'.$refUri);
            }
            $returnText .='</li>';
        }

        $returnText .= '</ul>';
        return $returnText;
    }

    function printDeployMenu(\stdClass $deployMenu):string
    {
        $returnText = '<li>'.
            '<h3>'.
            '<a href="'.$this->langSl.'/jointsite/'.$deployMenu->refUri.'" title="'.$deployMenu->titleText.'">'.
            $deployMenu->refText.'</a>'.
            '</h3>'.
        '<ul>';
        foreach ($deployMenu->munuItems as $refUri => $refMeta){
            $returnText .= '<li>'.
                '<a href="'.$this->langSl.'/jointsite/'.$deployMenu->refUri.'/'.$refUri.'" title="'.$refMeta['titleText'].'">'.
                $refMeta['refText'].'</a>'.
                '</li>';
        }

        $returnText .= '</ul></li>';
        return $returnText;
    }
/*
    function printArchMenu(\stdClass $archMenu):string
    {
        $returnText = '<li>'.
            '<h3>'.
            '<a href="'.$this->langSl.'/jointsite/'.$archMenu->refUri.'" title="'.$archMenu->titleText.'">'.
            $archMenu->refText.'</a>'.
            '</h3>'.
            '<ul>';
        foreach ($archMenu->munuItems as $refUri => $refMeta){
            $returnText .= '<li>'.
                '<a href="'.$this->langSl.'/jointsite/'.$archMenu->refUri.'/'.$refUri.'" title="'.$refMeta['titleText'].'">'.
                $refMeta['refText'].'</a>';

            $returnText .=    '</li>';
        }

        $returnText .= '</ul></li>';
        return $returnText;
    }
*/
}