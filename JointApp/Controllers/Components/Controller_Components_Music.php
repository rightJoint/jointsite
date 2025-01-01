<?php


namespace JointApp\Controllers\Components;


use JointApp\Controllers\ModuleController;

class Controller_Components_Music extends ModuleController
{


    public function loadModuleConfig(): void
    {
        $this->mConfig = array("moduleTable" => "musicalb",
            "bindTables" => array(
                "musictracks" => [],
                "musictrackstoalb" => array(
                    "relationships" => array(
                        "album_id" => "album_id",
                    ),
                ),
            )
        );
    }
}