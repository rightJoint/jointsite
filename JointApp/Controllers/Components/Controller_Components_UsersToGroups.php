<?php


namespace JointApp\Controllers\Components;


use JointApp\Controllers\ModuleController;

class Controller_Components_UsersToGroups extends ModuleController
{
    public string $moduleName = 'userstogroups';

    public string $processUri = '/siteman/userstogroups';

    public function loadBindComponents(): void
    {
        $this->bindComponents = array(
            "users" => [],
            "groups" => [],
        );
    }

    public function loadLangController():string
    {
        parent::loadLangController();
        $name = 'LangFiles_'.$this->langNs.'_Controller_Components_UsersToGroups';
        require_once $this->docRoot.'/JointApp/LangFiles/Controllers/Components/'.$name.'.php';
        return $name;
    }

    public function prepareListFields(): void
    {
        $this->listFields = array(
            'btnDetail' => array(
                'replaces' => ['group_id', 'user_id'],
                'format' => 'link',
                'url' => 'group_id=group_id&user_id=user_id',
            ),
            'btnEdit' => array(
                'replaces' => ['group_id', 'user_id'],
                'format' => 'link',
                'url' => 'group_id=group_id&user_id=user_id',
            ),
            'btnDelete' => array(
                'replaces' => ['group_id', 'user_id'],
                'format' => 'link',
                'url' => 'group_id=group_id&user_id=user_id',
            ),
            //'group_id' => array(
            //    'format' => 'varchar',
            //),
            'groupAlias' => array(
                'format' => 'varchar',
                'custom' => true,
            ),
            'uses_alias' => array(
                'pri' => 1,
                'format' => 'varchar',
                'custom' => true,
            ),
            //'user_id' => array(
            //    'format' => 'varchar',
            //),
            'read_rule' => array(
                'format' => 'select',
                'filling' => $this->fillViewRule('read'),
            ),
            'create_rule' => array(
                'format' => 'select',
                'filling' => $this->fillViewRule('create'),
            ),
            'edit_rule' => array(
                'format' => 'select',
                'filling' => $this->fillViewRule('edit'),
            ),
            'delete_rule' => array(
                'format' => 'select',
                'filling' => $this->fillViewRule('delete'),
            ),
            //'created_by' => array(
            //    'format' => 'varchar',
            //),
            'created_user' => array(
                'format' => 'varchar',
            ),
            'send_ntf' => array(
                'format' => 'tinyint',
            ),
        );
    }

    public function prepareSearchFields(): void
    {
        $this->searchFields = array(
            'group_id' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
            ),
            'user_id' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
            ),
            'read_rule' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
            ),
            'create_rule' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
            ),
            'edit_rule' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
            ),
            'delete_rule' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
            ),
            'created_by' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
            ),
            'send_ntf' => array(
                'format' => 'tinyint',
                'search' => 1,
                'sort' => 1,
            ),
        );
    }

    public function prepareEditFields(): void
    {
        $this->editFields = array(
            'group_id' => array(
                'pri' => 1,
                'format' => 'findSelect',
                'returnKey' => 'groupAlias_'.$this->langLw,
                'callBack_uri' => $this->processUri.'/fillgroupaliases',
                'curVal' => '',
                'findVal' => '',
            ),
            'user_id' => array(
                'pri' => 1,
                'format' => 'findSelect',
                'returnKey' => 'accAlias',
                'callBack_uri' => $this->processUri.'/filluseraliases',
                'curVal' => '',
                'findVal' => '',
            ),
            'read_rule' => array(
                'format' => 'select',
                'filling' => $this->fillViewRule('read'),
                'curVal' => '',
            ),
            'create_rule' => array(
                'format' => 'select',
                'filling' => $this->fillViewRule('create'),
                'curVal' => '',
            ),
            'edit_rule' => array(
                'format' => 'select',
                'filling' => $this->fillViewRule('edit'),
                'curVal' => '',
            ),
            'delete_rule' => array(
                'format' => 'select',
                'filling' => $this->fillViewRule('delete'),
                'curVal' => '',
            ),
            'created_by' => array(
                'format' => 'hidden',
                'curVal' => '',
            ),
            'created_alias' => array(
                'format' => 'varchar',
                'curVal' => '',
                'readonly' => 1,
            ),
            'send_ntf' => array(
                'format' => 'tinyint',
                'curVal' => '',
            ),
        );

    }

    function fillViewRule($type_of_rule = null)
    {

        if($type_of_rule == 'read'){
            return array(
                ''=>'',
                'any' => $this->langMap->rules['any'],
                'own' => $this->langMap->rules['own'],
                'forbidden' => $this->langMap->rules['forbidden'],
            );
        }elseif ($type_of_rule == 'create'){
            return array(
                ''=>'',
                'enable' => $this->langMap->rules['enable'],
                'disable' => $this->langMap->rules['disable'],
            );
        }elseif ($type_of_rule == 'edit'){
            return array(
                ''=>'',
                'any' => $this->langMap->rules['any'],
                'own' => $this->langMap->rules['own'],
                'forbidden' => $this->langMap->rules['forbidden'],
            );
        }elseif ($type_of_rule == 'delete'){
            return array(
                ''=>'',
                'any' => $this->langMap->rules['any'],
                'own' => $this->langMap->rules['own'],
                'forbidden' => $this->langMap->rules['forbidden'],
            );
        }
    }

    public function actionFillUserAliases()
    {
        $where_json = $_GET['where'];
        $where_arr = json_decode($where_json, true);
        $where_key = key($where_arr);
        $find_qry = 'select '.$_GET['findField'].', '.$_GET['returnKey'].' from users_dt where '.
            $where_key.' like "%'.$where_arr[$where_key].'%" order by '.$_GET['returnKey'].' limit 10';
        $find_arr = $this->model->fetchToArray($find_qry);
        if(count($find_arr)){
            $return_arr = $find_arr;
        }else{
            $return_arr[0] = [$_GET['findField'] => '', $_GET['returnKey'] => ''];
        }

        $this->view->responseJson = $return_arr;
    }

    public function actionFillGroupAliases()
    {
        $where_json = $_GET['where'];
        $where_arr = json_decode($where_json, true);
        $where_key = key($where_arr);
        $find_qry = 'select '.$_GET['findField'].', '.$_GET['returnKey'].' from usersGroups_dt where '.
            $where_key.' like "%'.$where_arr[$where_key].'%" order by '.$_GET['returnKey'].' limit 10';

        $find_arr = $this->model->fetchToArray($find_qry);
        if(count($find_arr)){
            $return_arr = $find_arr;
        }else{
            $return_arr[0] = [$_GET['findField'] => '', $_GET['returnKey'] => ''];
        }
        $this->view->responseJson = $return_arr;
    }
}