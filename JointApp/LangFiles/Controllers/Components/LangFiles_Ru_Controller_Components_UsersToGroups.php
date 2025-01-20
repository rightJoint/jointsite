<?php

class LangFiles_Ru_Controller_Components_UsersToGroups extends LangFiles_Ru_Controller_Records
{
    public string $moduleAlias = 'Группы пользователей';
    public array $rules = array(
        'any' => 'любые',
        'own' => 'свои',
        'enable' => 'может',
        'disable' => 'блокировано',
        'forbidden' => 'запрещено',
    );

    public function __construct()
    {
        $this->fieldAliases = array(
            'group_id' => 'ид гр.',
            'user_id' => 'ид польз',
            'read_rule' => 'чтение',
            'create_rule' => 'создание',
            'edit_rule' => 'редакт.',
            'delete_rule' => 'удаление',
            'created_by' => 'создал',
            'created_user' => 'создал',
            'send_ntf' => 'уведомл.',
            'uses_alias' => 'пользователь',
            'groupAlias' => 'группа',
            'created_alias' => 'создал',
        );
    }
}