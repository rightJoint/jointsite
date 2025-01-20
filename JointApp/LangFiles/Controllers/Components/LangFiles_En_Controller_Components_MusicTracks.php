<?php

class LangFiles_En_Controller_Components_MusicTracks extends LangFiles_En_Controller_Records
{
    public string $moduleAlias = 'Track list';
    public function __construct()
    {
        $this->fieldAliases = array(
            'track_id' => 'id',
            'track_name' => 'track name',
            'track_artist' => 'artist',
            'track_file' => 'file melody',
            'loadDate' => 'load date',
            'sortDate' => 'sort date',
            'created_by' => 'created id',
            'created_alias' => 'created by',
        );
    }
}