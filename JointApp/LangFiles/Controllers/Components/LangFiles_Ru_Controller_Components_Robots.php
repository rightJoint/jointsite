<?php

class LangFiles_Ru_Controller_Components_Robots extends LangFiles_Ru_Controller_Records
{
    public string $moduleAlias = 'Robots - txt';
    public function __construct()
    {
        $this->fieldAliases = array(
            'maploc' => 'loc',
            'indexVal' => 'Индекс',
            'comment' => 'коммент.',
            'use_flag' => 'исп.',
            'date_created' => 'создан.дт.',
            'created_by' => 'создал ид',
        );
    }
}