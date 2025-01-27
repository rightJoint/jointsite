<?php


namespace JointApp;


class CurrentUser
{
    public string $user_id = '';
    public string $accLogin = '';
    public string $accAlias = '';
    public bool $is_admin = false;
    public string $photoLink = '';
    public string $network = 'site';
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
            if(isset($_SESSION['site_user']['is_admin']) and $_SESSION['site_user']['is_admin'] == true){
                $this->is_admin = true;
            }
            if(isset($_SESSION['site_user']['photoLink'])){
                $this->photoLink = $_SESSION['site_user']['photoLink'];
            }
            $this->network = $_SESSION['site_user']['network'];
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