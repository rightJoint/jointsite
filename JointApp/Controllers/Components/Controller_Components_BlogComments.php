<?php


namespace JointApp\Controllers\Components;


use JointApp\Controllers\ModuleController;

class Controller_Components_BlogComments extends ModuleController
{

    public string $moduleName = 'blogcomments';

    public string $processUri = '/siteman/blogcomments';

    const ART_COVERS = '/userdata/blog/covers';

    public function loadBindComponents(): void
    {
        $this->bindComponents = array(
            "blogtagstoarts" => [],
            "blogarts" => [],
            'blogtags' => [],
            'blogcats' => [],
        );
    }

    public function loadLangController():string
    {
        parent::loadLangController();
        $name = 'LangFiles_'.$this->langNs.'_Controller_Components_BlogComments';
        require_once $this->docRoot.'/JointApp/LangFiles/Controllers/Components/'.$name.'.php';
        return $name;
    }

    public function prepareEditFields(): void
    {
        $this->editFields = array(
            'comment_id' => array(
                'pri' => 1,
                'format' => 'varchar',
                'curVal' => '',
            ),
            'commentP_id' => array(
                'format' => 'varchar',
                'curVal' => '',
            ),
            'art_id' => array(
                'format' => 'varchar',
                'curVal' => '',
            ),
            'content' => array(
                'format' => 'tinymce',
                'id' => 'content',
                'curVal' => '',
                'style' => array(
                    'class' => 'wd100',
                ),
            ),
            'created_by' => array(
                'format' => 'varchar',
                'curVal' => '',
            ),
            'activeFlag' => array(
                'format' => 'tinyint',
                'curVal' => '',
            ),
            'addDate' => array(
                'format' => 'datetime',
                'curVal' => '',
            ),
        );
    }

    public function prepareSearchFields(): void
    {
        $this->searchFields = array(
            'comment_id' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
            ),
            'commentP_id' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
            ),
            'art_id' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
            ),
            /*'content' => array(
                'format' => 'text',
                'search' => 1,
                'sort' => 1,
            ),*/
            'created_by' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
            ),
            'activeFlag' => array(
                'format' => 'tinyint',
                'search' => 1,
                'sort' => 1,
            ),
            'addDate' => array(
                'format' => 'datetime',
                'search' => 1,
                'sort' => 1,
            ),
            'artName' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
                'group_by_field' => 'artName',
                'use_table_name' => '',
            ),
        );
    }

    public function prepareListFields(): void
    {
        $this->listFields = array(
            'btnDetail' => array(
                'replaces' => ['comment_id'],
                'format' => 'link',
                'url' => 'comment_id=comment_id',
            ),
            'btnEdit' => array(
                'replaces' => ['comment_id'],
                'format' => 'link',
                'url' => 'comment_id=comment_id',
            ),
            'btnDelete' => array(
                'replaces' => ['comment_id'],
                'format' => 'link',
                'url' => 'comment_id=comment_id',
            ),
            'artName' => array(
                'format' => 'varchar',
            ),
            'accAlias' => array(
                'format' => 'varchar',
            ),
            'addDate' => array(
                'format' => 'datetime',
            ),
            'activeFlag' => array(
                'format' => 'tinyint',
            ),
            'comment_id' => array(
                'format' => 'varchar',
            ),
            'commentP_id' => array(
                'format' => 'varchar',
            ),
            /*'art_id' => array(
                'format' => 'varchar',
            ),
            */
            /*'content' => array(
                'format' => 'text',
            ),*/
            /*'created_by' => array(
                'format' => 'varchar',
            ),
            */

        );
    }

    public function prepareViewFields(): void
    {
        echo 'prepareViewFields';
        parent::prepareViewFields();
        echo '<pre>';
        print_r($this->viewFields);
        exit;
    }
    /*
    public function fillCatsList():array
    {
        $findArts = 'select cat_id, catName_'.$this->langLw.' as catName from blogCats order by catName_'.$this->langLw;
        $return = array(
            '' => '',
        );
        $res = $this->model->pdoQuery($findArts);
        if($res->rowCount() > 0){
            while ($row = $res->fetch(\PDO::FETCH_ASSOC)){
                $return[$row['cat_id']] = $row['catName'];
            }
        }
        return $return;
    }
*/
}