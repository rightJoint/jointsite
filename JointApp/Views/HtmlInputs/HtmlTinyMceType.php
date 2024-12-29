<?php


namespace JointApp\Views\HtmlInputs;


class HtmlTinyMceType extends HtmlInputView
{
    public function htmlValue()
    {
        $this->value_print = $this->fieldOptions['curVal'];
    }

    public function htmlInput()
    {
        $this->return_input = '<textarea '.$this->name_print.' '.$this->id_print.' '.$this->readonly_print.'>'.$this->value_print.'</textarea>'.
        '<script>tinyInit("#'.$this->fieldName.'");</script>';
    }
}