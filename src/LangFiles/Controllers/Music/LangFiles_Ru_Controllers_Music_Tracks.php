<?php
class LangFiles_Ru_Controllers_Music_Tracks extends LangFiles_Ru_Controller_Records
{
    public string $moduleAlias = 'Список трэков';

    public function __construct()
    {
        $this->fieldAliases = array(
            'track_name' => 'Трэк',
            'track_artist' => 'Исполнитель',
            'track_file' => 'файл',
            'accAlias' => 'создал',
            'track_id' => 'ид',
        );
    }
}