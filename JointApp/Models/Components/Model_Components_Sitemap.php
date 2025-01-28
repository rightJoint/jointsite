<?php


namespace JointApp\Models\Components;


use JointApp\Models\ModuleModel;

class Model_Components_Sitemap extends ModuleModel
{
    public string $tableName = 'siteMap_dt';

    public string $moduleName = 'sitemap';

    public function getRecordStructure()
    {
        $this->record = array(
            'maploc'=> Array(
                'pri' => 1,
                'format' => 'varchar',
                'custom' => false,
            ),
            'lastmod' => array(
                'format' => 'date',
                'custom' => false,
            ),
            'changefreq' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'priority' => array(
                'format' => 'int',
                'custom' => false,
            ),
            'comment' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'use_flag' => array(
                'format' => 'tinyint',
                'custom' => false,
            ),
            'date_created' => array(
                'format' => 'datetime',
                'custom' => false,
            ),
            'created_by' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
        );
    }



    /*
    public function copyCustomFields(): bool
    {
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
        return true;
    }
    */
}