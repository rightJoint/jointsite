<?php


namespace JointApp\Views\HtmlInputs;


class HtmlHiddenType extends HtmlInputView
{
    public function getHtml(): string
    {
        return $this->return_input;
    }

    public function htmlInput()
    {
        $this->return_input = '<input type="hidden" '.$this->name_print.' '.
            $this->id_print.' '.
            $this->value_print.' '.
            $this->readonly_print.'>';
    }
}