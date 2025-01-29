<?php

class LangFiles_En_Controller_Components_BlogCats extends LangFiles_En_Controller_Records
{
    public function __construct()
    {
        $this->moduleAlias = 'Блог - категории';
        $this->fieldAliases = array(
            'cat_id' => 'id',
            'catAlias' => 'категория',
            'catName_en' => 'категория',
            'catName_ru' => 'Алиас_ру',
            'catMeta_en' => 'Исп',
            'catMeta_ru' => 'создал_id',
            'catImg' => 'создал',
            'activeFlag' => 'создал',
            'indexFlag' => 'создал',
            'created_by' => 'создал',
        );

    }
}