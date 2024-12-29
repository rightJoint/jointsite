<?php


namespace JointApp\Views\HtmlInputs;


class HtmlFindSelectType extends HtmlInputView
{
    public function htmlInput()
    {
        $this->return_input =
            '<div class="find-select" id="'.$this->fieldName.'">'.
            '<input type="text" id="fst-'.$this->fieldName.'" value="'.$this->fieldOptions['findVal'].'">'.
            '<div class="fss">'.
            '<select size="5" id="fs-'.$this->fieldName.'" name="'.$this->fieldName.'">'.
            '<option value="'.$this->fieldOptions['curVal'].'" selected>'.$this->fieldOptions['findVal'].'</option>'.
            '</select>'.
            '</div>'.
            '</div>'.
            '<script>$("#'.$this->fieldName.'").findselect("'.$this->fieldOptions['callBack_uri'].'", "'.$this->fieldName.'", '.
            '"'.$this->fieldOptions['returnKey'].'", "'.$this->fieldOptions['returnKey'].'")</script>';
    }
}