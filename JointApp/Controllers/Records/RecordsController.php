<?php

namespace JointApp\Controllers\Records;


use JointApp\Controllers\Controller;
use JointApp\Interfaces\RecordsControllerInterface;
use JointApp\JointAppQueryBuilder;

class RecordsController extends Controller implements RecordsControllerInterface
{
    /*2-controllerFilterParams---------------------------------------------*/
    public string $processUri = '';

    public $editFields = [];
    public $listFields = [];
    public $searchFields = [];
    public $viewFields = [];
    /*3-controllerFilterBody or controllerFilterQuery----------------------*/
    protected bool $applyFilterRecord = false;
    protected string $submitText = '';

    //update view params
    protected int $viewCurPage = 1;
    protected int $viewOnPage = 10;

    public function loadLangController():string
    {
        parent::loadLangController();
        $name = 'LangFiles_'.$this->langNs.'_Controller_Records';
        require_once $this->docRoot.'/JointApp/LangFiles/Controllers/'.$name.'.php';
        return $name;
    }

    public function controllerFilterParams($controllerParams = []): void
    {
        if((isset($controllerParams['processUri']) and !empty($controllerParams['processUri'])
            and empty($this->processUri))){
            $this->processUri = $controllerParams['processUri'];
        }
    }

    public function controllerFilterBody($bodyParams = []):void
    {
        if(isset($bodyParams['applyFilterRec'])){
            $this->applyFilterRecord = $bodyParams['applyFilterRec'];
        }
        if(isset($bodyParams['submit'])){
            $this->submitText = $bodyParams['submit'];
        }
        if(isset($bodyParams['curPage'])){
            $this->viewCurPage = $bodyParams['curPage'];
        }
        if(isset($bodyParams['onPage'])){
            $this->viewOnPage = $bodyParams['onPage'];
        }
    }

    public function prepareListFields():void
    {

        $this->prepareListButtons();

        foreach ($this->model->record as $fieldName => $fieldOpt){;
            $this->listFields[$fieldName]['format'] = $fieldOpt['format'];
        }
    }
    public function prepareListButtons():void
    {
        $replaceUrl = null;
        foreach ($this->model->record as $fieldName => $fieldOpt){
            if(isset($fieldOpt['pri']) and $fieldOpt['pri'] = 1){

                $replaceUrl.=$fieldName.'='.$fieldName.'&';
                $this->listFields['btnDetail']['replaces'][] = $fieldName;
                $this->listFields['btnEdit']['replaces'][] = $fieldName;
                $this->listFields['btnDelete']['replaces'][] = $fieldName;
            }
        }
        $this->listFields['btnDetail']['format'] = 'link';
        $this->listFields['btnEdit']['format'] = 'link';
        $this->listFields['btnDelete']['format'] = 'link';

        $replaceUrl=substr($replaceUrl, 0, strlen($replaceUrl)-1);
        $this->listFields['btnDetail']['url'] = $replaceUrl;
        $this->listFields['btnEdit']['url'] = $replaceUrl;
        $this->listFields['btnDelete']['url'] = $replaceUrl;
    }


    public function prepareSearchFields():void
    {
        foreach ($this->model->record as $fieldName => $fieldOpt){
            $this->searchFields[$fieldName]['search'] = true;
            $this->searchFields[$fieldName]['sort'] = true;
            $this->searchFields[$fieldName]['format'] = $fieldOpt['format'];
        }
    }

    //create view->viewFields
    public function prepareViewFields():void
    {
        foreach ($this->model->record as $fieldName => $fieldOpt){
            $this->viewFields[$fieldName]['readonly'] = 1;
            $this->viewFields[$fieldName]['format'] = $fieldOpt['format'];
        }
    }

    public function prepareEditFields():void
    {
        foreach ($this->model->record as $fieldName => $fieldOpt){
            $this->editFields[$fieldName]['format'] = $fieldOpt['format'];
            $this->editFields[$fieldName]['curVal'] = '';
            if(isset($fieldOpt['pri']) and $fieldOpt['pri']==1){
                $this->editFields[$fieldName]['pri'] = true;
            }
            if(isset($fieldOpt['auto_increment']) and $fieldOpt['auto_increment'] == true){
                $this->editFields[$fieldName]['readonly'] = true;
            }
        }
    }

