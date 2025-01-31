<?php

namespace JointApp\Models\User;

trait UserTrait
{
    public static function checkUserLogin($login):bool
    {
        if (preg_match('/^[A-Za-z]{1}[0-9a-zA-Z-._]{2,15}$/imsiu', $login) == 0){
            return false;
        }
        return true;
    }

    public static function checkUserPassword($password):bool
    {
        if (strlen($password) >= 3){
            return true;
        }else{
            return false;
        }
    }

    public static function checkUserEmail($user_email)
    {
        if (filter_var($user_email, FILTER_VALIDATE_EMAIL)){
            return true;
        }else{
            return false;
        }
    }
}