<?php


namespace JointApp\Models\Components;


use JointApp\Models\ModuleModel;

class Model_Components_BlogTags extends ModuleModel
{
    public string $tableName = 'blogTags';

    public string $moduleName = 'blogtags';

    public function getRecordStructure()
    {

        $this->record = array(
            'tag_id' => array(
                'pri' => 1,
                'format' => 'varchar',
                'custom' => false,
            ),
            'tag_en' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'tag_ru' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'created_by' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
        );
    }
}