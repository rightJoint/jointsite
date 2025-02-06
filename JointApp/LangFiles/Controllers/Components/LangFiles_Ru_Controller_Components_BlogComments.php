<?php

class LangFiles_Ru_Controller_Components_BlogComments extends LangFiles_Ru_Controller_Records
{
    public function __construct()
    {
        //parent::__construct();
        $this->moduleAlias = 'Комменты';
        $this->fieldAliases = array(
            'artName' => 'Статья',
            'accAlias' => 'Пользователь',
            'addDate' => 'Дата',
            'activeFlag' => 'Исп',
            'comment_id' => 'ид',
            'commentP_id' => 'ид.родит.',
            //'art_id' => 'id',

            //'groupAlias_ru' => 'Алиас_ру',
            //'activeFlag' => 'Исп',
            //'created_by' => 'создал_id',
            //'createdUser' => 'создал',
        );

    }


}