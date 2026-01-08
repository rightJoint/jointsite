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
                //music
                '532B8184-A552-463C-82D1-70E07E86CEC4',
            ),
            'musictracks' => array(
                //test
                'D714A6B0-C37A-49B3-B37D-C0903201212C',
            ),
            'musictrackstoalb' => array(
                //music
                '532B8184-A552-463C-82D1-70E07E86CEC4',
            ),
            'services' => array(
                //services
                'admin-only',
            ),
            'blogarts' => array(
                //blogarts
                'admin-only',
            ),
            'blogtags' => array(
                //blogarts
                'admin-only',
            ),
            'blogtagstoarts' => array(
                //blogtagstoarts
                'admin-only',
            ),
            'blogcats' => array(
                //blogcats
                'admin-only',
            ),
            'blogcomments' => array(
                //blogcomments
                'admin-only',
            ),
            'sitemap' => array(
                //sitemap
                'admin',
            ),
            'sitemapupdate' => array(
                //sitemap
                'admin',
            ),
            'robots' => array(
                //
                'admin',
            ),
            'robotsupdate' => array(
                //
                'admin',
            ),
            'kiptasks' => array(
                //
                'admin',
            ),
            'kipnotes' => array(
                //
                'admin',
            ),
            'kipparticipators' => array(
                //
                'admin',
            ),
            'kipplan' => array(
                //
                'admin',
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