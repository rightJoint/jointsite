<?php


namespace JointApp\Views\HtmlInputs;


class HtmlSelectType extends HtmlInputView
{
    public function htmlInput()
    {
        $this->return_input = '<select '.$this->name_print.'>';
        foreach ($this->fieldOptions['filling'] as $sVal=>$sOpt){
            $this->return_input .= '<option value="'.$sVal.'" ';
            if($sVal==$this->fieldOptions['curVal']){
                $this->return_input .= 'selected';
            }
            $this->return_input .= '>'.$sOpt.'</option>';
        }
        $this->return_input .= '</select>';
    }
}