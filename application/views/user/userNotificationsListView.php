<?php
include "application/core/Records/RecordsView.php";
include "application/core/Records/RecordsListView.php";
include "application/views/siteman/sitemanListView.php";
class userNotificationsListView extends sitemanListView
{
    public $logo = "/img/popimg/eMailLogo-2.png";
    public $shortcut_icon = "/img/popimg/eMailLogo-2.png";

    public $robot_no_index = true;
    public $metrik_block = false;

    function set_head_array()
    {

    }
}