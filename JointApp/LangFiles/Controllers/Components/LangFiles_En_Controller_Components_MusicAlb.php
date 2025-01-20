<?php

class LangFiles_En_Controller_Components_MusicAlb extends LangFiles_En_Controller_Records
{
    public function __construct()
    {
        parent::__construct();
        $this->moduleAlias = 'Music albums';
        $this->fieldAliases = array(
            'albumAlias' => 'link',
            'albumName' => 'alb.name',
            'created_by' => 'created_id',
            'dateOfCr' => 'created date',
            'albumImg' => 'cover',
            'activeFlag' => 'use.',
            'refreshDate' => 'updated',
            'robIndex' => 'index',
            'accAlias' => 'created by',
        );
    }
}