<?php


namespace JointApp\Models\Components;


use JointApp\JointAppQueryBuilder;
use JointApp\Models\ModuleModel;
use JointApp\Models\Records\RecordsModel;

class Model_Components_KipTasks extends ModuleModel
{
    public string $tableName = 'kiptasks';
    public string $moduleName = 'kiptasks';

    public function getRecordStructure()
    {
        $this->record = array(
            'id' => array(
                'pri' => 1,
                'format' => 'varchar',
                'custom' => false,
            ),
            'title' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'descr' => array(
                'format' => 'text',
                'custom' => false,
            ),
            'created_date' => array(
                'format' => 'datetime',
                'custom' => false,
            ),
            'created_by' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'priority' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'status' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'progress' => array(
                'format' => 'int',
                'custom' => false,
            ),
            'object' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'system' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'subsystem' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'tasktype' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'created_name' => array(
                'format' => 'varchar',
                'custom' => true,
            ),
        );
    }

    public function listRecords(JointAppQueryBuilder $qBuilder): array
    {

        $qBuilder->select = 'kiptasks.id, kiptasks.title, kiptasks.descr, kiptasks.created_date, kiptasks.created_by, '.
            'kiptasks.priority, kiptasks.status, kiptasks.progress, kiptasks.object, kiptasks.system, '.
            'kiptasks.subsystem, kiptasks.tasktype, '.
            'users_dt.accAlias as created_name';

        $qBuilder
            ->from($this->tableName)
        ->join('left join users_dt on '.$this->tableName.'.created_by = users_dt.user_id');

        return $this->fetchToArray($qBuilder->buildQuery());
    }

    public function copyCustomFields(): bool
    {
        $findCreatedAlias_qry = 'select accAlias from users_dt where created_by="'.$this->record['created_by']['curVal'].'"';
        $findCreatedAlias_arr = $this->fetchToArray($findCreatedAlias_qry);
        if(count($findCreatedAlias_arr)){
            $this->record['created_name']['curVal'] = $findCreatedAlias_arr[0]['accAlias'];
        }
        return true;
    }


}