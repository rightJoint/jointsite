<?php


namespace JointApp\Models\Components;


use JointApp\Factories\ModelFactory;
use JointApp\JointAppQueryBuilder;
use JointApp\Models\ModuleModel;
use JointApp\Models\Records\RecordsModel;

class Model_Components_KipNotes extends ModuleModel
{
    public string $tableName = 'kipnotes';
    public string $moduleName = 'kipnotes';


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
            'taskid' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'created_name' => array(
                'format' => 'varchar',
                'custom' => true,
            ),
            'tasktitle' => array(
                'format' => 'varchar',
                'custom' => true,
            ),
            'progress' => array(
                'format' => 'varchar',
                'custom' => true,
            ),
        );
    }


    public function listRecords(JointAppQueryBuilder $qBuilder): array
    {

        $qBuilder->select = 'kipnotes.id, kipnotes.title, kipnotes.descr, kipnotes.created_date, kipnotes.created_by, '.
            'kipnotes.taskid, '.
            'users_dt.accAlias as created_name';

        $qBuilder
            ->from($this->tableName)
            ->join('left join users_dt on '.$this->tableName.'.created_by = users_dt.user_id');

        return $this->fetchToArray($qBuilder->buildQuery());
    }

    public function copyCustomFields(): bool
    {
        $findCreatedAlias_qry = 'select title, progress from kiptasks where id="'.$this->record['taskid']['curVal'].'"';
        $findCreatedAlias_arr = $this->fetchToArray($findCreatedAlias_qry);
        if(count($findCreatedAlias_arr)){
            $this->record['tasktitle']['curVal'] = $findCreatedAlias_arr[0]['title'];
            $this->record['progress']['curVal'] = $findCreatedAlias_arr[0]['progress'];
        }

        $findCreatedAlias_qry = 'select accAlias from users_dt where created_by="'.$this->record['created_by']['curVal'].'"';
        $findCreatedAlias_arr = $this->fetchToArray($findCreatedAlias_qry);
        if(count($findCreatedAlias_arr)){
            $this->record['created_name']['curVal'] = $findCreatedAlias_arr[0]['accAlias'];
        }

        return true;
    }

    public function insertCustomFields(): bool
    {
        $task = ModelFactory::createFromExistModel('JointApp\Models\Records\RecordsModel', $this, ['tableName'=>'kiptasks']);
        $task->record['id']['curVal'] = $this->record['taskid']['curVal'];
        $task->copyRecord();
        if($task->record['progress']['curVal'] != $this->record['progress']['curVal']){
            $task->record['progress']['curVal'] = $this->record['progress']['curVal'];
            $task->updateRecord();
        }
        return true;
    }

    public function updateCustomFields(): bool
    {
        $this->insertCustomFields();
        return true;
    }
}