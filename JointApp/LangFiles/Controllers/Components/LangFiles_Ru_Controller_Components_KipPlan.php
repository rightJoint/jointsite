<?php

class LangFiles_Ru_Controller_Components_KipPlan extends LangFiles_Ru_Controller_Records
{
    public string $moduleAlias = 'План работ';
    public function __construct()
    {
        $this->fieldAliases = array(
            'status' => 'Статус',
            'ordernum' => '№п/п',
            'fulltitle' => 'Задача',
        );
    }
}