<?php


namespace JointApp\Views\Modules;


class ModuleSubMenu
{
    public static function bindModuleMenu($bindComponents = [], $userModules = [], $modulesMenu = [], $moduleName = ''):string
    {
        $return = '<div class="contentBlock-frame"><div class="contentBlock-center">'.
            '<div class="contentBlock-wrap"><div class="module-menu"><ul>';
        $return .= '<li>'.
            '<a href="/siteman/'.$moduleName.'" title="'.$modulesMenu->menuItems[$moduleName]['refTitle'].'">'.
            $modulesMenu->menuItems[$moduleName]['refText'].
            '</a>'.
            '</li>';
        foreach ($bindComponents as $cN => $cOpt){
            $return.= '<li>'.
                '<a href="/siteman/'.$cN.'" title="'.$modulesMenu->menuItems[$cN]['refTitle'].'">'.
                $modulesMenu->menuItems[$cN]['refText'].
                '</a>'.
                '</li>';
        }

        $return.='</ul></div></div></div></div>';
        return $return;
    }
}