<?php


namespace JointApp\Models\Components;


use JointApp\JointAppQueryBuilder;
use JointApp\Models\ModuleModel;

class Model_Components_Robots extends ModuleModel
{
    public string $tableName = 'robots_dt';

    public string $moduleName = 'robots';

    public string $siteName = '';

    public function getRecordStructure()
    {
        $this->record = array(
            'maploc'=> Array(
                'pri' => 1,
                'format' => 'varchar',
                'custom' => false,
            ),
            'indexVal' => array(
                'format' => 'varchar',
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

    public function createRobotsTxt():void
    {
        $qBuilder = new JointAppQueryBuilder();
        $qBuilder->select(
            $this->tableName.'.maploc, '.
            $this->tableName.'.indexVal'
        )
        ->from(
            $this->tableName
        )
        ->where(
            $this->tableName.'.use_flag is true'
        )
        ->order(
            $this->tableName.'.maploc'
        );

        $res = $this->fetchToArray($qBuilder->buildQuery());

        $txt = 'User-agent: *'."\n";

        foreach ($res as $num => $row) {
            //dont use siteName, fix robots.txt
            //$txt .= $row['indexVal'] . ': '.$this->siteName . $row['maploc'] . "\n";
            $txt .= $row['indexVal'] . ': '. $row['maploc'] . "\n";
        }


        file_put_contents($this->docRoot.'/robots.txt', $txt);
    }

}