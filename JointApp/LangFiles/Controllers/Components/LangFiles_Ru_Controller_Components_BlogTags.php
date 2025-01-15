<?php

class LangFiles_Ru_Controller_Components_BlogTags extends LangFiles_Ru_Controller_Records
{
    public function __construct()
    {
        //parent::__construct();
        $this->moduleAlias = 'Список тэгов';
        $this->fieldAliases = array(
            'tag_id' => 'id',
            'tag_en' => 'Name',
            'tag_ru' => 'Назв.',
            'activeFlag' => 'Исп',
            'created_by' => 'создал_id',
            'createdUser' => 'создал',
        );

    }


}