<?php


namespace JointApp\Controllers\Components;


use JointApp\Controllers\ModuleController;

class Controller_Components_KipNotes extends ModuleController
{

    public string $moduleName = 'kipnotes';

    public string $processUri = '/siteman/kipnotes';

    public function loadBindComponents(): void
    {
        $this->bindComponents = array(
            "kiptasks" => [],
        );
    }
}