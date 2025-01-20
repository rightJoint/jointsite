<?php

class LangFiles_Ru_Controller_Components_MusicAlb extends LangFiles_Ru_Controller_Records
{
    public string $moduleAlias = 'Альбомы музыки';
    public function __construct()
    {
        $this->fieldAliases = array(
            'albumAlias' => 'ссылка',
            'albumName' => 'наимен.альб.',
            'created_by' => 'создал',
            'dateOfCr' => 'Дт.созд',
            'albumImg' => 'обложка',
            'activeFlag' => 'исп.',
            'refreshDate' => 'обновлено',
            'robIndex' => 'индек.',
            'accAlias' => 'создал',
        );
    }
}