<?php

namespace JointApp\Models\User;

trait UserTrait
{
    public static function checkUserLogin($login):bool
    {
        if (preg_match('/^[a-z]{1}[0-9a-z-._]{2,15}$/imsiu', $login) == 0){
            return false;
        }
        return true;
    }

    public static function checkUserPassword($password):bool
    {
        if (preg_match('/^[a-z]{1}[0-9a-z-._]{2,15}$/imsiu', $password) == 0){
            return false;
        }else{
            return true;
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