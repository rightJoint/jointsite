<?php

class LangFiles_Ru_Controller_Components_BlogTagsToArts extends LangFiles_Ru_Controller_Records
{
    public function __construct()
    {
        //parent::__construct();
        $this->moduleAlias = 'Тэги к статьям';
        $this->fieldAliases = array(
            'artName' => 'Статья',
            'tagName' => 'Тэг',
        );

    }
}