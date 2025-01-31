<?php


namespace JointApp\Models\User;


use JointApp\JointAppQueryBuilder;
use JointApp\Models\Model_Pdo;

class Model_User_Validate extends Model_Pdo
{
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