<?php


namespace JointApp\Views\HtmlInputs;


class HtmlEmailType extends HtmlInputView
{
    public function htmlInput()
    {
        $template_params = json_decode($this->fieldOptions["template_params"], true);

        $replaced_text = $this->value_print;

        if(isset($template_params) and is_array($template_params)){
            foreach ($template_params as $tp_key => $tp_val){
                $replaced_text = str_replace("$^".$tp_key, $tp_val, $replaced_text);
            }
        }
        $this->return_input = '<div class="email-template">'.$replaced_text.'</div>';
    }
}