    public function updateModelRecordFromRequest():void
    {
        if(isset($this->model->record)){
            foreach ($this->model->record as $fName=>$fData){
                if(isset($this->editFields[$fName])){
                    if(($fData['format']=='checkbox') or ($fData['format'] == 'tinyint')){
                        if(isset($this->requestParams[$fName]) and $this->requestParams[$fName] == 'on'){
                            $this->model->record[$fName]['curVal'] = 1;
                        }else{
                            $this->model->record[$fName]['curVal'] = 0;
                        }
                    }else{
                        if(isset($this->requestParams[$fName])){
                            $this->model->record[$fName]['curVal'] = $this->requestParams[$fName];
                        }else{
                            if(isset($this->record[$fName]['fetchVal'])){
                                $this->model->record[$fName]['curVal'] = '';
                            }else{
                                $this->model->record[$fName]['curVal']=null;
                            }
                        }
                    }
                }
            }
        }
    }

    public function updateSearchFieldsFromRecord():void
    {
        foreach ($this->searchFields as $fName => $fOpt){
            if(isset($this->model->record[$fName]['curVal'])){
                $this->searchFields[$fName]['curVal'] = $this->model->record[$fName]['curVal'];
            }else{
                $this->searchFields[$fName]['curVal'] = null;
            }
        }
    }

    public function updateViewFieldsFromRecord():void
    {
        foreach ($this->view->viewFields as $fName => $fOpt){
            if(isset($this->model->record[$fName]['curVal'])){
                $this->view->viewFields[$fName]['curVal'] = $this->model->record[$fName]['curVal'];
            }else{
                $this->view->viewFields[$fName]['curVal'] = null;
            }
        }
    }

    public function updateEditFieldsFromRecord():bool
    {
        $return = true;
        foreach ($this->editFields as $fName => $fOpt){
            if(isset($this->model->record[$fName]['curVal'])){
                $this->editFields[$fName]['curVal'] = $this->model->record[$fName]['curVal'];
            }else{
                $this->editFields[$fName]['curVal'] = null;
            }
            //used in find-select control
            if(isset($this->model->record[$fName]['findVal'])){
                $this->editFields[$fName]['findVal'] = $this->model->record[$fName]['findVal'];
            }
            if(isset($fOpt['accept'])){
                //check isset field (case when select)
                if(isset($this->editFields[$fName]['curVal'])){
                    if(!preg_match($fOpt['accept'], $this->editFields[$fName]['curVal'])){
                        $fName_p = $fName;
                        if(isset($this->langMap->fieldAliases[$fName])){
                            $fName_p = $this->langMap->fieldAliases[$fName];
                        }
                        $this->view->logMessage .= $fName_p.' '.$this->langMap->editF_accept_err.'; ';
                        $return = false;
                    }
                }else{
                    $this->view->logMessage .= $fName.' '.$this->langMap->editF_accept_err.'; ';
                    $return = false;
                }
            }
        }
        return $return;
    }

    //set up view fields
    protected function prepareViewParams():void
    {
        $this->view->curPage = $this->viewCurPage;
        $this->view->onPage = $this->viewOnPage;
        $this->view->list_frame_id = $this->model->tableName;
        $this->view->h2 = $this->model->tableName;
        $this->view->process_url = $this->processUri;
        if(isset($this->langMap->fieldAliases)){
            $this->view->fieldAliases = $this->langMap->fieldAliases;
        }
        //create fieldAliases from model
        else{
            foreach ($this->model->record as $fN => $fOpt){
                $this->view->fieldAliases[$fN] = $fN;
            }
        }
    }















