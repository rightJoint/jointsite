<?php


namespace JointApp\Controllers\Components;


use JointApp\Controllers\ModuleController;

class Controller_Components_Sitemap extends ModuleController
{

    public string $moduleName = 'sitemap';

    public string $processUri = '/siteman/sitemap';

    public function loadBindComponents(): void
    {
        $this->bindComponents = array(
            "sitemapupdate" => [],
        );
    }
    public function loadLangController():string
    {
        parent::loadLangController();
        $name = 'LangFiles_'.$this->langNs.'_Controller_Components_Sitemap';
        require_once $this->docRoot.'/JointApp/LangFiles/Controllers/Components/'.$name.'.php';
        return $name;
    }

    public function prepareEditFields(): void
    {
        $this->editFields = array(
            'maploc'=> Array(
                'pri' => 1,
                'format' => 'varchar',
                'curVal' => '',
            ),
            'lastmod' => array(
                'format' => 'date',
                'curVal' => '',
            ),
            'changefreq' => array(
                'format' => 'varchar',
                'curVal' => '',
            ),
            'priority' => array(
                'format' => 'int',
                'curVal' => '',
            ),
            'comment' => array(
                'format' => 'varchar',
                'curVal' => '',
            ),
            'use_flag' => array(
                'format' => 'tinyint',
                'curVal' => '',
            ),
            'date_created' => array(
                'format' => 'datetime',
                'curVal' => '',
            ),
            'created_by' => array(
                'format' => 'varchar',
                'curVal' => '',
            ),
        );
    }

    public function prepareSearchFields(): void
    {
        $this->searchFields = array(
            'maploc'=> Array(
                'sort' => 1,
                'search' => 1,
                'format' => 'varchar',
            ),
            'lastmod' => array(
                'format' => 'date',
                'sort' => 1,
                'search' => 1,
            ),
            'changefreq' => array(
                'format' => 'varchar',
                'sort' => 1,
                'search' => 1,
            ),
            'priority' => array(
                'format' => 'int',
                'sort' => 1,
                'search' => 1,
            ),
            'comment' => array(
                'format' => 'varchar',
                'sort' => 1,
                'search' => 1,
            ),
            'use_flag' => array(
                'format' => 'tinyint',
                'sort' => 1,
                'search' => 1,
            ),
            'date_created' => array(
                'format' => 'datetime',
                'sort' => 1,
                'search' => 1,
            ),
            'created_by' => array(
                'format' => 'varchar',
                'sort' => 1,
                'search' => 1,
            ),
        );
    }

    public function prepareListFields(): void
    {
        $this->listFields = array(
            'btnDetail' => array(
                'replaces' => ['maploc'],
                'format' => 'link',
                'url' => 'maploc=maploc',
            ),
            'btnEdit' => array(
                'replaces' => ['maploc'],
                'format' => 'link',
                'url' => 'maploc=maploc',
            ),
            'btnDelete' => array(
                'replaces' => ['maploc'],
                'format' => 'link',
                'url' => 'maploc=maploc',
            ),
            'maploc'=> Array(
                'format' => 'varchar',
            ),
            'lastmod' => array(
                'format' => 'date',
            ),
            'changefreq' => array(
                'format' => 'varchar',
            ),
            'priority' => array(
                'format' => 'int',
            ),
            'comment' => array(
                'format' => 'varchar',
            ),
            'use_flag' => array(
                'format' => 'tinyint',
            ),
            'date_created' => array(
                'format' => 'datetime',
            ),
            'created_by' => array(
                'format' => 'varchar',
            ),
        );
    }

    public function siteMapUpdate()
    {
        $this->loadBindComponents();

        $this->view->bindComponents = $this->bindComponents;

        $this->view->moduleName = $this->moduleName;
    }
}