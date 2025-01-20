<?php

class LangFiles_Ru_Controller_Components_MusicTracksToAlb extends LangFiles_Ru_Controller_Records
{
    public string $moduleAlias = 'Трэки в альбом';
    public function __construct()
    {
        $this->fieldAliases = array(
            'track_name' => 'трэк',
            'albumName' => 'альбом',
            'accAlias' => 'создал',
        );
    }
}