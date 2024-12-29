<?php

namespace JointApp\Views\Records;

use JointApp\Views\HtmlInputs\HtmlInputView;
use JointApp\Views\SiteView;
use JointApp\Interfaces\HtmlInputViewInterface;
use JointApp\Views\HtmlInputs;

class RecordView extends SiteView
{
    /*viewFilterBody-----------------------------------------------------*/
    //recordStructuteFields->record (rsf) from model
    public $record = [];
    //model name from model->lang_map
    public $h2 = null;
    //process uri (without lang and action) from controller
    public string $process_url = '';
    //fieldAliases form model->lang_map
    public $fieldAliases = [];
    //-----------------------------------------------------------


    public string $shortcut_icon = '/img/popimg/admin-logo.png';


    public function addViewParams($addViewParams)
    {
        parent::addViewParams($addViewParams);
        $addParams = new \stdClass();
        $addParams->record = $this->record;
        $addParams->h2 = $this->h2;
        $addParams->process_url = $this->process_url;
        $addParams->fieldAliases = $this->fieldAliases;
        $addViewParams($addParams);
    }

    static function getInputType($fieldName, $fieldOption = [], string $fieldAlias = ''):HtmlInputViewInterface
    {
        $inputClass = 'JointApp\Views\HtmlInputs\Html'.ucfirst($fieldOption['format']).'Type';
        $htmlInputView = new $inputClass($fieldName, $fieldOption, $fieldAlias);

        $htmlInputView->htmlLabelStyle();
        $htmlInputView->htmlId();
        $htmlInputView->htmlName();
        $htmlInputView->htmlReadonly();
        $htmlInputView->htmlValue();
/*
        if($fieldOption['format'] == 'hidden'){
            return array('html' => '<input type="hidden" '.$htmlInputView->name_print.' '.$htmlInputView->id_print.' '.$htmlInputView->value_print.' '.$htmlInputView->readonly_print.'>');
        }

        elseif($fieldOption['format'] == 'int'){
            $return_input = '<input type="number" '.$htmlInputView->name_print.' '.$htmlInputView->id_print.' '.$htmlInputView->value_print.' '.$htmlInputView->readonly_print.'>';
        }

            elseif ($fieldOption['format'] == 'datetime'
            or $fieldOption['format'] == 'varchar'
                or $fieldOption['format'] == 'time'
                or $fieldOption['format'] == 'float'){
            $return_input = '<input type="text" '.$htmlInputView->name_print.' '.$htmlInputView->id_print.' '.$htmlInputView->value_print.' '.$htmlInputView->readonly_print.'>';
        }

            elseif ($fieldOption['format'] == 'text'
                or $fieldOption['format'] == 'tinymce'){
            $return_input = '<textarea '.$htmlInputView->name_print.' '.$htmlInputView->id_print.' '.$htmlInputView->readonly_print.'>'.$htmlInputView->value_print.'</textarea>';
        }

            elseif ($fieldOption['format'] == 'date'){
            $return_input = '<input type="date" '.$htmlInputView->name_print.' '.$htmlInputView->id_print.' '.$htmlInputView->value_print.' '.$htmlInputView->readonly_print.'>';
        }

        elseif ($fieldOption['format'] == 'checkbox'
            or $fieldOption['format'] == 'tinyint'){
            $return_input = '<input type="checkbox" '.$htmlInputView->name_print.' '.$htmlInputView->id_print.' '.$htmlInputView->value_print.' '.$htmlInputView->readonly_print.'>';
        }

        elseif ($fieldOption['format'] == 'select'){
            $return_input = '<select '.$htmlInputView->name_print.'>';
            foreach ($fieldOption['filling'] as $sVal=>$sOpt){
                $return_input .= '<option value="'.$sVal.'" ';
                if($sVal==$fieldOption['curVal']){
                    $return_input .= 'selected';
                }
                $return_input .= '>'.$sOpt.'</option>';
            }
            $return_input .= '</select>';

        }
        /*
        elseif($fieldOption['format'] == 'find-select'){
            $fill_name_curVal = null;
            if(isset($this->record[$fieldOption['fillName']]['curVal'])){
                $fill_name_curVal = $this->record[$fieldOption['fillName']]['curVal'];
            }
            $return_input = '<div class="find-select" id="'.$fieldName.'">'.
                '<input type="text" id="fst-'.$fieldName.'" value="'.$fill_name_curVal.'">'.
                '<div class="fss">'.

                '<select size="5" id="fs-'.$fieldName.'" name="'.$fieldName.'">'.
                '<option value="'.$fieldOption['curVal'].'" selected>'.$fill_name_curVal.'</option>'.
                '</select>'.
                '</div>'.
                '</div>';
        }*/
        /*
        elseif($fieldOption['format'] == 'file'){
            $return_input = '<input type="file" '.$htmlInputView->name_print;
            if($fieldOption['file_options']['accept']){
                $return_input .= ' accept="'.$fieldOption['file_options']['accept'].'"';
            }

            $return_input .='>';
            $cur_val_file = null;
            if($fieldOption['curVal']){
                $cur_val_file = $fieldOption[$fieldName]['curVal'];
            }
            $return_input .= '<span class="file_val">'.$cur_val_file.'</span>';
            if(isset($fieldOption['file_options']['load_dir']) and isset($fieldOption[$fieldName]['curVal'])){
                if(isset($fieldOption['file_options']['file_type']) and
                    $fieldOption['file_options']['file_type'] == 'img'){
                    if(isset($fieldOption['replaces'])){
                        $imgLink = $fieldOption['file_options']['load_dir'];
                        foreach ($fieldOption['replaces'] as $replace){
                            //$imgLink = str_replace($replace, $this->record[$replace]['curVal'], $imgLink);
                        }
                    }else{
                        $imgLink = $fieldOption['file_options']['load_dir'].'/'.$fieldOption['curVal'];
                    }
                    $return_input .= '<img class="cell-img float-l" src="'.$imgLink.'">';
                }
            }
        }
        elseif($fieldOption['format'] == 'list'){
            $return_input = '<input type="text" '.$htmlInputView->name_print.' '.$htmlInputView->id_print.' '.$htmlInputView->value_print.' '.
                $htmlInputView->readonly_print.' list="'.$fieldName.'-list">';

            $return_input .= '<datalist id="'.$fieldName.'-list">';
            foreach ($fieldOption['filling'] as $opt_id=>$optVal){
                //$radio_cnt++;
                $return_input .= ' <option value="'.$opt_id.'">'.$optVal.'</option>';

            }
            $return_input .='</datalist>';

        }
        else{
            $return_input = $fieldOption["format"];
        }
*/
        $htmlInputView->htmlLineStyle();
        $htmlInputView->htmlLabel();
        //$htmlInputView->readonly_print = $readonly_print;
        //$htmlInputView->name_print = $name_print;
        //$htmlInputView->id_print = $id_print;
        //$htmlInputView->value_print = $value_print;
        $htmlInputView->htmlInput();

        return $htmlInputView;
    }
}