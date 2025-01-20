<?php

class LangFiles_Ru_Controller_Components_MusicTracksToAlb extends LangFiles_Ru_Controller_Records
{
    public function __construct()
    {
        $this->moduleAlias = 'Трэки в альбом';
        $this->fieldAliases = array(
            'track_name' => 'трэк',
            'albumName' => 'альбом',
            'accAlias' => 'создал',
        );
    }
}