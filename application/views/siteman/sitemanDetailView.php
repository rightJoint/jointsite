<?php
require_once "application/core/Module/ModuleMenu.php";
require_once "application/core/Module/ModuleDetailView.php";
class sitemanDetailView extends ModuleDetailView
{
    function print_page_content()
    {
        echo moduleMenu::print_module_menu($this->module);

        parent::print_page_content();
    }
}