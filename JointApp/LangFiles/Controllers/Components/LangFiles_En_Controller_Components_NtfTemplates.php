<?php

class LangFiles_En_Controller_Components_NtfTemplates extends LangFiles_En_Controller_Records
{
    public function __construct()
    {
        $this->moduleAlias = 'Notification templates';
        $this->fieldAliases = array(
            'template_id' => 'template id',
            'tName' => 't.name',
            'tHeader_en' => 'header_en',
            'tHeader_ru' => 'header_ru',
            'tBody_en' => 'tBody_en',
            'tBody_ru' => 'tBody_ru',
            'date_created' => 'date_created',
            'created_by' => 'created_by',
        );

    }

}