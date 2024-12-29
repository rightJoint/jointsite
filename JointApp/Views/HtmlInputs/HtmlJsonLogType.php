<?php


namespace JointApp\Views\HtmlInputs;


class HtmlJsonLogType extends HtmlInputView
{

    public function htmlInput()
    {
        if($m_log = json_decode($this->fieldOptions["curVal"], true)){
            $log_text = "<div class='input-line wd100'>".$this->label_print.
                "result: ".$m_log["result"]."<br>";
            if(isset($m_log["log"])){
                if(is_array($m_log["log"])){
                    foreach ($m_log["log"] as $num => $info){
                        $log_text .=  "[".$num."] => ".$info."<br>";
                    }
                }else{
                    $log_text .=  "[1] => ".$m_log["log"]."<br>";
                }

            }
            $log_text .= "</div>";
        }else{
            $log_text = "<div class='input-line wd100'>".json_last_error_msg().": <br>".$this->fieldOptions["curVal"]."</div>";
        }

        $this->return_input = $log_text;
    }
}