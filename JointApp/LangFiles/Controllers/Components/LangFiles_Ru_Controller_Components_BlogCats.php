<?php

class LangFiles_Ru_Controller_Components_BlogCats extends LangFiles_Ru_Controller_Records
{
    public function __construct()
    {
        $this->moduleAlias = 'Блог - категории';
        $this->fieldAliases = array(
            'cat_id' => 'ид',
            'catAlias' => 'ссылка',
            'catName_en' => 'назв.en',
            'catName_ru' => 'назв.ру',
            'catMeta_en' => 'опис.en',
            'catMeta_ru' => 'опис.ру',
            'catImg' => 'картинка',
            'activeFlag' => 'активно',
            'indexFlag' => 'роб.индекс',
            'created_by' => 'создал ид',
        );

    }
}