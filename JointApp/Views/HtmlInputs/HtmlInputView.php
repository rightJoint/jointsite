<?php


namespace JointApp\Views\HtmlInputs;


use JointApp\Interfaces\HtmlInputViewInterface;

class HtmlInputView implements HtmlInputViewInterface
{

    public string $fieldName = '';

    public $fieldOptions = [];

    public string $fieldAlias = '';

    public string $line_class = '';

    public string $label_print = '';

    public string $readonly_print = '';

    public string $name_print = '';

    public string $id_print = '';

    public string $value_print = '';

    public string $return_input = '';

    public string $label_class = '';

    function __construct(string $fieldName, $fieldOptions = [], $fieldAlias = '')
    {
        $this->fieldName = $fieldName;

        if(!empty($fieldAlias)){
            $this->fieldAlias = $fieldAlias;
        }else{
            $this->fieldAlias = $fieldName;
        }

        $this->fieldOptions = $fieldOptions;
    }

    public function getHtml(): string
    {
        return '<div class="input-line'.' '.$this->line_class.'">'.$this->label_print.$this->return_input.'</div>';
    }

    public function htmlLineStyle():void
    {
        if(isset($this->fieldOptions['style']['class']) and $this->fieldOptions['style']['class'] == 'wd100'){
            $this->line_class = 'wd100';
        }
    }

    public function htmlLabelStyle():void
    {
        $label_class = '';


        if(isset($this->fieldOptions['readonly']) and $this->fieldOptions['readonly'] == 1) {
            //echo 'ro-1: '.$this->fieldName.'<br>';
            //if (isset($this->fieldOptions['pri']) and !empty($this->fieldOptions['curVal'])or
            //    !isset($this->fieldOptions['pri'])) {
            // echo 'ro-2: '.$this->fieldName.'<br>';
            $label_class = 'ro';
            // }
        }
        if(isset($this->fieldOptions['pri'])){
            $label_class .= ' idx';
        }

        if($label_class){
            $label_class = ' class="'.$label_class.'"';
        }

        $this->label_class = $label_class;
    }

    public function htmlLabel():void
    {
        $this->label_print ='<label';
        if(isset($this->fieldOptions['id'])){
            $this->label_print .= ' for="'.$this->fieldOptions['id'].'" ';
        }

        $this->label_print .= $this->label_class.'>'.
            $this->fieldAlias.
            ':</label>';
    }

    public function htmlId()
    {
        $id_print = '';
        if(isset($this->fieldOptions['id'])){
            $id_print = 'id="'.$this->fieldOptions['id'].'"';
        }
        $this->id_print = $id_print;
    }

    public function htmlName()
    {
        if(isset($this->fieldOptions['nameSpace'])){
            $name_print =$this->fieldOptions['nameSpace'].'['.$this->fieldName.']"';
        }else{
            $name_print ='"'.$this->fieldName.'"';
        }

        $name_print = 'name='.$name_print;
        $this->name_print = $name_print;

    }

    public function htmlReadonly()
    {
        $readonly_print = '';

        if(isset($this->fieldOptions['readonly']) and $this->fieldOptions['readonly'] == 1){
            $readonly_print = ' readonly';
        }

        if($this->fieldOptions['format'] == 'checkbox' or $this->fieldOptions['format'] == 'tinyint'){
            if(isset($this->fieldOptions['readonly'])){
                $readonly_print = 'onclick="return false;"';
            }
        }

        $this->readonly_print = $readonly_print;
    }

    public function htmlValue()
    {
        if ($this->fieldOptions['format'] == 'text' or $this->fieldOptions['format'] == 'email') {
            $value_print = '';
            if($this->fieldOptions['curVal']){
                $value_print = $this->fieldOptions['curVal'];
            }
        }elseif($this->fieldOptions['format'] == 'checkbox' or $this->fieldOptions['format'] == 'tinyint'){
            if($this->fieldOptions['curVal']){
                $value_print = 'checked';
            }else{
                $value_print = '';
            }
        }elseif ($this->fieldOptions['format'] == 'detailselect'){
            $value_print = '';
            if($this->fieldOptions['curVal']){
                $value_print = $this->fieldOptions['filling'][$this->fieldOptions['curVal']];
            }
        }
        else {
            $value_print = ' value="';
            if($this->fieldOptions['curVal']){
                $value_print .=$this->fieldOptions['curVal'];
            }
            $value_print .= '"';
        }
        $this->value_print = $value_print;
    }

    public function htmlInput()
    {

    }
}