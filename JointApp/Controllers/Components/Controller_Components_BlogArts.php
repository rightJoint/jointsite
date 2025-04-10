<?php


namespace JointApp\Controllers\Components;


use JointApp\Controllers\ModuleController;

class Controller_Components_BlogArts extends ModuleController
{

    public string $moduleName = 'blogarts';

    public string $processUri = '/siteman/blogarts';

    const ART_COVERS = '/userdata/blog/covers';

    public function loadBindComponents(): void
    {
        $this->bindComponents = array(
            "blogtagstoarts" => array(
                "relationships" => array(
                    "art_id" => "art_id",
                ),
                'model' => 'JointApp\Models\Components\Model_Components_BlogTagsToArts',
                'controller' => 'JointApp\Controllers\Components\Controller_Components_BlogTagsToArts',
            ),
            'blogtags' => [],
            'blogcats' => [],
            'blogcomments' => [],
        );
    }

    public function loadLangController():string
    {
        parent::loadLangController();
        $name = 'LangFiles_'.$this->langNs.'_Controller_Components_BlogArts';
        require_once $this->docRoot.'/JointApp/LangFiles/Controllers/Components/'.$name.'.php';
        return $name;
    }

    public function prepareEditFields(): void
    {
        $this->editFields = array(
            'art_id' => array(
                'pri' => 1,
                'format' => 'varchar',
                'curVal' => '',
            ),
            'artCat' => array(
                'format' => 'select',
                'filling' => $this->fillCatsList(),
            ),
            'artRef' => array(
                'format' => 'varchar',
                'curVal' => '',
            ),
            'artName_en' => array(
                'format' => 'varchar',
                'curVal' => '',
            ),
            'artName_ru' => array(
                'format' => 'varchar',
                'curVal' => '',
            ),
            'artMeta_en' => array(
                'format' => 'text',
                'curVal' => '',
                'style' => array(
                    'class' => 'wd100',
                ),
            ),
            'artMeta_ru' => array(
                'format' => 'text',
                'curVal' => '',
                'style' => array(
                    'class' => 'wd100',
                ),
            ),
            'artImg' => array(
                'format' => 'file',
                'file_options' => array(
                    "load_dir" => self::ART_COVERS,
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
            'popFlag' => array(
                'format' => 'tinyint',
                'curVal' => '',
            ),
            'pubDate' => array(
                'format' => 'date',
                'curVal' => '',
            ),
            'refreshDate' => array(
                'format' => 'date',
                'curVal' => '',
            ),
            'created_by' => array(
                'format' => 'varchar',
                'curVal' => '',
            ),
            'commentsFlag' => array(
                'format' => 'tinyint',
                'curVal' => '',
            ),
        );
    }

    public function prepareSearchFields(): void
    {
        $this->searchFields = array(
            'pubDate' => array(
                'format' => 'date',
                'sort' => 1,
                'sortOrder' => 'DESC',
            ),
            'art_id' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
                'custom' => false,
            ),
            'artCat' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
            ),
            'artRef' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
            ),
            'artName_en' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
            ),
            'artName_ru' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
            ),
            'artMeta_en' => array(
                'format' => 'text',
                'search' => 1,
                'sort' => 1,
            ),
            'artMeta_ru' => array(
                'format' => 'text',
                'search' => 1,
                'sort' => 1,
            ),
            'artImg' => array(
                'format' => 'varchar',
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
            'popFlag' => array(
                'format' => 'tinyint',
                'search' => 1,
                'sort' => 1,
            ),
            'created_by' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
            ),
            'commentsFlag' => array(
                'format' => 'tinyint',
                'search' => 1,
            ),
        );
    }

    public function prepareListFields(): void
    {
        $this->listFields = array(
            'btnDetail' => array(
                'replaces' => ['art_id'],
                'format' => 'link',
                'url' => 'art_id=art_id',
            ),
            'btnEdit' => array(
                'replaces' => ['art_id'],
                'format' => 'link',
                'url' => 'art_id=art_id',
            ),
            'btnDelete' => array(
                'replaces' => ['art_id'],
                'format' => 'link',
                'url' => 'art_id=art_id',
            ),
            'art_id' => array(
                'format' => 'varchar',
            ),
            'catName' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'artCat' => array(
                'format' => 'hidden',
            ),
            'artRef' => array(
                'format' => 'varchar',
            ),
            'artName_en' => array(
                'format' => 'varchar',
                'max_length' => 10,
            ),
            'artName_ru' => array(
                'format' => 'varchar',
                'max_length' => 10,
            ),
            'artMeta_en' => array(
                'format' => 'text',
                'max_length' => 10,
            ),
            'artMeta_ru' => array(
                'format' => 'text',
                'max_length' => 10,
            ),
            'artImg' => array(
                'format' => 'file',
                'file_options' => array(
                    "load_dir" => self::ART_COVERS,
                    "file_type" => "img",
                ),
            ),
            'activeFlag' => array(
                'format' => 'tinyint',
            ),
            'indexFlag' => array(
                'format' => 'tinyint',
            ),
            'popFlag' => array(
                'format' => 'tinyint',
            ),
            'created_by' => array(
                'format' => 'hidden',
            ),
            'accAlias' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'commentsFlag' => array(
                'format' => 'tinyint',
            ),
        );
    }

    public function prepareViewFields(): void
    {
        $this->viewFields = array(
            'art_id' => array(
                'format' => 'varchar',
                'readonly' => 1,
            ),
            'artCat' => array(
                'format' => 'varchar',
                'readonly' => 1,
            ),
            'artRef' => array(
                'format' => 'varchar',
                'readonly' => 1,
            ),
            'artName_en' => array(
                'format' => 'varchar',
                'readonly' => 1,
            ),
            'artName_ru' => array(
                'format' => 'varchar',
                'readonly' => 1,
            ),
            'artMeta_en' => array(
                'format' => 'text',
                'readonly' => 1,
            ),
            'artMeta_ru' => array(
                'format' => 'text',
                'readonly' => 1,
            ),
            'artImg' => array(
                'format' => 'file',
                'file_options' => array(
                    "load_dir" => self::ART_COVERS,
                    'file_type' => 'img',
                    'button' => false,
                ),
                'readonly' => 1,
            ),
            'activeFlag' => array(
                'format' => 'tinyint',
                'readonly' => 1,
            ),
            'indexFlag' => array(
                'format' => 'tinyint',
                'readonly' => 1,
            ),
            'popFlag' => array(
                'format' => 'tinyint',
                'readonly' => 1,
            ),
            'pubDate' => array(
                'format' => 'date',
                'readonly' => 1,
            ),
            'refreshDate' => array(
                'format' => 'date',
                'readonly' => 1,
            ),
            'created_by' => array(
                'format' => 'varchar',
                'readonly' => 1,
            ),
            'commentsFlag' => array(
                'format' => 'tinyint',
            )
        );
    }
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

}