    function getListView():void
    {
        $this->prepareSearchFields();
        $this->prepareEditFields();
        $this->updateModelRecordFromRequest();
        $this->updateSearchFieldsFromRecord();
        $qBuilderList = $this->filterWhere();
        $qBuilderCount = clone $qBuilderList;
        $qBuilderCount
            ->limit('')
            ->order('');

        $this->view->listCount = $this->model->countRecords($qBuilderCount);
        $this->prepareListFields();
        $this->view->listFields = $this->listFields;
        $this->view->listRecords = $this->model->listRecords($qBuilderList);
        $this->view->searchFields = $this->searchFields;
        $this->prepareViewParams();
    }










    public function applyFilterView():void
    {
        if ($this->applyFilterRecord) {
            $viewLang_name = $this->view::loadLangView($this->docRoot, $this->langLw);
            $viewLang = new $viewLang_name;
            $viewLang_pageContent = $viewLang::getLangPageContent();

            $this->prepareSearchFields();
            $this->view->searchFields = $this->searchFields;
            $listRec_arr = $this->getListRecords();

            $viewParams = new \stdClass();
            $this->prepareListFields();
            $this->view->listFields = $this->listFields;
            $viewParams->listFields = $this->view->listFields;
            $viewParams->listRecords = $listRec_arr['list'];


            $viewParams->langSl = $this->langSl;
            $viewParams->process_url = $this->processUri;
            $viewParams->list_frame_id = $this->model->tableName;
            $viewParams->listCount = $listRec_arr['count'];
            $viewParams->curPage = $this->viewCurPage;
            $viewParams->onPage = $this->viewOnPage;

            if(isset($this->langMap->fieldAliases)){
                $viewParams->fieldAliases = $this->langMap->fieldAliases;
            }
            //create fieldAliases from model
            else{
                foreach ($this->model->record as $fN => $fOpt){
                    $viewParams->fieldAliases[$fN] = $fN;
                }
            }

            $this->view->responseJson = array(
                'listView' => $this->view->listViewTable($viewLang_pageContent->fiterView, $viewParams),
                'pgView' => $this->view->listPgView($viewLang_pageContent->fiterView, $viewParams),
                'jsCtrlPanel' => $this->view->scriptListViewCrtlPannel($viewParams->list_frame_id, $viewParams->process_url, ''),
            );
        }
    }

    //list records array from model
    public function getListRecords():array
    {
        $qBuilderCount = $this->filterWhere();
        $qBuilderList = clone ($qBuilderCount);
        $qBuilderCount
            ->order('')
            ->limit('');



        return array(
            'count' => $this->model->countRecords($qBuilderCount),
            'list' => $this->model->listRecords($qBuilderList),
        );
    }

