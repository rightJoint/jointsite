<?php


namespace Src\Views\Kip;


use JointApp\Views\Modules\ModuleListView;
use JointApp\Views\Modules\ModuleSubMenu;
use JointApp\Views\Records\RecordListView;
use JointApp\Views\Modules\ModuleEditView;
//use JointApp\Views\SiteView;
use JointApp\Interfaces\LangWebViewInterface;

class View_Kip_Report_List extends ModuleListView
{

    /*public static function createPageContent(\stdClass $langPageContent, \stdClass $viewParams):string
    {
        return ModuleSubMenu::bindModuleMenu($viewParams->bindComponents, $viewParams->userModules, $langPageContent->modulesMenu, $viewParams->moduleName).
            static::listView($langPageContent->fiterView, $viewParams);
    }*/

    public static function listView($langFilterView, \stdClass $viewParams = null):string
    {
        $return = '<div class="contentBlock-frame"><div class="contentBlock-center">'.
            '<div class="contentBlock-wrap">'.
            '<div class="list_frame" id="'.$viewParams->list_frame_id.'">';
        if($viewParams->h2){
            $return.= '<h2>'.$viewParams->h2.'</h2>';
        }
        $return.= '<div class="list_table">'.
            static::listViewTable($langFilterView, $viewParams).
            '</div>'.
            static::scriptListViewCrtlPannel($viewParams->list_frame_id, $viewParams->process_url, $viewParams->slave_req).
            '</div>'.
            '</div>'.
            '</div>'.
            '</div>';
        $return.='<style>.list_table td {text-align: left}</style>';

        return $return;
    }
}