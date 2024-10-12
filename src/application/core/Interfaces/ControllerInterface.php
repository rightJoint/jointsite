<?php
namespace jointSite\core\Interfaces;
interface ControllerInterface
{
    //overwrite jointSite $loaded_view
    function LoadView_custom($action_name = null):string;

    //overwrite jointSite $loaded_model
    function LoadModel_custom($action_name = null):string;

    //overwrite default lang_files lang_cntrl
    function LoadCntrlLang_custom():string;

    //default action
   // function action_index();
}