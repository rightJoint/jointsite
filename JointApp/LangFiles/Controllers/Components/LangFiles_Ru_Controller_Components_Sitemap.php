<?php

class LangFiles_Ru_Controller_Components_Sitemap extends LangFiles_Ru_Controller_Records
{
    public string $moduleAlias = 'Карта сайта';
    public function __construct()
    {
        $this->fieldAliases = array(
            'maploc' => 'uri',
            'lastmod' => 'дт.изм',
            'changefreq' => 'частота',
            'priority' => 'приоритет',
            'comment' => 'коммент.',
            'use_flag' => 'исп.',
            'date_created' => 'дт.созд.',
            'created_by' => 'создал id',
        );
    }
}