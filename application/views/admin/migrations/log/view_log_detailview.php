<?php
require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
    "/application/views/templates/RecordView.php";
require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
    "/application/views/templates/RecordDetailView.php";
class view_log_detailview extends RecordDetailView
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

            if(isset($fieldOption["fieldAliases"][$_SESSION[JS_SAIK]["lang"]])){
                $label_print .= $fieldOption["fieldAliases"][$_SESSION[JS_SAIK]["lang"]];
            }else{
                $label_print .= $fieldNname;
            }
            $label_print .= ":</label>";

            $m_log = json_decode($this->record["migration_log"]["curVal"], true);

            $log_text = "<div class='input-line wd100'>".$label_print.
                "err: ".$m_log["err"]."<br>";
            if($m_log["log"]){
                if(is_array($m_log["log"])){
                    foreach ($m_log["log"] as $num => $info){
                        $log_text .=  "[".$num."] => ".$info."<br>";
                    }
                }else{
                    $log_text .=  "[1] => ".$m_log["log"]."<br>";
                }

            }
            $log_text .= "</div>";
            return array(
                "html" => $log_text,
            );
        }else{
            return parent::getTnputType($fieldNname, $fieldOption, $value); // TODO: Change the autogenerated stub
        }
    }
}