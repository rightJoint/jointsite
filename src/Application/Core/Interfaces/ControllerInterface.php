<?php

namespace JointSite\Core\Interfaces;

interface ControllerInterface
{
    //overwrite default lang_files lang_cntrl
    function loadLangControllerCustom():string;
}