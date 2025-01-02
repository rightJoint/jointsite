<?php


namespace JointApp;


class CurrentUser
{
    public string $user_id = '';
    public string $accLogin = '';
    public string $accAlias = '';
    public bool $is_admin = false;
    public string $photoLink = '';
    public $groups = [];

    public function __construct()
    {
        $this->fromSession();
    }

    //private
    public function fromSession()
    {
        if(isset($_SESSION['site_user']['user_id'])){
            $this->user_id = $_SESSION['site_user']['user_id'];
            $this->accLogin = $_SESSION["site_user"]["accLogin"];
            $this->accAlias = $_SESSION["site_user"]["accAlias"];
            $this->is_admin = $_SESSION["site_user"]["is_admin"];
            if(isset($_SESSION["site_user"]["photoLink"])){
                $this->photoLink = $_SESSION["site_user"]["photoLink"];
            }
        }

        if(isset($_SESSION['site_user']['groups'])){
            $this->groups = $_SESSION['site_user']['groups'];
        }
    }

    public function userExit()
    {
        $this->user_id = '';
        $this->accLogin = '';
        $this->accAlias = '';
        $this->is_admin = false;
        $this->photoLink = '';
        $this->groups = [];

        $this->resetUserSession();
    }

    public function resetUserSession()
    {
        unset($_SESSION['site_user']);
    }


}