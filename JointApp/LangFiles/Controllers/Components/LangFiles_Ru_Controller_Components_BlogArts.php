<?php

class LangFiles_Ru_Controller_Components_BlogArts extends LangFiles_Ru_Controller_Records
{
    public function __construct()
    {
        //parent::__construct();
        $this->moduleAlias = 'Статьи';
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