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
                'format' => 'select',
                'curVal' => '',
                'filling' => array(
                    'monthly' => 'monthly',
                    'weekly' => 'weekly',
                    'yearly' => 'yearly',
                    'daily' => 'daily',
                    'hourly' => 'hourly',
                    'never' => 'never',
                    'always' => 'always',
                ),
            ),
            'priority' => array(
                'format' => 'select',
                'curVal' => '',
                'filling' => array(
                    5 => '0.5',
                    10 => '1.0',
                    9 => '0.9',
                    8 => '0.8',
                    7 => '0.7',
                    6 => '0.6',
                    4 => '0.4',
                    3 => '0.3',
                    2 => '0.2',
                    1 => '0.1',
                ),
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
                'format' => 'hidden',
            ),
            'created_by' => array(
                'format' => 'hidden',
            ),
        );
    }

    public function siteMapUpdate()
    {
        $this->loadBindComponents();

        $this->model->siteName = $this->siteName;

        $this->model->createSiteMap();

        $this->view->bindComponents = $this->bindComponents;

        $this->view->moduleName = $this->moduleName;
    }

    public function prepareViewParams(): void
    {
        parent::prepareViewParams(); // TODO: Change the autogenerated stub
        if($this->view->type == 'new'){
            $this->view->editFields['date_created']['curVal'] = date('Y-m-d');
            $this->view->editFields['use_flag']['curVal'] = 1;
        }
    }
}