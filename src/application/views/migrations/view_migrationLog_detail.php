<?php
require_once JOINT_SITE_REQUIRE_DIR."/application/views/templates/RecordView.php";
require_once JOINT_SITE_REQUIRE_DIR."/application/views/templates/RecordDetailView.php";
class view_migrationLog_detail extends RecordDetailView
{
    function getTnputType($fieldNname, $fieldOption = array(
        "format" => null,
        "fieldAliases" => array("en" => null, "rus" => null),
        "nameSpace" => null,
        "id" => null,
        "value" => null,
        "readonly" => null,
        "indexes" => null,
        "maxLength" => null, //for text and varchar format
        "style" => null, //for text and varchar format
    ), $value = null)
    {
        if($fieldOption["format"] == "log_html"){

            $label_print ="<label";
            if(isset($fieldOption["id"])){
                $label_print .= " for='".$fieldOption["id"]."' ";
            }
            $label_print .= ">";

            if(isset($fieldOption["fieldAliases"][JOINT_SITE_APP_LANG])){
                $label_print .= $fieldOption["fieldAliases"][JOINT_SITE_APP_LANG];
            }else{
                $label_print .= $fieldNname;
            }
            $label_print .= ":</label>";

            if($m_log = json_decode($this->record["migration_log"]["curVal"], true)){
                $log_text = "<div class='input-line wd100'>".$label_print.
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
                $log_text = "<div class='input-line wd100'>".json_last_error_msg().": <br>".$this->record["migration_log"]["curVal"]."</div>";
            }
            return array(
                "html" => $log_text,
            );
        }else{
            return parent::getTnputType($fieldNname, $fieldOption, $value); // TODO: Change the autogenerated stub
        }
    }
}