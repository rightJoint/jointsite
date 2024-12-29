<?php
class LangFiles_En_Templates_RecordsList extends LangFiles_En_SiteView
{

    static public function getLangPageContent():stdClass
    {
        $langPageContent = parent::getLangPageContent();

        $list_table = array(
            "found" => "Found",
            "list_by" => "display by",
            "sort" => "sort field",
            "new" => "New one",
            "btn_apply" => "applyFilterForm",
            "cell_view" => "View",
            "cell_del" => "Del",
            "cell_edit" => "Edit",
            "btn_clear" => "Clear",
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
        $langHeader = parent::getLangHeader();
        $langHeader->h1 = 'Records list in ';

        $langHeader->updateFromArray = function ($array = []) use (&$langHeader){
            if(isset($array['h1'])){
                $langHeader->h1.=$array['h1'];
            }
        };

        return $langHeader;
    }
}