<?php
class LangFiles_En_Views_Templates_RecordsList extends LangFiles_En_Views_SiteView
{
    static public function getLangPageContent():stdClass
    {
        $langPageContent = parent::getLangPageContent();

        $list_table = array(
            'found' => 'Found',
            'list_by' => 'display by',
            'sort' => 'Sort',
            'new' => 'New record',
            'btn_apply' => 'Apply filter',
            'cell_view' => 'View',
            'cell_del' => 'Delete',
            'cell_edit' => 'Edit',
            'btn_clear' => 'Clear',
        );

        $filterView = new stdClass();
        $filterView->list_table = $list_table;

        $langPageContent->fiterView = $filterView;
        return $langPageContent;
    }

    static public function getLangHead():stdClass
    {
        $langHead = parent::getLangHead();
        $langHead->title = 'Records list in ';
        $langHead->updateFromArray = function ($array = []) use (&$langHead){
            if(isset($array['title'])){
                $langHead->title.=$array['title'];
            }
        };

        return $langHead;
    }

    static public function getLangHeader():stdClass
    {
        $langHead = parent::getLangHeader();

        $langHead->h1 = 'Records list in ';

        $langHead->updateFromArray = function ($array = []) use (&$langHead){
            if(isset($array['h1'])){
                $langHead->h1.=$array['h1'];
            }
        };

        return $langHead;
    }
}