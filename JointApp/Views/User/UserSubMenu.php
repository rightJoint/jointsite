<?php


namespace JointApp\Views\User;


class UserSubMenu
{
    public static function printUserSubMenu(array $subMenuMain, array $routes_ns, $subMenuText = ''):string
    {
        $mainMenu_class = '';
        if(!isset($routes_ns[2]) or empty($routes_ns[2])){
            $mainMenu_class = 'class="active"';
        }

        return '<div class="contentBlock-frame"><div class="contentBlock-center">'.
            '<div class="contentBlock-wrap">'.
            '<div class="user-sub-menu">'.
            '<ul>'.
            '<li><a href="/user" title="'.$subMenuMain['refTitle'].'" '.$mainMenu_class.'>'.$subMenuMain['refText'].'</a></li>'.
            $subMenuText.
            '</ul>'.
            '</div>'.
            '</div></div></div>'.
            '<link rel="stylesheet" href="/css/user/userSubMenu.css" type="text/css" media="screen, projection"/>';
    }
}