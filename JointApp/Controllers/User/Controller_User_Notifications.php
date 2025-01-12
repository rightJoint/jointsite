<?php


namespace JointApp\Controllers\User;


use JointApp\JointAppQueryBuilder;

class Controller_User_Notifications extends Controller_User_Account
{
    public $listFields = [];
    public $searchFields = [];

    public function actionGetUserNtfList()
    {
        global $currentUser;

        $qBuilderList = new JointAppQueryBuilder();
        $qBuilderList
            ->where('user_id = "'.$currentUser->user_id.'" and del_flag is null')
            ->order('put_date desc');
        $this->view->listRecords = $this->model->listRecords($qBuilderList);

        $this->view->listCount = count($this->view->listRecords);

        $this->prepareListFields();
        $this->prepareSearchFields();
        $this->view->listFields = $this->listFields;
        $this->view->searchFields = $this->searchFields;

        $this->view->hasAccessCreate = false;
    }

    public function prepareListFields()
    {
        $this->listFields = array(
            'ntf_id' => array(
                'format' => 'varchar',
            ),
            'user_id' => array(
                'format' => 'varchar',
            ),
            'read_date' => array(
                'format' => 'datetime',
            ),
            'put_date' => array(
                'format' => 'datetime',
            ),
            'send_flag' => array(
                'format' => 'tinyint',
            ),
            'del_flag' => array(
                'format' => 'tinyint',
            ),
        );
    }

    public function prepareSearchFields()
    {
        $this->searchFields = array(
            'ntf_id' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
                'curVal' => '',
                //'custom' => false,
            ),
            'user_id' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
                'curVal' => '',
            ),
            'read_date' => array(
                'format' => 'datetime',
                'search' => 1,
                'sort' => 1,
                'curVal' => '',
            ),
            'put_date' => array(
                'format' => 'datetime',
                'search' => 1,
                'sort' => 1,
                'curVal' => '',
            ),
            'send_flag' => array(
                'format' => 'tinyint',
                'search' => 1,
                'sort' => 1,
                'curVal' => '',
            ),
            'del_flag' => array(
                'format' => 'tinyint',
                'search' => 1,
                'sort' => 1,
                'curVal' => '',
            ),
        );
    }
}