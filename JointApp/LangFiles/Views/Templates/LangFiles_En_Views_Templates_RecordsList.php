<?php
class LangFiles_En_Views_Templates_RecordsList extends LangFiles_En_Views_SiteView
{
    static public function getLangPageContent():stdClass
    {
        $langPageContent = parent::getLangPageContent();

        $list_table = array(
            "found" => "Найдено",
            "list_by" => "Показывать по",
            "sort" => "Сортировка",
            "new" => "Создать запись",
            "btn_apply" => "Применить фильтр",
            "cell_view" => "Смотр.",
            "cell_del" => "Удал.",
            "cell_edit" => "Редакт.",
            "btn_clear" => "Очистить",
        );

        $filterView = new stdClass();
        $filterView->list_table = $list_table;

        $langPageContent->fiterView = $filterView;
        return $langPageContent;
    }

    static public function getLangHead():stdClass
    {
        $langHead = parent::getLangHead();
        $langHead->title = 'Список записей в ';
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

        $langHead->h1 = 'Список записей в ';

        $langHead->updateFromArray = function ($array = []) use (&$langHead){
            if(isset($array['h1'])){
                $langHead->h1.=$array['h1'];
            }
        };

        return $langHead;
    }
}