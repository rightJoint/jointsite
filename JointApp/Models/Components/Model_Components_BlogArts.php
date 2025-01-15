<?php


namespace JointApp\Models\Components;


use JointApp\Models\ModuleModel;

class Model_Components_BlogArts extends ModuleModel
{
    public string $tableName = 'blogArts';

    public string $moduleName = 'blogarts';

    const ART_COVERS = '/userdata/blog/covers';

    public function getRecordStructure()
    {
        $this->record = array(
            'art_id' => array(
                'pri' => 1,
                'format' => 'varchar',
                'custom' => false,
            ),
            'artCat' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'artRef' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'artName_en' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'artName_ru' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'artMeta_en' => array(
                'format' => 'text',
                'custom' => false,
            ),
            'artMeta_ru' => array(
                'format' => 'text',
                'custom' => false,
            ),
            'artImg' => array(
                'format' => 'file',
                'file_options' => array(
                    'accept' => '.jpg, .jpeg, .bmp, .git, .png',
                    'load_dir' => self::ART_COVERS.'/artImg',
                    'replaces' => ['artImg'],
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