<?php


namespace JointApp\Models\Components;


use JointApp\JointAppQueryBuilder;
use JointApp\Models\ModuleModel;
use JointApp\Models\Records\RecordsModel;

class Model_Components_UsersToGroups extends ModuleModel
{
    public string $tableName = 'usersToGroups_dt';
    public string $moduleName = 'userstogroups';

    public function getRecordStructure()
    {
        $this->record = array(
            'group_id' => array(
                'pri' => 1,
                'format' => 'varchar',
                'custom' => false,
            ),
            'user_id' => array(
                'pri' => 1,
                'format' => 'hidden',
                'custom' => false,
            ),
            'read_rule' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'create_rule' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'edit_rule' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'delete_rule' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'created_by' => array(
                'format' => 'varchar',
                'custom' => false,
            ),
            'created_alias' => array(
                'format' => 'varchar',
                'custom' => true,
            ),
            'send_ntf' => array(
                'format' => 'tinyint',
                'custom' => false,
            ),
        );
    }

    public function copyCustomFields(): bool
    {
        $findCreatedAlias_qry = 'select accAlias from users_dt where created_by="'.$this->record['created_by']['curVal'].'"';
        $findCreatedAlias_arr = $this->fetchToArray($findCreatedAlias_qry);
        if(count($findCreatedAlias_arr)){
            $this->record['created_alias']['curVal'] = $findCreatedAlias_arr[0]['accAlias'];
        }

        $findUserAlias_qry = 'select accAlias from users_dt where created_by="'.$this->record['user_id']['curVal'].'"';
        $findUserAlias_arr = $this->fetchToArray($findUserAlias_qry);
        if(count($findUserAlias_arr)){
            $this->record['user_id']['findVal'] = $findUserAlias_arr[0]['accAlias'];
        }

        $findGroupAlias_qry = 'select groupAlias_'.$this->langLw.' from usersGroups_dt where group_id="'.$this->record['group_id']['curVal'].'"';
        $findGroupAlias_arr = $this->fetchToArray($findGroupAlias_qry);
        if(count($findGroupAlias_arr)){
            $this->record['group_id']['findVal'] = $findGroupAlias_arr[0]['groupAlias_'.$this->langLw];
        }

        return true;
    }

    public function listRecords(JointAppQueryBuilder $qBuilder): array
    {

        $qBuilder->select = 'usersToGroups_dt.group_id, usersToGroups_dt.user_id, '.
            'usersToGroups_dt.read_rule, usersToGroups_dt.create_rule, usersToGroups_dt.edit_rule, '.
            'usersToGroups_dt.delete_rule, usersToGroups_dt.created_by, '.
            'usersToGroups_dt.send_ntf, '.
            'users_dt.accAlias as created_user, '.
            'userAliases.accAlias as uses_alias, '.
        'usersGroups_dt.groupAlias_'.$this->langLw.' as groupAlias';

        $qBuilder
            ->from($this->tableName)
            ->join('left join users_dt on '.$this->tableName.'.created_by = users_dt.user_id '.
            'left join users_dt userAliases on '.$this->tableName.'.user_id = userAliases.user_id '.
            'left join usersGroups_dt on '.$this->tableName.'.group_id = usersGroups_dt.group_id');

        return $this->fetchToArray($qBuilder->buildQuery());
    }
}