<?php
require_once "application/core/Module/ModuleEditView.php";
require_once "application/core/Module/ModuleMenu.php";
class sitemanEditView extends ModuleEditView
{

    function print_page_content()
    {
        echo moduleMenu::print_module_menu($this->module);
        parent::print_page_content();
    }
}