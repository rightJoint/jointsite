<?php
namespace jointSite\core\Interfaces;
interface ControllerInterface
{
    //overwrite jointSite $loaded_view
    function loadViewCustom($action_name = null):string;

    //overwrite jointSite $loaded_model
    function loadModelCustom($action_name = null):string;

    //overwrite default lang_files lang_cntrl
    function loadLangControllerCustom():string;

    //default action
   // function action_index();
}