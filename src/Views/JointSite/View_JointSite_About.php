<?php


namespace Src\Views\JointSite;


use JointApp\Interfaces\LangWebViewInterface;
use Src\Views\View_Main;

class View_JointSite_About extends View_JointSite
{

    public string $logo = '/img/siteLogo/rightjoint-logo-400.png';

    public static function loadLangView(string $docRoot = __DIR__, string $viewLang = 'ru', $loads = []):LangWebViewInterface
    {
        $name = 'LangFiles_'.self::langNs($viewLang).'_Views_JointSite_About';
        $loads[] = [$name => $docRoot.'/LangFiles/Views/JointSite/'.$name];
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
            static::pageContentJointSite($langPageContent->contentBlock).
            '</div>'.
            '</div></div></div>';

        return $pageContent;
    }

    //content after menu
    protected static function pageContentJointSite(\stdClass $contentBlock):string
    {
        return '<p>'.

            '</p>';
    }
}