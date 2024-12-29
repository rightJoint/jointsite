<?php


namespace JointApp\Views\HtmlInputs;


class HtmlIntType extends HtmlInputView
{
    public function htmlInput()
    {
        $this->return_input =
            '<input type="number" '.$this->name_print.' '.$this->id_print.' '.$this->value_print.' '.$this->readonly_print.'>';
    }
}