    public function filterWhere():JointAppQueryBuilder
    {
        $qBuilder = new JointAppQueryBuilder();
        $return_order = null;

        foreach ($this->searchFields as $fName=>$fData){
            $useFieldName = $fName;
            if(isset($fData['use_table_name'])){
                $useTableName = $fData['use_table_name'];
                if(isset($fData['use_field_name'])){
                    $useFieldName = $fData['use_field_name'];
                }
            }else{
                $useTableName = $this->model->tableName;
            }
            //echo $fName.'<br>';



            if(isset($this->requestParams[$fName]) and $this->requestParams[$fName]!= null){


                if(isset($fData['group_by_field'])){
                    if($fData['format']=='varchar' || $fData['format'] == 'text'){
                        $qBuilder->having .= $useFieldName.' like '%'.$this->requestParams[$fName].'%' and ';
                    }elseif($fData['format']=='int'){
                        $qBuilder->having .= $useFieldName.' = '.$this->requestParams[$fName].' and ';
                    }else{
                        $qBuilder->having .= $useFieldName.' = "'.$this->requestParams[$fName].'" and ';
                    }
                }elseif($fData['format']=='checkbox' or $fData['format']=='tinyint'){
                    if($this->requestParams[$fName] == 'on'){
                        $qBuilder->where.=$useTableName.'.'.$useFieldName.'=true and ';
                        $this->model->record[$fName]['curVal'] = 1;
                    }else{
                        $qBuilder->where.=$useTableName.'.'.$useFieldName.'=false and ';
                        $this->model->record[$fName]['curVal'] = 0;
                    }
                }elseif($fData['format']=='int'){
                    $qBuilder->where.=$useTableName.'.'.$useFieldName.' = '.$this->requestParams[$fName].' and ';
                }elseif($fData['format']=='varchar' || $fData['format'] == 'text'){
                    $qBuilder->where.=$useTableName.'.'.$useFieldName.' like "%'.$this->requestParams[$fName].'%" and ';
                    //$qBuilder->where.=$useTableName.'.'.$useFieldName." like '%'.$this->requestParams[$fName].'"% and ';
                }else{
                    $qBuilder->where.=$useTableName.'.'.$useFieldName.' = "'.$this->requestParams[$fName].'" and ';
                }
            }
        }

        $qBuilder->where = substr($qBuilder->where, 0 , strlen($qBuilder->where)-4);

        $qBuilder->having=substr($qBuilder->having, 0 , strlen($qBuilder->having)-4);


        if(isset($this->requestParams['onPage'])){
            if($this->requestParams['curPage']){
                $qBuilder->limit.=(($this->requestParams['curPage']-1)*$this->requestParams['onPage']).", ".$this->requestParams['onPage'];
            }
        }else{
            $qBuilder->limit.='10';
        }

        if(isset($this->requestParams['sortField'])){

            if(isset($this->searchFields[$this->requestParams['sortField']]['use_table_name'])){
                $sort_table_name = $this->searchFields[$this->requestParams['sortField']]['use_table_name'].'.';

                if(isset($this->searchFields[$this->requestParams['sortField']]['use_field_name'])){
                    $sort_field_name = $this->searchFields[$this->requestParams['sortField']]['use_field_name'];
                }else{
                    $sort_field_name = $this->requestParams['sortField'];
                }

            }elseif (isset($this->searchFields[$this->requestParams['sortField']]['group_by_field'])){
                $sort_field_name = $this->requestParams['sortField'];
                $sort_table_name = null;
            }else{
                $sort_field_name = $this->requestParams['sortField'];
                $sort_table_name = $this->model->tableName.'.';
            }
            $return_order.= $sort_table_name.$sort_field_name;
            if(isset($this->requestParams['sortOrder'])){
                $return_order.=" ".$this->requestParams['sortOrder'];
            }
        }
        //sort by first field in view->searchFields
        else{
            $field_sort_default = null;
            foreach ($this->searchFields as $search_field => $sf_opt){
                if(isset($sf_opt['sort']) and $sf_opt['format'] != 'hidden'){
                    $field_sort_default = $search_field;
                    break;
                }
            }
            if($field_sort_default){
                if(isset($this->searchFields[$field_sort_default]['use_table_name'])){
                    $sort_table_name = $this->searchFields[$field_sort_default]['use_table_name'].'.';

                    if(isset($this->searchFields[$field_sort_default]['use_field_name'])){
                        $sort_field_name = $this->searchFields[$field_sort_default]['use_field_name'];
                    }else{
                        $sort_field_name = $field_sort_default;
                    }

                }else{
                    $sort_field_name = $field_sort_default;
                    $sort_table_name = $this->model->tableName.'.';
                }

                $return_order.= $sort_table_name.$sort_field_name;
                if(isset($this->searchFields[$field_sort_default]['sortOrder'])){
                    $return_order.=" ".$this->searchFields[$field_sort_default]['sortOrder'];
                }
            }
        }

        $qBuilder->order = $return_order;

        return $qBuilder;
    }

    //action to display DetailView
    public function getDetailView():void
    {
        $this->prepareEditFields();
        $this->updateModelRecordFromRequest();
        if($this->model->copyRecord()){
            $this->prepareViewFields();
            $this->view->viewFields = $this->viewFields;
            $this->updateViewFieldsFromRecord();
            $this->prepareViewParams();
        }else{
            $this->logger->emergency($this->model->log_message,
                $this->logger->logger_context);
        }
    }

