<?php


namespace JointApp\Views\HtmlInputs;


class HtmlTinymceType extends HtmlInputView
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
        $this->return_input = '<textarea '.$this->name_print.' '.$this->id_print.' '.$this->readonly_print.'>'.$this->value_print.'</textarea>'.
        '<script>tinyInit("#'.$this->fieldName.'");</script>';
    }
}