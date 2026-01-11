<?php


namespace JointApp\Views\HtmlInputs;


class HtmlDetailselectType extends HtmlInputView
{
    public function htmlInput()
    {
        $this->return_input .=$this->value_print;

        return 1;
        $this->return_input .='<input type="text" '.$this->name_print.' '.$this->id_print.' '.$this->value_print.' '.$this->readonly_print.'>';
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