<?php

namespace JointApp\Views\Records;

use JointApp\Interfaces\LangWebViewInterface;
use JointApp\JointAppRequest;

class RecordDetailView extends RecordView
{
    public $record;
    public $viewFields = [];

    public string $logo = '/img/popimg/eye-icon.png';

    public $type = 'detail';

    public static function addStyleLinks(callable $addStyleLinks): void
    {
        parent::addStyleLinks($addStyleLinks);
        $addStyleLinks(['/css/records.css']);
    }

    public static function addScriptLinks(callable $addScriptLinks): void
    {
        parent::addScriptLinks($addScriptLinks);
        $addScriptLinks(['/js/records.js']);
    }

    public static function loadLangView(string $docRoot = __DIR__, string $viewLang = 'ru', $loads = []):LangWebViewInterface
    {
        $name = 'LangFiles_'.self::langNs($viewLang).'_Views_Templates_RecordDetail';
        $loads[] = [$name => $docRoot.'/JointApp/LangFiles/Views/Templates/'.$name];

        return parent::loadLangView($docRoot, $viewLang, $loads);
    }

    public function addViewParams($addViewParams)
    {
        parent::addViewParams($addViewParams);
        $addParams = new \stdClass();
        $addParams->type = $this->type;
        $addParams->viewFields = $this->viewFields;
        $addViewParams($addParams);
    }

    public static function createPageContent(\stdClass $langPageContent, \stdClass $viewParams):string
    {
        $pageContentText = '<div class="contentBlock-frame"><div class="contentBlock-center">'.
            '<div class="contentBlock-wrap">';

        $pageContentText.=self::printDetailView($langPageContent, $viewParams);

        $pageContentText.= '</div>'.
            '</div>'.
            '</div>';
        return $pageContentText;
    }

    public static function printDetailView(\stdClass $langPageContent, \stdClass $viewParams):string
    {

        $detailForm = '<div class="edit-record-frame">';
        if ($viewParams->h2) {
            $detailForm.= '<h2><a href="'.$viewParams->langSl.$viewParams->process_url.'">'.$viewParams->h2.'</a></h2>';
        }


        $detailForm.= '<form class="editForm" method="post">';
        if($viewParams->type=='delete'){
            $detailForm.= '<div class="submit-line"><span class="del-confirm">'.$langPageContent->del_confirm_txt.'</span>';
            if($viewParams->action_log){
                if($viewParams->action_log['result']){
                    $sub_class = 'well';
                }else{
                    $sub_class = 'fail';
                }
                $detailForm.= '<div class="action-log '.$sub_class.'">'.$viewParams->action_log['log'].'</div>';
            }
            $detailForm.= '<input type="submit" class="del-submit" value="'.$langPageContent->del_confirm_btn.'"> </div>'.
                '<input type="hidden" name="confirmdetelerecord" value=1>';
        }

        foreach ($viewParams->viewFields as $fieldName => $fieldData) {
            if(isset($viewParams->fieldAliases[$fieldName])){
                $name_input = $viewParams->fieldAliases[$fieldName];
            }else{
                $name_input = $fieldName;
            }

            $htmlInput = self::getInputType($fieldName, $fieldData, $name_input);
            $detailForm.= $htmlInput->getHtml();
        }
        $detailForm.= '</form>'.
            '</div>';

        return $detailForm;
    }
}