<?php

namespace JointApp\Views;

use JointApp\Interfaces\LangWebViewInterface;
use JointApp\JointAppRequest;

class ErrorsView extends SiteView
{
    public string $logo = '/img/popimg/error.png';

    public static function addStyleLinks(callable $addStyleLinks):void
    {
        $addStyleLinks(['/css/alerts.css']);
    }

    public static function loadLangView(string $docRoot = __DIR__, string $viewLang = 'ru', $loads = []):LangWebViewInterface
    {
        $name = 'LangFiles_'.self::langNs($viewLang).'_Views_ErrorsView';
        $loads[] = [$name => $docRoot.'/JointApp/LangFiles/Views/'.$name];
        return parent::loadLangView($docRoot, $viewLang, $loads);
    }

    public static function createPageContent(\stdClass $langPageContent, \stdClass $viewParams):string
    {
        global $jointAppResponse;

        $pageContentText= '<div class="contentBlock-frame"><div class="contentBlock-center">'.
            '<div class="contentBlock-wrap">'.
            '<div class="err-wrap">'.
            '<div class="ew-warning">'.
            $langPageContent->topText.
            '</div>'.
            '<span class="ew-txt">'.$langPageContent->bottomText.'</span>'.
            '<span class="ew-code">'.$jointAppResponse->getStatusCode().'</span>'.
            '<span class="ew-h">';

        if(count($jointAppResponse->customLog)){
            $pageContentText.= '</span>'.
                '<div class="ew-detail">'.
                self::displayErrorsLevels(['warning', 'critical', 'alert', 'emergency', 'error']);
                '</div>';
        }
        $pageContentText.= '</div>'.
            '</div>'.
            '</div>'.
            '</div>';
        return $pageContentText;
    }
}