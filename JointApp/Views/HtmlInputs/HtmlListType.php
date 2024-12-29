<?php


namespace JointApp\Views\HtmlInputs;


class HtmlListType extends HtmlInputView
{
    public function htmlInput()
    {
        $this->return_input = '<input type="text" '.$this->name_print.' '.$this->id_print.' '.$this->value_print.' '.
            $this->readonly_print.' list="'.$this->fieldName.'-list">';

        $this->return_input .= '<datalist id="'.$this->fieldName.'-list">';
        foreach ($this->fieldOptions['filling'] as $opt_id=>$optVal){
            //$radio_cnt++;
            $this->return_input .= ' <option value="'.$opt_id.'">'.$optVal.'</option>';

        }
        $this->return_input .='</datalist>';
    }
}