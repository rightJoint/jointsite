<?php


namespace JointApp\Models\Components;


use JointApp\Controllers\Components\Controller_Components_KipTasks;
use JointApp\JointAppQueryBuilder;
use JointApp\Models\ModuleModel;

class Model_Components_KipPlan extends ModuleModel
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
            'ordernum' => array(
                'format' => 'varchar',
                'custom' => true,
            ),
        );
    }

    public function listRecords(JointAppQueryBuilder $qBuilder): array
    {
        $qBuilder->limit = '';
        $qBuilder->select('1 as ordernum, kiptasks.id, kiptasks.title, kiptasks.descr, kiptasks.created_date, kiptasks.created_by, '.
            'kiptasks.priority, kiptasks.status, kiptasks.progress, kiptasks.object, kiptasks.system, '.
            'kiptasks.subsystem, kiptasks.tasktype, '.
            'users_dt.accAlias as created_name');

        $qBuilder
            ->from($this->tableName)
            ->join('left join users_dt on '.$this->tableName.'.created_by = users_dt.user_id')
            ->where('kiptasks.status not in ("completed")')
            ->order('kiptasks.created_date desc');

        $listRecords = $this->fetchToArray($qBuilder->buildQuery());
        $listRecords_new = [];

        foreach ($listRecords as $rowNum => $row){
            $newRow = $this->trimRowReport($row);
            $newRow['ordernum']=$rowNum+1;
            $listRecords_new[] = $newRow;
        }

        return $listRecords_new;
    }

    private function trimRowReport(array $row):array
    {
        $return = [];

        if($row['object'] == 'strokino'){
            $obj_ans_sys = Controller_Components_KipTasks::fillKipObjects()[$row['object']].'-';
        }elseif($row['object'] == 'all'){
            $obj_ans_sys = '';
        }elseif($row['object'] == 'gts'){
            $obj_ans_sys = Controller_Components_KipTasks::fillKipObjects()[$row['object']].'-';
        }
        else{
            $obj_ans_sys = Controller_Components_KipTasks::fillKipObjects()[$row['object']].'-'.
                Controller_Components_KipTasks::fillKipSystem()[$row['system']].'-';
        }

        $return['fulltitle'] = '<b>'.Controller_Components_KipTasks::fillKipTaskTypes()[$row['tasktype']].'-'.
            $obj_ans_sys.$row['title'].'</b>'.
            $row['descr'];
        $return['status'] = Controller_Components_KipTasks::fillKipTaskStatus()[$row['status']].'<br>'.$row['progress'].' %';

        return $return;
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