<?php


namespace Src\Models\Applications;


use JointApp\Models\Records\RecordsModel;

class Model_Applications extends RecordsModel
{
    public string $tableName = 'applList_dt';

    function checkUserEmail():bool
    {
        if (filter_var($this->record['clientMail']['curVal'], FILTER_VALIDATE_EMAIL)){
            return true;
        }else{
            return false;
        }
    }
    public function checkClientName():bool
    {
        if (preg_match('/^[a-zа-я]{1}[0-9a-zа-я-._ ]{2,15}$/imsiu', $this->record['clientName']['curVal']) == 0){
            return false;
        }
        return true;
    }
}