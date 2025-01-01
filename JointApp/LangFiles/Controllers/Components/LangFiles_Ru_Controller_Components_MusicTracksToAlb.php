<?php

class LangFiles_Ru_Controller_Components_MusicTracksToAlb extends LangFiles_Ru_Controller_Records
{
    public function __construct()
    {
        parent::__construct();
        $this->moduleAlias = 'Список трэков';
        $this->fieldAliases = array(
            //'track_id' => 'id',
            'track_name' => 'трэк',
            'albumName' => 'альбом',
            'accAlias' => 'создал',
            //'track_file' => 'файл трэка',
            //'loadDate' => 'Дт.загр',
            //'sortDate' => 'Дт. сорт',
            //'created_by' => 'создал',
            //'created_alias' => 'создал',
        );

    }


}