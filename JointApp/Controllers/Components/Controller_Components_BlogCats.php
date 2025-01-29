<?php


namespace JointApp\Controllers\Components;


use JointApp\Controllers\ModuleController;

class Controller_Components_BlogCats extends ModuleController
{

    public string $moduleName = 'blogcats';

    public string $processUri = '/siteman/blogcats';

    const BLOG_CATS_IMG = '/userdata/blog/cats';

    public function loadBindComponents(): void
    {
        $this->bindComponents = array(
            'blogarts' => [],
            'blogtags' => [],
            'blogtagstoarts' => [],
        );
    }

    public function loadLangController():string
    {
        parent::loadLangController();
        $name = 'LangFiles_'.$this->langNs.'_Controller_Components_BlogCats';
        require_once $this->docRoot.'/JointApp/LangFiles/Controllers/Components/'.$name.'.php';
        return $name;
    }

    public function prepareEditFields(): void
    {

                $this->editFields = array(
                    'cat_id' => array(
                        'pri' => 1,
                        'format' => 'varchar',
                        'curVal' => '',
                    ),
                    'catAlias' => array(
                        'format' => 'varchar',
                        'curVal' => '',
                    ),
                    'catName_en' => array(
                        'format' => 'varchar',
                        'curVal' => '',
                    ),
                    'catName_ru' => array(
                        'format' => 'varchar',
                        'curVal' => '',
                    ),
                    'catMeta_en' => array(
                        'format' => 'text',
                        'curVal' => '',
                    ),
                    'catMeta_ru' => array(
                        'format' => 'text',
                        'curVal' => '',
                    ),
                    'catImg' => array(
                        'format' => 'file',
                        'file_options' => array(
                            "load_dir" => self::BLOG_CATS_IMG,
                            'file_type' => 'img',
                            'accept' => '.jpg, .jpeg, .bmp, .git, .png',
                            'button' => true,
                        ),
                        'with_name' => 'GUID',
                        'curVal' => '',
                    ),
                    'activeFlag' => array(
                        'format' => 'tinyint',
                        'curVal' => '',
                    ),
                    'indexFlag' => array(
                        'format' => 'tinyint',
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
            'cat_id' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
            ),
            'catAlias' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
            ),
            'catName_en' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
            ),
            'catName_ru' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
            ),
            'catMeta_en' => array(
                'format' => 'text',
                'search' => 1,
                'sort' => 1,
            ),
            'catMeta_ru' => array(
                'format' => 'text',
                'search' => 1,
                'sort' => 1,
            ),
            'activeFlag' => array(
                'format' => 'tinyint',
                'search' => 1,
                'sort' => 1,
            ),
            'indexFlag' => array(
                'format' => 'tinyint',
                'search' => 1,
                'sort' => 1,
            ),
            'created_by' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
            ),
        );

    }

    public function prepareListFields(): void
    {
        $this->listFields = array(
            'btnDetail' => array(
                'replaces' => ['cat_id'],
                'format' => 'link',
                'url' => 'cat_id=cat_id',
            ),
            'btnEdit' => array(
                'replaces' => ['cat_id'],
                'format' => 'link',
                'url' => 'cat_id=cat_id',
            ),
            'btnDelete' => array(
                'replaces' => ['cat_id'],
                'format' => 'link',
                'url' => 'cat_id=cat_id',
            ),
            'cat_id' => array(
                'format' => 'varchar',
            ),
            'catAlias' => array(
                'format' => 'varchar',
            ),
            'catName_en' => array(
                'format' => 'varchar',
            ),
            'catName_ru' => array(
                'format' => 'varchar',
            ),
            'catMeta_en' => array(
                'format' => 'text',
                'max_length' => 10,
            ),
            'catMeta_ru' => array(
                'format' => 'text',
                'max_length' => 10,
            ),
            'catImg' => array(
                'format' => 'file',
                'file_options' => array(
                    "load_dir" => self::BLOG_CATS_IMG,
                    "file_type" => "img",
                ),
            ),
            'activeFlag' => array(
                'format' => 'tinyint',
            ),
            'indexFlag' => array(
                'format' => 'tinyint',
            ),
            'created_by' => array(
                'format' => 'varchar',
            ),
        );
    }
}