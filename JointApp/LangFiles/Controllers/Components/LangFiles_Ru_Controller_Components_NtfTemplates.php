<?php

class LangFiles_Ru_Controller_Components_NtfTemplates extends LangFiles_Ru_Controller_Records
{
    public string $moduleAlias = 'Шаблоны уведомлений';
    public function __construct()
    {
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