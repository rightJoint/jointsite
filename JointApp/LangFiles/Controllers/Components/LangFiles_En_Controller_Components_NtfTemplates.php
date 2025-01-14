<?php

class LangFiles_En_Controller_Components_NtfTemplates extends LangFiles_En_Controller_Records
{
    public function __construct()
    {
        $this->moduleAlias = 'Шаблоны уведомлений';
        $this->fieldAliases = array(
            'template_id' => 'шаблон id',
            'tName' => 'Ш.Наимен',
            'tHeader_en' => 'заголовок_en',
            'tHeader_ru' => 'заголовок_ru',
            'tBody_en' => 'tBody_en',
            'tBody_ru' => 'tBody_ru',
            'date_created' => 'date_created',
            'created_by' => 'created_by',
        );

    }

}