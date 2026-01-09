<?php

class LangFiles_Ru_Controller_Components_KipNotes extends LangFiles_Ru_Controller_Records
{
    public string $moduleAlias = 'Заметки';
    public function __construct()
    {
        $this->fieldAliases = array(
            'id' => 'ссылка',
            'title' => 'Заголовок',
            'descr' => 'Описание',
            'created_date' => 'Дт.созд',
            'created_by' => 'Создал',
            'created_name' => 'Создал',
            'progress' => 'Прогресс',
        );
    }
}