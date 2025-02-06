<?php


namespace JointApp\Controllers\Components;


use JointApp\Controllers\ModuleController;

class Controller_Components_BlogTags extends ModuleController
{

    public string $moduleName = 'blogtags';

    public string $processUri = '/siteman/blogtags';

    //const ART_COVERS = '/userdata/blog/covers';

    public function loadBindComponents(): void
    {
        $this->bindComponents = array(
            "blogtagstoarts" => array(
                "relationships" => array(
                    "tag_id" => "tag_id",
                ),
                'model' => 'JointApp\Models\Components\Model_Components_BlogTagsToArts',
                'controller' => 'JointApp\Controllers\Components\Controller_Components_BlogTagsToArts',
            ),
            "blogarts" => [],
            'blogcats' => [],
            "blogcomments" => [],
        );
    }

    public function loadLangController():string
    {
        parent::loadLangController();
        $name = 'LangFiles_'.$this->langNs.'_Controller_Components_BlogTags';
        require_once $this->docRoot.'/JointApp/LangFiles/Controllers/Components/'.$name.'.php';
        return $name;
    }

    public function prepareEditFields(): void
    {
        $this->editFields = array(
            'tag_id' => array(
                'format' => 'varchar',
                'curVal' => '',
                'pri' => 1,
            ),
            'tag_en' => array(
                'format' => 'varchar',
                'curVal' => '',
            ),
            'tag_ru' => array(
                'format' => 'varchar',
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
            'tag_id' => array(
                'format' => 'hidden',
                'search' => 0,
                'sort' => 0,
            ),
            'tag_en' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
            ),
            'tag_ru' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
            ),
            'created_by' => array(
                'format' => 'hidden',
                'search' => 0,
                'sort' => 0,
            ),
        );
    }

    public function prepareListFields(): void
    {

        $this->listFields = array(
            'btnDetail' => array(
                'replaces' => ['tag_id'],
                'format' => 'link',
                'url' => 'tag_id=tag_id',
            ),
            'btnEdit' => array(
                'replaces' => ['tag_id'],
                'format' => 'link',
                'url' => 'tag_id=tag_id',
            ),
            'btnDelete' => array(
                'replaces' => ['tag_id'],
                'format' => 'link',
                'url' => 'tag_id=tag_id',
            ),
            'tag_id' => array(
                'format' => 'hidden',
            ),
            'tag_en' => array(
                'format' => 'varchar',
            ),
            'tag_ru' => array(
                'format' => 'varchar',
            ),
            'created_by' => array(
                'format' => 'hidden',
            ),
        );
    }


}