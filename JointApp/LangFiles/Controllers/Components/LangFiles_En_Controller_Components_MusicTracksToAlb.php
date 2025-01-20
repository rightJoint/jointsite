<?php

class LangFiles_En_Controller_Components_MusicTracksToAlb extends LangFiles_En_Controller_Records
{
    public function __construct()
    {
        $this->moduleAlias = 'Tracks to albums';
        $this->fieldAliases = array(
            'track_name' => 'track',
            'albumName' => 'album',
            'accAlias' => 'created by',
        );
    }
}