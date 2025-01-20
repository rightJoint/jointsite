<?php

class LangFiles_En_Controller_Components_Groups extends LangFiles_En_Controller_Records
{
    public string $moduleAlias = 'Users groups';
    public function __construct()
    {
        $this->fieldAliases = array(
            'group_id' => 'id',
            'groupAlias_en' => 'Alias_en',
            'groupAlias_ru' => 'Alias_ру',
            'activeFlag' => 'use',
            'created_by' => 'created_id',
            'createdUser' => 'created',
        );
    }
}