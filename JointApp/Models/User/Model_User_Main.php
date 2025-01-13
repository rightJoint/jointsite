<?php


namespace JointApp\Models\User;


use JointApp\Models\Model_Pdo;
use JointApp\Models\ModuleModel;
use function PHPUnit\Framework\assertEquals;

class Model_User_Main extends ModuleModel
{
    const USER_AVATARS_DIR = '/userdata/avatars/';
    public string $tableName = 'users_dt';

    public function checkAccessModel(): bool
    {
        $this->access_rules = array(
            "read_rule" => 2,
            "create_rule" => 0,
            "edit_rule" => 2,
            "delete_rule" => 0,
        );
        return true;
    }

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
                'format' => 'file',
                'file_options' => array(
                    'accept' => '.jpg, .jpeg, .bmp, .git, .png',
                    'load_dir' => self::USER_AVATARS_DIR.'/photoLink',
                    'replaces' => ['photoLink'],
                ),
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
        );
    }

    public function getUser(string $user_id = ''):bool
    {
        $return = false;
        if(!empty($user_id)){
            $this->record['user_id']['curVal'] = $user_id;
            return $this->copyRecord();
        }
        return $return;
    }
}