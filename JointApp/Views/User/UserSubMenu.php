<?php


namespace JointApp\Views\User;


class UserSubMenu
{
    public static function printUserSubMenu($text):string
    {
        return '<div class="contentBlock-frame"><div class="contentBlock-center">'.
            '<div class="contentBlock-wrap">'.
            '<div class="user-sub-menu">'.
            '<ul>'.
            $text.
            '</ul>'.
            '</div>'.
            '</div></div></div>'.
            '<link rel="stylesheet" href="/css/user/userSubMenu.css" type="text/css" media="screen, projection"/>';
    }
}