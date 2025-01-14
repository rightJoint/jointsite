<?php

class LangFiles_En_Controller_Components_MusicAlb extends LangFiles_En_Controller_Records
{
    public function __construct()
    {
        parent::__construct();
        $this->moduleAlias = 'Альбомы музыки';
        $this->fieldAliases = array(
            //'track_id' => 'id',
            'albumAlias' => 'ссылка',
            'albumName' => 'наимен.альб.',
            'created_by' => 'создал',
            //'track_file' => 'файл трэка',
            'dateOfCr' => 'Дт.созд',
            'albumImg' => 'обложка',
            'activeFlag' => 'исп.',
            'refreshDate' => 'обновлено',
            'robIndex' => 'индек.',
            //'sortDate' => 'Дт. сорт',
            //'created_by' => 'создал',
            'accAlias' => 'создал',
        );

    }


}