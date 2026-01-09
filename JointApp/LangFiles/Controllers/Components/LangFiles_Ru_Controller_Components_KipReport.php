<?php

class LangFiles_Ru_Controller_Components_KipReport extends LangFiles_Ru_Controller_Records
{
    public string $moduleAlias = 'Отчет';
    public function __construct()
    {
        $this->fieldAliases = array(
            'status' => 'Статус',
            'ordernum' => '№п/п',
            'fulltitle' => 'Задача',
            'date_from' => 'От даты',
            'date_to' => 'До даты',
        );
    }
}