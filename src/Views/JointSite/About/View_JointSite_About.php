<?php


namespace Src\Views\JointSite\About;


use JointApp\Interfaces\LangWebViewInterface;
use Src\Views\JointSite\View_JointSite;

class View_JointSite_About extends View_JointSite
{

    public string $logo = '/img/siteLogo/rightjoint-logo-png.png';

    public static function loadLangView(string $docRoot = __DIR__, string $viewLang = 'ru', $loads = []):LangWebViewInterface
    {
        $name = 'LangFiles_'.self::langNs($viewLang).'_Views_JointSite_About';
        $loads[] = [$name => $docRoot.'/LangFiles/Views/JointSite/About/'.$name];
        return parent::loadLangView($docRoot, $viewLang, $loads);
    }

    public static function addStyleLinks(callable $addStyleLinks):void
    {
        parent::addStyleLinks($addStyleLinks);

        $addStyleLinks([
            '/css/jointSite/jointSiteMenu.css',
            '/css/jointSite/pageContentJointSite.css',
            ]);
    }

    public static function addScriptLinks($addScriptLinks):void
    {
        parent::addScriptLinks($addScriptLinks);

        $addScriptLinks(['/js/jointSite/jointSiteMenu.js']);
    }

    public static function createPageContent(\stdClass $langPageContent, \stdClass $viewParams = null):string
    {
        $pageContent =
            '<div class="contentBlock-frame"><div class="contentBlock-center">'.
            '<div class="contentBlock-wrap">'.
            '<div class="joint-site-menu">'.
            self::jointSiteMenu($langPageContent->jointSiteMenu).
            '</div>'.
            '</div></div></div>'.

            //contentBlock
            '<div class="contentBlock-frame"><div class="contentBlock-center">'.
            '<div class="contentBlock-wrap">'.
            '<div class="pageContentJointSite">'.
            static::pageContentJointSite($langPageContent->contentBlock, $viewParams->langSl).
            '</div>'.
            '</div></div></div>';

        return $pageContent;
    }

    //content after menu
    protected static function pageContentJointSite(\stdClass $contentBlock, string $langSl = ''):string
    {
        return '<section>'.
            'Это тренировочный проект, стоит ли вам его использовать для реальных задач, решайте сами. '.
            'При проектировании были выбраны мне уже знакомые технологии php, js, docker. '.
            'Было решено делать все самому на нативном php с поддержкой основных psr интерфейсов, нужные мне '.
            'методы добавлялись постепенно в фреймворк. '.
            'Приложение задумывалось как мультиязычный сайт для решения широкого круга задач. '.
            'Основные требования были - простота и скорость разработки нового фунционала на основе разработанного каркаса.'.
            '</section>'.
            '<section>'.
            '<h3>Работа с сайтом</h3>'.
            '<p>Для начала работы с сайтом вам потребуется работать создать базу данных и провести миграции.</p>'.
            '<ul>'.
            '<li><a href="'.$langSl.'/jointsite/about/lang" title="как обеспечивается двуязычность">языковая оптимизация</a></li>'.
            '<li><a href="'.$langSl.'/jointsite/about/migrations" title="работа с миграциями">проведение миграций</a></li>'.
            '<li><a href="'.$langSl.'/jointsite/about/tables" title="операции с таблицами">работа с таблицами</a></li>'.
            '<li><a href="'.$langSl.'/jointsite/about/api" title="api rest json">rest json api</a></li>'.
            '</ul>'.
            '</section>';
    }
}