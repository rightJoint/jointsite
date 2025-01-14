<?php


namespace JointApp\Views\HtmlInputs;


class HtmlEmailType extends HtmlInputView
{
    public function htmlInput()
    {
        /*
        $template_params = json_decode($template_row["template_params"], true);
        $replaced_text = $template_row["tBody_en"];

        if(isset($template_params) and is_array($template_params)){
            foreach ($template_params as $tp_key => $tp_val){
                $replaced_text = str_replace("$^".$tp_key, $tp_val, $replaced_text);
            }
        }
        */


        $this->return_input = '<div class="email-template">'.$this->value_print.'</div>';
    }
}