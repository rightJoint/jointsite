<?php
class LangFiles_En_Controllers_Music_Alb extends LangFiles_En_Controller_Records
{
    public string $moduleAlias = 'Альбомы музыки';

    public function __construct()
    {
        $this->fieldAliases = array(
            'albumName' => 'Альбом',
            'albumAlias' => 'ссылка',
            'dateOfCr' => 'Дт.созд',
        );

    }

}