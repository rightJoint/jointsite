<?php

class LangFiles_En_Controller_Components_Robots extends LangFiles_En_Controller_Records
{
    public string $moduleAlias = 'Robots - txt';
    public function __construct()
    {
        $this->fieldAliases = array(
            'maploc' => 'loc',
            'indexVal' => 'indexVal',
            'comment' => 'comment.',
            'use_flag' => 'use',
            'date_created' => 'created dt',
            'created_by' => 'created id',
        );
    }
}