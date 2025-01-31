<?php


namespace JointApp\Models\User;



use JointApp\JointAppQueryBuilder;
use JointApp\Models\Records\RecordsModel;

class Model_User_Notifications extends RecordsModel
{
    public string $tableName = 'ntfRead_dt';

    public function getRecordStructure()
    {
        $this->record = array(
            'ntf_id' => array(
                'pri' => 1,
                'format' => 'varchar',
                'custom' => false,
            ),
            'user_id' => array(
                'pri' => 1,
                'format' => 'varchar',
                'custom' => false,
            ),
            'read_date' => array(
                'format' => 'datetime',
                'custom' => false,
            ),
            'put_date' => array(
                'format' => 'datetime',
                'custom' => false,
            ),
            'send_flag' => array(
                'format' => 'tinyint',
                'custom' => false,
            ),
            'del_flag' => array(
                'format' => 'tinyint',
                'custom' => false,
            ),
            'subscriber_type' => array(
                'format' => 'varchar',
                'custom' => 1,
            ),
            'tName' => array(
                'format' => 'varchar',
                'custom' => 1,
            ),
            'tHeader' => array(
                'format' => 'varchar',
                'custom' => 1,
            ),
            'tBody' => array(
                'format' => 'varchar',
                'custom' => 1,
                'template_params' => [],
            ),
        );
    }

    public function listRecords(JointAppQueryBuilder $qBuilder): array
    {
        global $currentUser;

        $user_where = 'user_id = "'.$currentUser->user_id.'" and del_flag is null';
        if(!empty($qBuilder->where)){
            $qBuilder->where.=' and '.$user_where;
        }else{
            $qBuilder->where = $user_where;
        }

        $qBuilder->select(
            $this->tableName.'.ntf_id, '.
            $this->tableName.'.user_id, '.
            $this->tableName.'.read_date, '.
            $this->tableName.'.put_date, '.
            $this->tableName.'.send_flag, '.
            'ntfList_dt.subscriber_type, '.
            'ntfTemplates_dt.tHeader_'.$this->langLw.' as tHeader'
        )
        ->from($this->tableName)
        ->join(
            'inner join ntfList_dt on ntfList_dt.ntf_id = '.$this->tableName.'.ntf_id '.
            'inner join ntfTemplates_dt on ntfTemplates_dt.template_id = ntfList_dt.template_id'
        );
        return $this->fetchToArray($qBuilder->buildQuery());
    }

    public function countRecords(JointAppQueryBuilder $qBuilder): int
    {
        global $currentUser;
        $user_where = 'user_id = "'.$currentUser->user_id.'" and del_flag is null';
        if(!empty($qBuilder->where)){
            $qBuilder->where.=' and '.$user_where;
        }else{
            $qBuilder->where = $user_where;
        }

        $qBuilder->select(
            'count('.$this->tableName.'.ntf_id) as cnt, '.
            'ntfTemplates_dt.tHeader_'.$this->langLw.' as tHeader'
        )
            ->from($this->tableName)
            ->join(
                'inner join ntfList_dt on ntfList_dt.ntf_id = '.$this->tableName.'.ntf_id '.
                'inner join ntfTemplates_dt on ntfTemplates_dt.template_id = ntfList_dt.template_id'
            );
        if($res = $this->pdoQuery($qBuilder->buildQuery())){
            $res = $res->fetch(\PDO::FETCH_ASSOC);
            if(isset($res['cnt'])){
                return $res['cnt'];
            }
        }

        return 0;
    }

    public function copyCustomFields(): bool
    {
        $list = $this->fetchToArray('select * from ntfList_dt where ntf_id="'.$this->record['ntf_id']['curVal'].'"')[0];
        $template = $this->fetchToArray('select * from ntfTemplates_dt where template_id="'.$list['template_id'].'"')[0];
        $this->record['subscriber_type']['curVal'] = $list['subscriber_type'];
        $this->record['tName']['curVal'] = $template['tName'];
        $this->record['tHeader']['curVal'] = $template['tHeader_'.$this->langLw];
        $this->record['tBody']['curVal'] = $template['tBody_'.$this->langLw];
        $this->record['tBody']['template_params'] = $list['template_params'];

        return true;
    }
}