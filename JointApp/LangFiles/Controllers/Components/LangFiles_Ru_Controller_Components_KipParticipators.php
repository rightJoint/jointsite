<?php

class LangFiles_Ru_Controller_Components_KipParticipators extends LangFiles_Ru_Controller_Records
{
    public string $moduleAlias = 'Участники';
    public function __construct()
    {
        $this->fieldAliases = array(
            'noteid' => 'Заметка',
            'participator' => 'Участник',
            'created_date' => 'Дт.созд',
            'created_by' => 'Создал',
            'created_name' => 'Создал',
        );
    }
}