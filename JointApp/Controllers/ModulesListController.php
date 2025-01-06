<?php


namespace JointApp\Controllers;


class ModulesListController extends Controller
{
    public function checkAccessController(): bool
    {
        global $currentUser;

        if($currentUser->is_admin or count($currentUser->groups)){
            return true;
        }
        return false;
    }
}