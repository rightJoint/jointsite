<?php
require_once "application/core/Module/ModuleMenu.php";
require_once "application/core/Module/ModuleListView.php";
class sitemanListView extends ModuleListView
{
    function print_page_content()
    {
        echo moduleMenu::print_module_menu($this->module);
        parent::print_page_content();
    }
}