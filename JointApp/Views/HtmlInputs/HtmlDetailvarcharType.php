<?php


namespace JointApp\Views\HtmlInputs;


class HtmlDetailvarcharType extends HtmlInputView
{
    public function htmlValue()
    {
        $this->value_print = '<div class="detail-varchar">'.$this->fieldOptions['curVal'].'</div>';
    }

    public function htmlInput()
    {
        $this->return_input .=$this->value_print;
    }

    public function htmlLineStyle():void
    {
        if(isset($this->fieldOptions['style']['class'])){
            $this->line_class .=$this->fieldOptions['style']['class'];
        }
    }
}