<?php


namespace JointApp\Models\Components;


use JointApp\Models\ModuleModel;

class Model_Components_BlogCats extends ModuleModel
{
    public string $tableName = 'blogCats';

    public string $moduleName = 'blogcats';

    const BLOG_CATS_IMG = '/userdata/blog/cats';

    public function getRecordStructure()
    {
        $this->record = array(
            'cat_id' => array(
                'pri' => 1,
                'format' => 'varchar',
                'custom' => false,
            ),
            'catAlias' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'catName_en' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'catName_ru' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'catMeta_en' => array(
                'format' => 'text',
                'custom' => false,
            ),
            'catMeta_ru' => array(
                'format' => 'text',
                'custom' => false,
            ),
            'catImg' => array(
                'format' => 'file',
                'file_options' => array(
                    'accept' => '.jpg, .jpeg, .bmp, .git, .png',
                    'load_dir' => self::BLOG_CATS_IMG.'/catImg',
                    'replaces' => ['catImg'],
                ),
                'custom' => false,
            ),
            'activeFlag' => array(
                'format' => 'tinyint',
                'custom' => false,
            ),
            'indexFlag' => array(
                'format' => 'tinyint',
                'custom' => false,
            ),
            'created_by' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
        );
    }

    public function copyCustomFields(): bool
    {
        /*
        if(!empty($this->record['created_by']['curVal'])){
            $userAlias_q = 'select accAlias from users_dt where user_id="'.$this->record['created_by']['curVal'].'"';
            $userAlias_res = $this->pdoQuery($userAlias_q);
            if($userAlias_res->rowCount() == 1){
                $userAlias_row = $userAlias_res->fetch(self::FETCH_ASSOC);
                $this->record['createdUser']['curVal'] = $userAlias_row['accAlias'];
            }else{
                return false;
            }
        }
        */
        return true;
    }
}