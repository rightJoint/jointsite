<?php


namespace JointApp\Views\HtmlInputs;


class HtmlFileType extends HtmlInputView
{
    public function htmlInput()
    {
        $this->return_input = '';
        if($this->fieldOptions['file_options']['button'] == true){
            $this->return_input .= '<input type="file" '.$this->name_print;
            if($this->fieldOptions['file_options']['accept']){
                $this->return_input .= ' accept="'.$this->fieldOptions['file_options']['accept'].'"';
            }
            $this->return_input .='>';
        }

        $cur_val_file = null;
        if($this->fieldOptions['curVal']){
            $cur_val_file = $this->fieldOptions['curVal'];
        }
        $this->return_input .= '<span class="file_val">'.$cur_val_file.'</span>';
        if(isset($this->fieldOptions['file_options']['load_dir']) and isset($this->fieldOptions['curVal'])){
            if(isset($this->fieldOptions['file_options']['file_type']) and
                $this->fieldOptions['file_options']['file_type'] == 'img'){
                if(isset($this->fieldOptions['replaces'])){
                    $imgLink = $this->fieldOptions['file_options']['load_dir'];
                    //foreach ($this->fieldOptions['replaces'] as $replace){
                        //$imgLink = str_replace($replace, $this->record[$replace]['curVal'], $imgLink);
                    //}
                }else{
                    $imgLink = $this->fieldOptions['file_options']['load_dir'].'/'.$this->fieldOptions['curVal'];
                }
                $this->return_input .= '<img class="cell-img float-l" src="'.$imgLink.'" alt="image">';
            }
        }
    }
}