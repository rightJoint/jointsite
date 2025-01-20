<?php
class LangFiles_En_Views_Templates_RecordDetail extends LangFiles_En_Views_SiteView
{
    public $del_confirm_btn = null;
    public $del_confirm_txt = null;

    function update_head_array($options = null)
    {
        if($options['type'] == 'detail'){
            $txt_rus = 'View record in table';
        }elseif ($options['type'] == 'delete'){
            $txt_rus = 'Delete record from table';
        }
        $this->head['description'] =$txt_rus;
        $this->head['title'] = $txt_rus." ".$options['h2'];
        $this->head['h1'] = $txt_rus.' '.$options['h2'];

        $this->del_confirm_btn = 'Delete';
        $this->del_confirm_txt = 'Confirm to delete record';
    }
}
