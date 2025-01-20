<?php

class LangFiles_En_Controller_Components_MusicTracksToAlb extends LangFiles_En_Controller_Records
{
    public string $moduleAlias = 'Tracks to albums';

    public function __construct()
    {
        $this->fieldAliases = array(
            'track_name' => 'track',
            'albumName' => 'album',
            'accAlias' => 'created by',
        );
    }
}