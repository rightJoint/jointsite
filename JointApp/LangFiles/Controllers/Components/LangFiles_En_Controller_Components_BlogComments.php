<?php

class LangFiles_En_Controller_Components_BlogComments extends LangFiles_En_Controller_Records
{
    public function __construct()
    {
        //parent::__construct();
        $this->moduleAlias = 'Comments';
        $this->fieldAliases = array(
            'art_id' => 'id',
            'artCat' => 'категория',
            'groupAlias_ru' => 'Алиас_ру',
            'activeFlag' => 'Исп',
            'created_by' => 'создал_id',
            'createdUser' => 'создал',
        );

    }


}