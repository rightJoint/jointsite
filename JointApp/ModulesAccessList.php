<?php


namespace JointApp;


class ModulesAccessList
{
    public static function getAccessList():array
    {
        return array(
            'users' => array(
                'test-1', 'test-2',
            ),
            'groups' => array(
                'testgroups-1', 'testgroups-2',
            ),
            'userstogroups' => array(
                'testgroups-1', 'testgroups-2',
            ),
            'ntftemplates' => array(
                'testgroups-1', 'testgroups-2',
            ),
            'ntflist' => array(
                'testgroups-1', 'testgroups-2',
            ),
            'ntfread' => array(
                'testgroups-1', 'testgroups-2',
            ),
            'musicalb' => array(
                'music', 'testgroups-2',
            ),
            'musictracks' => array(
                'music', 'testgroups-2',
            ),
            'musictrackstoalb' => array(
                'music', 'testgroups-2',
            ),
        );
    }

    public static function getUserModules():array
    {
        $userModules = [];

        global $currentUser;

        if($currentUser->is_admin){
            foreach (self::getAccessList() as $m => $gL){
                $userModules[] = $m;
            }
        }else{
            foreach (self::getAccessList() as $m => $gL){
                foreach ($currentUser->groups as $gN => $gA){
                    if(in_array($gN, $gL)){
                        $userModules[] = $m;
                        break;
                    }
                }
            }
        }
        return $userModules;
    }
}