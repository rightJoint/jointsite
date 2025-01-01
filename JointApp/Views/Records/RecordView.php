<?php

namespace JointApp\Views\Records;

use JointApp\Views\HtmlInputs\HtmlInputView;
use JointApp\Views\SiteView;
use JointApp\Interfaces\HtmlInputViewInterface;
use JointApp\Views\HtmlInputs;

class RecordView extends SiteView
{
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
        $htmlInputView->htmlLineStyle();
        $htmlInputView->htmlLabel();
        $htmlInputView->htmlInput();

        return $htmlInputView;
    }
}