<?php
include "application/core/Records/RecordsView.php";
include "application/core/Records/RecordDetailView.php";
include "application/views/siteman/sitemanDetailView.php";
class userNotificationDetailView extends sitemanDetailView
{
    function set_head_array()
    {
        $this->lang_map["head"]["description"] = array(
            "en" => "View notification from site",
            "rus" => "Просмотр уведомления с сайта",
        );
        $this->lang_map["head"]["title"] = array(
            "en" => "View notification",
            "rus" => "Просмотр уведомления",
        );
        $this->lang_map["head"]["h1"] = array(
            "en" => "View notification",
            "rus" => "Просмотр уведомления"
        );
    }
}