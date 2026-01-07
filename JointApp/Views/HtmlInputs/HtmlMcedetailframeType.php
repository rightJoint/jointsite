<?php


namespace JointApp\Views\HtmlInputs;


class HtmlMcedetailframeType extends HtmlInputView
{
    public function htmlValue()
    {
        //new view case
        if(isset($this->fieldOptions['curVal'])){
            $this->value_print = $this->fieldOptions['curVal'];
        }else{
            $this->value_print = '';
        }
    }

    public function htmlInput()
    {
        $this->return_input = '<div class="mce-datail-frame">'.$this->value_print.'</div>';
    }
}