    //action to display EditView on get
    public function getEditView():void
    {
        $this->prepareEditFields();
        $this->updateModelRecordFromRequest();
        if ($this->model->copyRecord()) {
            $this->updateEditFieldsFromRecord();
            $this->view->editFields = $this->editFields;
            $this->prepareViewParams();
        }else{
            $this->logger->emergency($this->model->log_message,
                $this->logger->logger_context);
        }
    }

    //action to display EditView on post
    public function postEditView():void
    {
        if ($this->submitText) {
            $this->prepareEditFields();
            $this->updateModelRecordFromRequest();
            if ($this->model->copyRecord()) {
                $this->updateModelRecordFromRequest();
                if($this->view->actionResult = $this->updateEditFieldsFromRecord()){
                    $this->view->actionResult = $this->model->updateRecord();

                    //fields format file need update
                    $this->updateEditFieldsFromRecord();

                    $this->afterUpdateRecord();
                    $this->view->logMessage = $this->model->log_message;
                }else{
                    $this->view->actionResult = false;
                    //$this->view->logMessage = $this->model->log_message;
                }
            } else {
                $this->view->actionResult = false;
                $this->view->logMessage = $this->model->log_message;
            }
            $this->view->editFields = $this->editFields;
            $this->prepareViewParams();
        }
    }

    public function afterUpdateRecord()
    {

    }


    public function getDeleteView():void
    {
        $this->prepareViewFields();
        $this->prepareEditFields();
        $this->updateModelRecordFromRequest();
        if($this->model->copyRecord()){
            $this->view->type = "delete";
            $this->updateEditFieldsFromRecord();
            $this->prepareViewParams();
            $this->view->editFields = $this->editFields;
        }else{
            $this->logger->emergency($this->model->log_message,
                $this->logger->logger_context);
        }
    }

    public function postDeleteView():void
    {
        if ($this->submitText) {
            $this->view->type = "delete";
            $this->prepareEditFields();
            $this->updateModelRecordFromRequest();
            if ($this->model->copyRecord()) {
                if($this->model->deleteRecord()){
                    $this->view->actionResult = true;
                    $this->logger->redirect($this->processUri);
                }else{
                    $this->view->logMessage = $this->model->log_message;
                    $this->view->actionResult = false;
                    $this->view->editFields = $this->editFields;
                    $this->prepareViewParams();
                }
            } else {
                $this->logger->debug($this->model->log_message, $this->logger->logger_context);
            }
        }
    }

    public function getNewView():void
    {
        $this->view->type = "new";
        $this->prepareEditFields();

        //update editFields if use request query params
        $this->updateModelRecordFromRequest();
        $this->model->copyCustomFields();
        $this->updateEditFieldsFromRecord();

        $this->view->editFields = $this->editFields;

        $this->prepareViewParams();
    }

    public function postNewView():void
    {
        $this->view->type = "new";
        if ($this->submitText) {
            $this->prepareEditFields();

            $this->updateModelRecordFromRequest();
            //$this->updateEditFieldsFromRecord();
            $this->model->copyCustomFields();
            if($this->view->actionResult = $this->updateEditFieldsFromRecord())
            {
                if($this->view->actionResult = $this->model->insertRecord())
                {
                    $this->view->logMessage = $this->model->log_message;
                    $get_str = null;
                    foreach ($this->model->record as $fName => $fData) {
                        if (isset($fData['pri']) and ($fData['pri'] == true)) {
                            $get_str .= $fName.'='.$fData['curVal'].'&';
                        }
                    }
                    $get_str = substr($get_str, 0, strlen($get_str) - 1);
                    $this->logger->redirect($this->processUri . '/editview?' . $get_str);
                }else{

                    $this->view->actionResult = false;
                    $this->view->logMessage = $this->model->log_message;
                }
            }//else{
                //$this->view->logMessage = 'xxx';
            //}
        }
        $this->view->editFields = $this->editFields;
        $this->prepareViewParams();
    }
}