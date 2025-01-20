<?php

class LangFiles_En_Controller_Components_UsersToGroups extends LangFiles_En_Controller_Records
{
    public string $moduleAlias = 'Users groups';
    public array $rules = array(
        'any' => 'any',
        'own' => 'own',
        'enable' => 'enable',
        'disable' => 'disable',
        'forbidden' => 'forbidden',
    );

    public function __construct()
    {
        $this->fieldAliases = array(
            'group_id' => 'group id',
            'user_id' => 'user id',
            'read_rule' => 'read',
            'create_rule' => 'create',
            'edit_rule' => 'edit',
            'delete_rule' => 'delete',
            'created_by' => 'created id',
            'created_user' => 'created user',
            'send_ntf' => 'notifications',
            'uses_alias' => 'alias',
            'groupAlias' => 'group',
            'created_alias' => 'created by',
        );
    }
}