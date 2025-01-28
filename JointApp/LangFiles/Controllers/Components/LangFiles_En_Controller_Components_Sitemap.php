<?php

class LangFiles_En_Controller_Components_Sitemap extends LangFiles_En_Controller_Records
{
    public string $moduleAlias = 'Карта сайта';
    public function __construct()
    {
        $this->fieldAliases = array(
            'maploc' => 'loc',
            'lastmod' => 'lastmod',
            'changefreq' => 'changefreq',
            'priority' => 'priority',
            'comment' => 'comment.',
            'use_flag' => 'use',
            'date_created' => 'created dt',
            'created_by' => 'created id',
        );
    }
}