<?php
include "application/core/Records/RecordsModel.php";
class Model_User extends RecordsModel
{
    function checkUserLogin($user_login)
    {
        if (preg_match('/^[a-z]{1}[0-9a-z-._]{2,15}$/imsiu', $user_login) == 0){
            return false;
        }
        return true;

    }

    function checkUserPassword($user_password)
    {
        if (preg_match('/^[a-z]{1}[0-9a-z-._]{2,15}$/imsiu', $user_password) == 0){
            return false;
        }else{
            return true;
        }
    }

    function checkUserEmail($user_email)
    {
        if (filter_var($user_email, FILTER_VALIDATE_EMAIL)){
            return true;
        }else{
            return false;
        }
    }
}