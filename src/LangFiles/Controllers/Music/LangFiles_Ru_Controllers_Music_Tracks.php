<?php
class LangFiles_Ru_Controllers_Music_Tracks extends LangFiles_Ru_Controller_Records
{
    public function __construct()
    {
        parent::__construct();
        $this->moduleAlias = 'Список трэков';
        $this->fieldAliases = array(
            'albumName' => 'Альбом',
            'albumAlias' => 'ссылка',
            'dateOfCr' => 'Дт.созд',
        );

    }

}