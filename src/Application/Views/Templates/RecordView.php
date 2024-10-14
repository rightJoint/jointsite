<?php

namespace JointSite\Views\Templates;

use JointSite\Views\SiteView;

class RecordView extends SiteView
{

    public $action_log = null;
    public $h2 = null;
    public $process_url = null;
    public $record = null;
    public $slave_req = null;

    public $shortcut_icon = "/img/popimg/admin-logo.png";

    function getTnputType( $fieldNname, $fieldOption = array(
        "format" => null,
        "fieldAliases" => array("en" => null, "rus" => null),
        "nameSpace" => null,
        "id" => null,
        "value" => null,
        "readonly" => null,
        "indexes" => null,
        "maxLength" => null, //for text and varchar format
        "style" => null, //for text and varchar format
    ),
                           $value = null)
    {
        $line_class = null;
        if(isset($fieldOption["style"]["class"]) and $fieldOption["style"]["class"] == "wd100"){
            $line_class = "wd100";
        }
        $id_print = null;
        if(isset($fieldOption["id"])){
            $id_print = "id='".$fieldOption["id"]."'";
        }

        if(isset($fieldOption["nameSpace"])){
            $name_print =$fieldOption["nameSpace"]."[".$fieldNname."]'";
        }else{
            $name_print ="'".$fieldNname."'";
        }

        $label_print ="<label";
        if(isset($fieldOption["id"])){
            $label_print .= " for='".$fieldOption["id"]."' ";
        }

        $name_print = "name=".$name_print;
        $readonly_print = null;
        $label_class = null;

        if(isset($fieldOption["readonly"])){
            if(!(!isset($this->record[$fieldNname]["fetchVal"]) and
                isset($this->record[$fieldNname]["indexes"]))){
                $readonly_print = " readonly";
                $label_class = "ro";
            }
        }

        if(isset($fieldOption["indexes"])){
            $label_class .= " idx";
        }

        if($label_class){
            $label_class = " class='".$label_class."'";
        }
        $label_print .= $label_class.">";

        if(isset($fieldOption["fieldAliases"][JOINT_SITE_APP_LANG])){
            $label_print .= $fieldOption["fieldAliases"][JOINT_SITE_APP_LANG];
        }else{
            $label_print .= $fieldNname;
        }
        $label_print .= ":</label>";

        if ($fieldOption["format"] == "text") {
            $value_print = $value;
        }elseif($fieldOption["format"] == "checkbox" or $fieldOption["format"] == "tinyint"){
            if($value){
                $value_print = "checked";
            }else{
                $value_print = null;
            }
            if(isset($fieldOption["readonly"])){
                $readonly_print = "onclick='return false;'";
            }
        }
        else {
            $value_print = " value='" . $value . "'";
        }

        if($fieldOption["format"] == "hidden"){
            return array("html" => "<input type='hidden' ".$name_print." ".$id_print." ".$value_print." ".$readonly_print.">");
        }elseif($fieldOption["format"] == "int"){
            $return_input = "<input type='number' ".$name_print." ".$id_print." ".$value_print." ".$readonly_print.">";
        }elseif ($fieldOption["format"] == "datetime"
            or $fieldOption["format"] == "varchar" or $fieldOption["format"] == "time" or $fieldOption["format"] == "float"){
            $return_input = "<input type='text' ".$name_print." ".$id_print." ".$value_print." ".$readonly_print.">";
        }elseif ($fieldOption["format"] == "text" or $fieldOption["format"] == "tinymce"){
            $return_input = "<textarea ".$name_print." ".$id_print." ".$readonly_print.">".$value_print."</textarea>";
        }elseif ($fieldOption["format"] == "date"){
            $return_input = "<input type='date' ".$name_print." ".$id_print." ".$value_print." ".$readonly_print.">";
        }elseif ($fieldOption["format"] == "checkbox" or $fieldOption["format"] == "tinyint"){
            $return_input = "<input type='checkbox' ".$name_print." ".$id_print." ".$value_print." ".$readonly_print.">";
        }elseif ($fieldOption["format"] == "select"){
            $return_input = "<select ".$name_print.">";
            foreach ($fieldOption["filling"] as $sVal=>$sOpt){
                $return_input .= "<option value='".$sVal."' ";
                if($sVal==$value){
                    $return_input .= "selected";
                }
                $return_input .= ">".$sOpt."</option>";
            }
            $return_input .= "</select>";

        }
        elseif($fieldOption["format"] == "find-select"){
            $fill_name_curVal = null;
            if(isset($this->record[$fieldOption["fillName"]]["curVal"])){
                $fill_name_curVal = $this->record[$fieldOption["fillName"]]["curVal"];
            }
            $return_input = "<div class='find-select' id='".$fieldNname."'>".
                "<input type='text' id='fst-".$fieldNname."' value='".$fill_name_curVal."'>".
                "<div class='fss'>".

                "<select size='5' id='fs-".$fieldNname."' name='".$fieldNname."'>".
                "<option value='".$value."' selected>".$fill_name_curVal."</option>".
                "</select>".
                "</div>".
                "</div>";
        }
        elseif($fieldOption["format"] == "file"){
            $return_input = "<input type='file' ".$name_print;
            if($fieldOption["file_options"]["accept"]){
                $return_input .= " accept='".$fieldOption["file_options"]["accept"]."'";
            }

            $return_input .=">";
            $cur_val_file = null;
            if(isset($this->record[$fieldNname]["curVal"])){
                $cur_val_file = $this->record[$fieldNname]["curVal"];
            }
            $return_input .= "<span class='file_val'>".$cur_val_file."</span>";
            if(isset($fieldOption["file_options"]["load_dir"]) and isset($this->record[$fieldNname]["curVal"])){
                if(isset($fieldOption["file_options"]["file_type"]) and
                    $fieldOption["file_options"]["file_type"] == "img"){
                    if(isset($fieldOption["replaces"])){
                        $imgLink = $fieldOption["file_options"]["load_dir"];
                        foreach ($fieldOption["replaces"] as $replace){
                            $imgLink = str_replace($replace, $this->record[$replace]["curVal"], $imgLink);
                        }
                    }else{
                        $imgLink = $fieldOption["file_options"]["load_dir"]."/".$value;
                    }
                    $return_input .= "<img class='cell-img float-l' src='".$imgLink."'>";
                }
            }
        }
        elseif($fieldOption["format"] == "list"){
            $return_input = "<input type='text' ".$name_print." ".$id_print." ".$value_print." ".$readonly_print." list='".$fieldNname."-list'>";

            $return_input .= "<datalist id='".$fieldNname."-list'>";
            foreach ($fieldOption["filling"] as $opt_id=>$optVal){
                //$radio_cnt++;
                $return_input .= " <option value='".$opt_id."'>".$optVal."</option>";

            }
            $return_input .="</datalist>";

        }
        else{
            $return_input = $fieldOption["format"];
        }

        return array(
            "html" => "<div class='input-line"." ".$line_class."'>".$label_print.$return_input."</div>",
            "line_class" => $line_class,
            "label_print" => $label_print,
            "readonly_print" => $readonly_print,
            "name_print" => $name_print,
            "id_print" => $id_print,
            "value_print" => $value_print,
            "return_input" =>$return_input,
        );


    }

    function format_slave_req():string
    {
        if(!$this->slave_req){
            return "";
        }else{
            return "?".$this->slave_req;
        }
    }
}