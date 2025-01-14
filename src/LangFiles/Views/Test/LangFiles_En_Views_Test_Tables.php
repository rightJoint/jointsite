<?php
class LangFiles_En_Views_Test_Tables extends LangFiles_En_Views_SiteView
{
    static public function getLangHead():stdClass
    {
        $langHead = parent::getLangHeader();
        $langHead->description = 'Операции с таблицами';
        $langHead->title = 'Тест - Таблицы';

        return $langHead;
    }
    static public function getLangHeader():stdClass
    {
        $langHeader = parent::getLangHeader();
        $langHeader->h1 = 'тест Таблицы';

        return $langHeader;
    }

    static public function getLangPageContent():stdClass
    {
        $langPageContent = new stdClass();

        $tablesLang = array(
            "pefix" => "Приставка",
            "dateTag" => "Дт.штамп",
            "btn_upLoadAll" => "Выгрузить всё",
            "btn_refresh" => "Обновить",
            "btn_log" => "Лог",
            "t_cap" => array(
                "table" => "Название таблицы",
                "Lst" => "файл",
                "Ext" => "Создана",
                "action" => "Действие",
                "tgt" => "Загрузить",
            ),
            "h3" => "Лог действий",
        );

        $langPageContent->pageContent = 'тест таблицы';
        $langPageContent->tablesLang = $tablesLang;

        return $langPageContent;
    }

    public $admin_tables = array(
        "pefix" => "Приставка",
        "dateTag" => "Дт.штамп",
        "btn_upLoadAll" => "Выгрузить всё",
        "btn_refresh" => "Обновить",
        "btn_log" => "Лог",
        "t_cap" => array(
            "table" => "Название таблицы",
            "Lst" => "файл",
            "Ext" => "Создана",
            "action" => "Действие",
            "tgt" => "Загрузить",
        ),
        "h3" => "Лог действий",
    );
}