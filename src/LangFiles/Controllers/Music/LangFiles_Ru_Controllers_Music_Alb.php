<?php
class LangFiles_Ru_Controllers_Music_Alb extends LangFiles_Ru_Controller_Records
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