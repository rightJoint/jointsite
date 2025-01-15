<?php

class LangFiles_En_Controller_Components_Services extends LangFiles_En_Controller_Records
{
    public function __construct()
    {
        //parent::__construct();
        $this->moduleAlias = 'Услуги';
        $this->fieldAliases = array(
            'group_id' => 'id',
            'groupAlias_en' => 'Алиас_en',
            'groupAlias_ru' => 'Алиас_ру',
            'activeFlag' => 'Исп',
            'created_by' => 'создал_id',
            'createdUser' => 'создал',
        );

    }


}