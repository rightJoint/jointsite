<?php


namespace JointApp\Views\HtmlInputs;


class HtmlTextType extends HtmlInputView
{
    public function htmlInput()
    {
        $this->return_input = '<textarea '.$this->name_print.' '.$this->id_print.' '.$this->readonly_print.'>'.$this->value_print.'</textarea>';
    }
}