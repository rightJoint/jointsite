<?php


namespace JointApp\Views\HtmlInputs;


class HtmlCheckboxType extends HtmlInputView
{
    public function htmlInput()
    {
        $this->return_input = '<input type="checkbox" '.$this->name_print.' '.
            $this->id_print.' '.
            $this->value_print.' '.
            $this->readonly_print.'>';
    }
}