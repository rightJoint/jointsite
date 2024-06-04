<?php
class lang_view_user_ntf_d_rus extends lang_view_RecordDetail_rus
{
    function update_head_array($options = null)
    {
        $this->head["description"] = "Просмотр уведомления с сайта";
        $this->head["title"] = "Просмотр уведомления";
        $this->head["h1"] = "Просмотр уведомления";
    }
}