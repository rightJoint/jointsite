<?php


namespace JointApp\Models\Components;


use JointApp\Models\ModuleModel;

class Model_Components_Services extends ModuleModel
{
    public string $tableName = 'srvCards_dt';

    public string $moduleName = 'services';

    public function getRecordStructure()
    {
        $this->record = array(
            'card_id' => array(
                'pri' => true,
                'auto_increment' => true,
                'format' => 'int',
                'custom' => false,
            ),
            'cardName_ru' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'cardName_en' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'cardAlias' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'shortDescr_ru' => array(
                'format' => 'text',
                'custom' => false,
            ),
            'shortDescr_en' => array(
                'format' => 'text',
                'custom' => false,
            ),
            'longDescr_ru' => array(
                'format' => 'text',
                'custom' => false,
            ),
            'longDescr_en' => array(
                'format' => 'text',
                'custom' => false,
            ),
            'cardImg' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'cardActive' => array(
                'format' => 'tinyint',
                'custom' => false,
            ),
            'cardPrice_ru' => array(
                'format' => 'int',
                'custom' => false,
            ),
            'cardPrice_en' => array(
                'format' => 'int',
                'custom' => false,
            ),
            'cardCurr_ru' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'cardCurr_en' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'sortDate' => array(
                'format' => 'date',
                'custom' => false,
            ),
            'unit_ru' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'unit_en' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'created_by' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'createdUser' => array(
                'format' => 'varchar',
                'custom' => true,
            ),
        );
    }

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
}