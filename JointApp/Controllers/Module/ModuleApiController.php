<?php


namespace JointApp\Controllers\Module;


use JointApp\Controllers\Controller;
use JointApp\Controllers\ModuleController;
use JointApp\Factories\ModelFactory;
use JointApp\Models\ModuleModel;

class ModuleApiController extends Controller
{
    private string $module_api_login = '';
    private string $module_api_password = '';
    private string $componentName = '';

    private ModuleController $controllerComponent;
    private ModuleModel $modelComponent;

    public function checkAccessController(): bool
    {
        $modelFactory = new ModelFactory();
        $userModel = $modelFactory::createModelFromRequest($this->getRequest(), '\JointApp\Models\User\Model_User', []);
        $userModel->record["accLogin"]["curVal"] = $this->module_api_login;
        //$userModel = new Model_User();
        if ($userModel::checkUserLogin($userModel->record["accLogin"]["curVal"])){
            if($userModel::checkUserPassword($this->module_api_password)){
                if ($userModel->copyByLoginOrEmail()) {
                    if($userModel->record["validDate"]["curVal"]) {
                        if (!$userModel->record["blackList"]["curVal"]) {
                            if(password_verify($this->module_api_password, $userModel->record["pw_hash"]['curVal'])){
                                $userModel->authSiteUser();

                                $controllerName = '\JointApp\Controllers\Components\Controller_Components_'.$this->componentName;
                                $modelName = '\JointApp\Models\Components\Model_Components_'.$this->componentName;
                                $this->modelComponent = $modelFactory::createModelFromRequest($this->getRequest(), $modelName, []);
                                $this->controllerComponent = new $controllerName($this->getRequest(), $this->modelComponent, $this->view, []);

                                return true;
                            }else{
                                //$this->view->responseJson['log'] = 'signInErrWrongPass';
                            }
                        }else{
                           // $this->view->responseJson['log'] = 'signInErrBlackList';
                        }
                    }else{
                       // $this->view->responseJson['log'] = 'signInErrEMailValid';
                    }
                }else{
                    //$this->view->responseJson['log'] = 'signInErrNotFound';
                }
            }else{
                //$this->view->responseJson['log'] = 'signInErrPass';
            }
        }else{
            //$this->view->responseJson['log'] = 'signInErrLogin';
        }

        return false;
    }

    public function controllerFilterQuery($queryParams = []): void
    {
        parent::controllerFilterQuery($queryParams);
        if(isset($queryParams['module_api_login']) and !empty($queryParams['module_api_login'])){
            $this->module_api_login = $queryParams['module_api_login'];
        }
        if(isset($queryParams['module_api_password']) and !empty($queryParams['module_api_password'])){
            $this->module_api_password = $queryParams['module_api_password'];
        }
    }

    public function controllerFilterBody($bodyParams = []): void
    {
        parent::controllerFilterBody($bodyParams);
        if(isset($bodyParams['module_api_login']) and !empty($bodyParams['module_api_login'])){
            $this->module_api_login = $bodyParams['module_api_login'];
        }
        if(isset($bodyParams['module_api_password']) and !empty($bodyParams['module_api_password'])){
            $this->module_api_password = $bodyParams['module_api_password'];
        }
    }

    public function controllerFilterParams($controllerParams = []): void
    {
        parent::controllerFilterParams($controllerParams);
        if(isset($controllerParams['componentName']) and !empty($controllerParams['componentName'])){
            $this->componentName = $controllerParams['componentName'];
        }
    }

    public function getListRecords()
    {
        $this->controllerComponent->prepareSearchFields();
        $this->controllerComponent->prepareEditFields();
        $this->controllerComponent->updateModelRecordFromRequest();
        $this->controllerComponent->updateSearchFieldsFromRecord();
        $qBuilderList = $this->controllerComponent->filterWhere();
        $qBuilderCount = clone $qBuilderList;
        $qBuilderCount
            ->limit('')
            ->order('');

        $this->view->responseJson = array(
            'count' => $this->modelComponent->countRecords($qBuilderCount),
            'list' => $this->modelComponent->listRecords($qBuilderList),
        );

        return $this->view->responseJson;
    }

    public function getDetailRecord():void
    {
        $this->controllerComponent->prepareSearchFields();
        $this->controllerComponent->prepareEditFields();
        $this->controllerComponent->updateModelPriKeysFromRequest();
        if($this->modelComponent->copyRecord()){
            $this->view->responseJson = array(
                'result' => true,
                'log' => $this->modelComponent->log_message,
                'record' => $this->modelComponent->record,
            );
        }else{
            $this->view->responseJson = array(
                'result' => false,
                'log' => $this->modelComponent->log_message,
                'record' => [],
            );
        }

    }

    public function putRecord():void
    {
        $this->view->logMessage = '';
        $this->controllerComponent->prepareEditFields();
        $this->controllerComponent->updateModelRecordFromRequest();
        if($this->controllerComponent->updateEditFieldsFromRecord()){
            if($this->modelComponent->insertRecord()){
                $this->view->responseJson['result'] = true;
            }else{
                $this->view->responseJson['result'] = false;
                if(!empty($this->modelComponent->log_message)){
                    $this->view->logMessage = $this->modelComponent->log_message;
                }else{
                    $this->view->logMessage = 'denied-in-module-model';
                }
            }
        }else{
            $this->view->responseJson['result'] = false;
        }
        $this->view->responseJson['log'] = $this->view->logMessage;
        $this->view->responseJson['record'] = $this->modelComponent->record;
    }

    public function deleteRecord():void
    {
        $this->controllerComponent->prepareEditFields();
        $this->controllerComponent->updateModelPriKeysFromRequest();
        if ($this->modelComponent->copyRecord()) {
            if($this->modelComponent->deleteRecord()){
                $this->view->responseJson['result'] = true;
            }else{
                $this->view->responseJson['result'] = false;
                if(!empty($this->modelComponent->log_message)){
                    $this->view->responseJson['log'] = $this->modelComponent->log_message;
                }else{
                    $this->view->responseJson['log'] = 'denied-in-module-model';
                }
            }
        } else {
            $this->view->responseJson['result'] = false;
            if(!empty($this->modelComponent->log_message)){
                $this->view->responseJson['log'] = $this->modelComponent->log_message;
            }else{
                $this->view->responseJson['log'] = 'denied-in-module-model on copy';
            }
        }
    }

    public function editRecord():void
    {
        $this->controllerComponent->prepareEditFields();
        $this->controllerComponent->updateModelPriKeysFromRequest();
        if ($this->modelComponent->copyRecord()) {
            $this->controllerComponent->updateModelRecordFromRequest();
            if($this->controllerComponent->updateEditFieldsFromRecord()){
                $this->view->responseJson['result'] = $this->modelComponent->updateRecord();
                $this->controllerComponent->afterUpdateRecord();
                $this->view->responseJson['log'] = $this->modelComponent->log_message;
                $this->view->responseJson['record'] = $this->modelComponent->record;
            }else{
                $this->view->responseJson['result'] = false;
                $this->view->responseJson['log'] = $this->modelComponent->log_message;
            }
        } else {
            $this->view->responseJson['result'] = false;
            $this->view->responseJson['log'] = $this->modelComponent->log_message;
        }
    }
}