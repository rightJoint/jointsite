<?php

class LangFiles_Ru_Controller_Components_KipTasks extends LangFiles_Ru_Controller_Records
{
    public string $moduleAlias = 'Задачи КИПиА';
    public function __construct()
    {
        $this->fieldAliases = array(
            'id' => 'ссылка',
            'title' => 'Заголовок',
            'descr' => 'Описание',
            'created_date' => 'Дт.созд',
            'priority' => 'Важность',
            'status' => 'Статус',
            'progress' => 'Прогресс',
            'object' => 'Объект.',
            'system' => 'Система',
            'subsystem' => 'ПодСистема',
            'tasktype' => 'Тип',
            'created_by' => 'Создал',
            'created_name' => 'Создал',
        );
    }
}