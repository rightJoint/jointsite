<?php

class LangFiles_Ru_Controller_Components_MusicTracks extends LangFiles_Ru_Controller_Records
{
    public string $moduleAlias = 'Список трэков';
    public function __construct()
    {
        $this->fieldAliases = array(
            'track_id' => 'id',
            'track_name' => 'Название',
            'track_artist' => 'Исполнитель',
            'track_file' => 'файл трэка',
            'loadDate' => 'Дт.загр',
            'sortDate' => 'Дт. сорт',
            'created_by' => 'создал',
            'created_alias' => 'создал',
        );
    }
}