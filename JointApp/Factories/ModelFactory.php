<?php


namespace JointApp\Factories;


use JointApp\JointAppRequest;

class ModelFactory
{
    public static function createModelFromRequest(JointAppRequest $request, string $modelName, $modelParams = [])
    {
        if($modelName == 'JointApp\Models\Model'){
            return new $modelName();
        }else{
            $model = new $modelName($request->docRoot, $request->configDir, $modelParams, $request->langLw);
            $model->files = $request->getUploadedFiles();
            return $model;
        }
    }

    public static function createFromExistModel($newModelName, $existModelName, $newModelParams = [])
    {
        if($newModelName == 'JointApp\Models\Model'){
            return new $newModelName();
        }else{
            $newModel = new $newModelName($existModelName->docRoot, $existModelName->configDir, $newModelParams, $existModelName->langLw);
            return $newModel;
        }
    }
}