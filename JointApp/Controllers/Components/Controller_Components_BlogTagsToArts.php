<?php


namespace JointApp\Controllers\Components;


use JointApp\Controllers\ModuleController;

class Controller_Components_BlogTagsToArts extends ModuleController
{

    public string $moduleName = 'blogtagstoarts';

    public string $processUri = '/siteman/blogtagstoarts';

    public function loadBindComponents(): void
    {
        $this->bindComponents = array(
            'blogarts' => [],
            'blogtags' => [],
            'blogcats' => [],
            'blogcomments' => [],
        );
    }

    public function loadLangController():string
    {
        parent::loadLangController();
        $name = 'LangFiles_'.$this->langNs.'_Controller_Components_BlogTagsToArts';
        require_once $this->docRoot.'/JointApp/LangFiles/Controllers/Components/'.$name.'.php';
        return $name;
    }

    public function prepareEditFields(): void
    {

        $this->editFields = array(
            'tag_id' => array(
                'format' => 'select',
                'curVal' => '',
                'pri' => 1,
                'filling' => $this->fillTagsList(),
            ),
            'art_id' => array(
                'format' => 'select',
                'curVal' => '',
                'filling' => $this->fillArtsList(),
                'pri' => 1,
            ),
            'created_by' => array(
                'format' => 'varchar',
                'curVal' => '',
            ),
        );
    }

    public function fillTagsList():array
    {
        $findTags = 'select tag_id, tag_'.$this->langLw.' as tagName from blogTags order by tag_'.$this->langLw;
        $return = array(
            '' => '',
        );
        $res = $this->model->pdoQuery($findTags);
        if($res->rowCount() > 0){
            while ($row = $res->fetch(\PDO::FETCH_ASSOC)){
                $return[$row['tag_id']] = $row['tagName'];
            }
        }
        return $return;
    }

    public function fillArtsList():array
    {
        $findArts = 'select art_id, artName_'.$this->langLw.' as artName from blogArts order by artName_'.$this->langLw;
        $return = array(
            '' => '',
        );
        $res = $this->model->pdoQuery($findArts);
        if($res->rowCount() > 0){
            while ($row = $res->fetch(\PDO::FETCH_ASSOC)){
                $return[$row['art_id']] = $row['artName'];
            }
        }
        return $return;
    }

    public function prepareSearchFields(): void
    {
        $this->searchFields = array(
            'tag_id' => array(
                'format' => 'hidden',
                'search' => 1,
                'sort' => 1,
            ),
            'art_id' => array(
                'format' => 'hidden',
                'search' => 1,
                'sort' => 1,
            ),
            'created_by' => array(
                'format' => 'hidden',
                'search' => 0,
                'sort' => 0,
            ),

            'artName' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
                'group_by_field' => 'artName',
                'use_table_name' => '',
            ),
            'tagName' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
                'group_by_field' => 'tagName',
            ),
        );
    }

    public function prepareListFields(): void
    {

        $this->listFields = array(
            'btnDetail' => array(
                'replaces' => ['tag_id', 'art_id'],
                'format' => 'link',
                'url' => 'tag_id=tag_id&art_id=art_id',
            ),
            'btnEdit' => array(
                'replaces' => ['tag_id', 'art_id'],
                'format' => 'link',
                'url' => 'tag_id=tag_id&art_id=art_id',
            ),
            'btnDelete' => array(
                'replaces' => ['tag_id', 'art_id'],
                'format' => 'link',
                'url' => 'tag_id=tag_id&art_id=art_id',
            ),
            'tag_id' => array(
                'format' => 'hidden',
            ),
            'art_id' => array(
                'format' => 'hidden',
            ),
            'created_by' => array(
                'format' => 'hidden',
            ),
            'artName' => array(
                'format' => 'varchar',
            ),
            'tagName' => array(
                'format' => 'varchar',
            ),
        );
    }
}