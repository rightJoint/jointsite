<?php
class lang_view_test_recordsedit_rus extends lang_view_RecordEdit_rus
{
    function update_head_array($options)
    {
        $this->head["h1"] = "test-edit-view";
    }
}