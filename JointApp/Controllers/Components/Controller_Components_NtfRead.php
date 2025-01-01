<?php


namespace JointApp\Controllers\Components;


use JointApp\Controllers\ModuleController;

class Controller_Components_NtfRead extends ModuleController
{
    public string $moduleName = 'ntfread';

    public string $processUri = '/siteman/ntfread';

    public function loadBindComponents(): void
    {
        $this->bindComponents = array(
            "ntftemplates" => [],
            "ntflist" => [],
        );
    }
}