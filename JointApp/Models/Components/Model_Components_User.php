<?php


namespace JointApp\Models\Components;


use JointApp\JointAppQueryBuilder;
use JointApp\Models\ModuleModel;
use JointApp\Models\Records\RecordsModel;

class Model_Components_User extends ModuleModel
{
    public string $tableName = 'users_dt';
    public string $moduleName = 'users';

    public function getRecordStructure()
    {
        $this->record = array(
            'user_id' => array(
                'pri' => 1,
                'format' => 'varchar',
                'custom' => false,
            ),
            'accLogin' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'accAlias' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'pw_hash' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'vldCode' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'regDate' => array(
                'format' => 'datetime',
                'custom' => false,
            ),
            'netWork' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'validDate' => array(
                'format' => 'datetime',
                'custom' => false,
            ),
            'photoLink' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'eMail' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'birthDay' => array(
                'format' => 'date',
                'custom' => false,
            ),
            'socProf' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'blackList' => array(
                'format' => 'tinyint',
                'custom' => false,
            ),
            'created_by' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'is_admin' => array(
                'format' => 'tinyint',
                'custom' => false,
            ),
            'send_ntf' => array(
                'format' => 'tinyint',
                'custom' => false,
            ),
            'pref_lang' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'created_user' => array(
                'format' => 'varchar',
                'custom' => true,
            ),
        );
    }

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
}