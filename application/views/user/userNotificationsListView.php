<?php
include "application/core/Records/RecordsView.php";
include "application/core/Records/RecordsListView.php";
include "application/views/siteman/sitemanListView.php";
class userNotificationsListView extends sitemanListView
{
    function set_head_array()
    {
        $this->lang_map["head"]["description"] = array(
            "en" => "Notifications list from site, find notification",
            "rus" => "Список уведомлений с сайта, найти запиь уведомление",
        );
        $this->lang_map["head"]["title"] = array(
            "en" => "Notifications list",
            "rus" => "Список уведомлений",
        );
        $this->lang_map["head"]["h1"] = array(
            "en" => "Notifications list",
            "rus" => "Список уведомлений"
        );
    }
}