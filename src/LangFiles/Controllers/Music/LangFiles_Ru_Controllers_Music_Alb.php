<?php
class LangFiles_Ru_Controllers_Music_Alb extends LangFiles_Ru_Controller_Records
{
    public function __construct()
    {
        parent::__construct();
        $this->moduleAlias = 'Альбомы музыки';
        $this->fieldAliases = array(
            'albumName' => 'Альбом',
            'albumAlias' => 'ссылка',
            'dateOfCr' => 'Дт.созд',
        );

    }

}