<?php


namespace JointApp\Models\User;


use JointApp\JointAppQueryBuilder;
use JointApp\Models\ModuleModel;

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

    public function checkVldCode(string $vldCode):string
    {
        if(!empty($vldCode)){
            $qBuilder = new JointAppQueryBuilder();
            $qBuilder->select('validDate, vldCode')->from('users_dt')->where('vldCode="'.$vldCode.'"');
            $res = $this->fetchToArray($qBuilder->buildQuery());
            if(count($res) == 1){
                if(!isset($res[0]['validDate']) or empty($res[0]['validDate'])){
                    $update = 'update users_dt set validDate = "'.date('Y-m-d H:i:s').'" where vldCode="'.$vldCode.'"';
                    $this->pdoQuery($update);
                    $result_key = 'success';
                }else{
                    $result_key = 'repeated';
                }
            }else{
                $result_key = 'not-found';
            }
        }else{
            $result_key = 'empty';
        }
        return $result_key;
    }
}