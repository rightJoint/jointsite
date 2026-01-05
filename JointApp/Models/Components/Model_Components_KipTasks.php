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
        );
    }
/*
    public function listRecords(JointAppQueryBuilder $qBuilder): array
    {

        $qBuilder->select = 'users_dt.user_id, users_dt.accLogin, users_dt.accAlias, users_dt.pw_hash, users_dt.vldCode, '.
            'users_dt.regDate, users_dt.netWork, users_dt.validDate, users_dt.photoLink, users_dt.eMail, '.
            'users_dt.birthDay, users_dt.socProf, users_dt.blackList, '.
            'users_dt.created_by, users_dt.is_admin, users_dt.send_ntf, users_dt.pref_lang, createdUser_dt.accAlias as created_user';



        $qBuilder
            ->from($this->tableName)
        ->join('left join users_dt createdUser_dt on '.$this->tableName.'.created_by = createdUser_dt.user_id');
        //echo $qBuilder->buildQuery();
        //exit;


        return $this->fetchToArray($qBuilder->buildQuery());
    }
*/
}