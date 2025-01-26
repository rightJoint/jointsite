<?php

namespace JointApp\Controllers\Records;



class RecordsApiController extends RecordsController
{
    public string $api_record_access_token = '';

    public function controllerFilterBody($bodyParams = []): void
    {
        parent::controllerFilterBody($bodyParams);
        if(isset($bodyParams['api_record_access_token']) and !empty($bodyParams['api_record_access_token'])){
            $this->api_record_access_token = $bodyParams['api_record_access_token'];
        }
    }

    public function controllerFilterQuery($queryParams = []): void
    {
        parent::controllerFilterQuery($queryParams);
        if(isset($queryParams['api_record_access_token']) and !empty($queryParams['api_record_access_token'])){
            $this->api_record_access_token = $queryParams['api_record_access_token'];
        }
    }

    public function checkAccessController(): bool
    {
        $return = false;
        if(!empty($this->api_record_access_token)){
            require_once '__config/apiAccessToken.php';
            if(\apiAccessToken::TOKEN == $this->api_record_access_token){
                $return = true;
            }else{
                $this->logger->error('checkAccessController wrong api_record_access_token',
                    $this->logger->logger_context
                );
            }
        }else{
            $this->logger->error('checkAccessController empty or null api_record_access_token',
                $this->logger->logger_context
            );
        }

        return $return;
    }

    function getListRecords():array
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

        $this->view->responseJson = array(
            'count' => $this->model->countRecords($qBuilderCount),
            'list' => $this->model->listRecords($qBuilderList),
        );

        return $this->view->responseJson;
    }

    public function getDetailRecord():void
    {
        $this->prepareSearchFields();
        $this->prepareEditFields();
        $this->updateModelRecordFromRequest();
        $this->view->responseJson = array(
            'result' => $this->model->copyRecord(),
            'log' => $this->model->log_message,
            'record' => $this->model->record,
        );
    }

    public function putRecord():void
    {
        $this->prepareEditFields();
        $this->updateModelRecordFromRequest();
        $this->updateEditFieldsFromRecord();
        if($this->updateEditFieldsFromRecord()){
            $this->view->responseJson['result'] = $this->model->insertRecord();
        }else{
            $this->view->responseJson['result'] = false;
        }
        $this->view->responseJson['log'] = $this->model->log_message;
        $this->view->responseJson['record'] = $this->model->record;
    }

    public function deleteRecord():void
    {
        $this->prepareEditFields();
        $this->updateModelRecordFromRequest();
        if ($this->model->copyRecord()) {
            if($this->model->deleteRecord()){
                $this->view->responseJson['result'] = true;
            }else{
                $this->view->responseJson['log'] = $this->model->log_message;
                $this->view->responseJson['result'] = false;
            }
        } else {
            $this->logger->debug($this->model->log_message, $this->logger->logger_context);
        }
    }

    public function editRecord():void
    {
        $this->prepareEditFields();
        $this->updateModelRecordFromRequest();
        if ($this->model->copyRecord()) {
            $this->updateModelRecordFromRequest();
            if($this->updateEditFieldsFromRecord()){
                $this->view->responseJson['result'] = $this->model->updateRecord();
                $this->afterUpdateRecord();
                $this->view->responseJson['log'] = $this->model->log_message;
                $this->view->responseJson['record'] = $this->model->record;
            }else{
                $this->view->responseJson['result'] = false;
                $this->view->responseJson['log'] = $this->model->log_message;
            }
        } else {
            $this->view->responseJson['result'] = false;
            $this->view->responseJson['log'] = $this->model->log_message;
        }
    }
}