<?php

namespace Src\Views\Test;

use JointApp\Interfaces\LangWebViewInterface;
use JointApp\Views\SiteView;

class View_Test_Records extends View_Test
{
    /*5-controller set up fields-------------------------------------------*/
    public $listTables = [];


    public $process_url;

    //table selector on top of pageContent;
    public $selectorTableName;

    public $table_selector;

    public $showTables;

    public static function loadLangView(string $docRoot = __DIR__, string $viewLang = 'ru', $loads = []):LangWebViewInterface
    {
        $name = 'LangFiles_'.self::langNs($viewLang).'_Views_Test_Records';
        $loads[] = [$name => $docRoot.'/LangFiles/Views/Test/'.$name];

        return parent::loadLangView($docRoot, $viewLang, $loads);
    }

    public function addViewParams(callable $addViewParams)
    {
        parent::addViewParams($addViewParams);
        $addParams = new \stdClass();
        $addParams->selectorTableName = $this->selectorTableName;
        $addParams->listTables = $this->listTables;
        $addViewParams($addParams);
    }

    public static function createPageContent(\stdClass $langPageContent, \stdClass $viewParams):string
    {
        //return $this->printSelectTblPanel($langPageContent->tblSelectorText).$this->pageContent;
        return self::printSelectTblPanel($langPageContent->tblSelectorText, $viewParams->langSl,
            $viewParams->listTables, $viewParams->selectorTableName
        );
    }

    public static function printSelectTblPanel(string $tblSelectorText = '', string $langSl = '', $listTables = [], string $selectorTableName = ''):string
    {
        $return_text = '<div class="contentBlock-frame"><div class="contentBlock-center">'.
            '<div class="contentBlock-wrap">'.
            '<div class="table-selector"><label for="table-selector">'.$tblSelectorText.': </label>'.
            '<select name="table-selector" id="table-selector" '.
            'onchange="let new_loc_table=&quot;'.$langSl.'/test/records/&quot;+this.options[this.selectedIndex].text; 
           window.location.href = new_loc_table">';
        if(count($listTables)){
            foreach ($listTables as $table_row){
                $tr_key = key($table_row);
                $return_text .= "<option value='".$table_row[$tr_key]."'";
                if($selectorTableName == $table_row[$tr_key]){
                    $return_text .= " selected";
                }
                $return_text .= ">".$table_row[$tr_key]."</option>";
            }
        }
        $return_text .= '</select>'.
            '</div>'.
            '</div></div></div>'.
            '<link rel="stylesheet" href="/css/test/test-rec.css">';
        return $return_text;
    }
}