<?php


namespace Src\RoutesCollection;

use JointApp\Router\JointSiteRoute;
use Src\RoutesCollection\Modules\RoutesCollection_Modules_BlogArts;
use Src\RoutesCollection\Modules\RoutesCollection_Modules_BlogCats;
use Src\RoutesCollection\Modules\RoutesCollection_Modules_BlogTags;
use Src\RoutesCollection\Modules\RoutesCollection_Modules_BlogTagsToArts;
use Src\RoutesCollection\Modules\RoutesCollection_Modules_MusicAlb;
use Src\RoutesCollection\Modules\RoutesCollection_Modules_MusicTracksToAlb;
use Src\RoutesCollection\Modules\RoutesCollection_Modules_MusicTracks;
use Src\RoutesCollection\Modules\RoutesCollection_Modules_NtfRead;
use Src\RoutesCollection\Modules\RoutesCollection_Modules_Services;
use Src\RoutesCollection\Modules\RoutesCollection_Modules_Sitemap;
use Src\RoutesCollection\Modules\RoutesCollection_Modules_SitemapUpdate;
use Src\RoutesCollection\Modules\RoutesCollection_Modules_User;
use Src\RoutesCollection\Modules\RoutesCollection_Modules_Groups;
use Src\RoutesCollection\Modules\RoutesCollection_Modules_UsersToGroups;
use Src\RoutesCollection\Modules\RoutesCollection_Modules_NtfTemplates;
use Src\RoutesCollection\Modules\RoutesCollection_Modules_NtfList;

trait RoutesCollection_Siteman
{

    use RoutesCollection_Modules_User;
    use RoutesCollection_Modules_MusicAlb;
    use RoutesCollection_Modules_MusicTracksToAlb;
    use RoutesCollection_Modules_MusicTracks;
    use RoutesCollection_Modules_Groups;
    use RoutesCollection_Modules_UsersToGroups;
    use RoutesCollection_Modules_NtfTemplates;
    use RoutesCollection_Modules_NtfList;
    use RoutesCollection_Modules_NtfRead;
    use RoutesCollection_Modules_Services;
    use RoutesCollection_Modules_BlogArts;
    use RoutesCollection_Modules_BlogTags;
    use RoutesCollection_Modules_BlogTagsToArts;
    use RoutesCollection_Modules_BlogCats;
    use RoutesCollection_Modules_Sitemap;
    use RoutesCollection_Modules_SitemapUpdate;

    static function getRoute_Siteman($routes_ns):JointSiteRoute
    {
        $route = new JointSiteRoute();
        if(!isset($routes_ns[2])){
            $route
                ->withController("JointApp\Controllers\ModulesListController")
                ->withAction("actionIndex")
                ->withModel("JointApp\Models\Model")
                ->withView("JointApp\Views\Modules\ModulesListView");
        }elseif (strtolower($routes_ns[2]) == 'users'){
            $route = self::getRoute_ModuleUsers($routes_ns);
        }
        elseif (strtolower($routes_ns[2]) == 'musicalb'){
            $route = self::getRoute_ModuleMusicAlb($routes_ns);
        }
        elseif (strtolower($routes_ns[2]) == 'musictrackstoalb'){
            $route = self::getRoute_ModuleMusicTracksToAlb($routes_ns);
        }
        elseif (strtolower($routes_ns[2]) == 'musictracks'){
            $route = self::getRoute_ModuleMusicTracks($routes_ns);
        }
        elseif (strtolower($routes_ns[2]) == 'groups'){
            $route = self::getRoute_ModuleGroups($routes_ns);
        }
        elseif (strtolower($routes_ns[2]) == 'userstogroups'){
            $route = self::getRoute_ModuleUsersToGroups($routes_ns);
        }
        elseif (strtolower($routes_ns[2]) == 'ntftemplates'){
            $route = self::getRoute_ModuleNtfTemplates($routes_ns);
        }
        elseif (strtolower($routes_ns[2]) == 'ntftemplates'){
            $route = self::getRoute_ModuleNtfTemplates($routes_ns);
        }
        elseif (strtolower($routes_ns[2]) == 'ntflist'){
            $route = self::getRoute_ModuleNtfList($routes_ns);
        }
        elseif (strtolower($routes_ns[2]) == 'ntfread'){
            $route = self::getRoute_ModuleNtfRead($routes_ns);
        }
        elseif (strtolower($routes_ns[2]) == 'services'){
            $route = self::getRoute_ModuleServices($routes_ns);
        }
        elseif (strtolower($routes_ns[2]) == 'blogarts'){
            $route = self::getRoute_ModuleBlogArts($routes_ns);
        }
        elseif (strtolower($routes_ns[2]) == 'blogtags'){
            $route = self::getRoute_ModuleBlogTags($routes_ns);
        }
        elseif (strtolower($routes_ns[2]) == 'blogtagstoarts') {
            $route = self::getRoute_ModuleBlogTagsToArts($routes_ns);
        }
        elseif (strtolower($routes_ns[2]) == 'blogcats') {
            $route = self::getRoute_ModuleBlogCats($routes_ns);
        }
        elseif (strtolower($routes_ns[2]) == 'sitemap'){
            $route = self::getRoute_ModuleSitemap($routes_ns);
        }
        elseif (strtolower($routes_ns[2]) == 'sitemapupdate'){
            $route = self::getRoute_ModuleSitemapUpdate($routes_ns);
        }
        return $route;
    }
    static function postRoute_Siteman($routes_ns):JointSiteRoute
    {
        $route = new JointSiteRoute();
        if (strtolower($routes_ns[2]) == 'users') {
            $route = self::postRoute_ModuleUsers($routes_ns);
        }
        elseif (strtolower($routes_ns[2]) == 'musicalb') {
            $route = self::postRoute_ModuleMusicAlb($routes_ns);
        }
        elseif (strtolower($routes_ns[2]) == 'musictrackstoalb') {
            $route = self::postRoute_ModuleMusicTracksToAlb($routes_ns);
        }
        elseif (strtolower($routes_ns[2]) == 'musictracks') {
            $route = self::postRoute_ModuleMusicTracks($routes_ns);
        }
        elseif (strtolower($routes_ns[2]) == 'groups'){
            $route = self::postRoute_ModuleGroups($routes_ns);
        }
        elseif (strtolower($routes_ns[2]) == 'groups'){
            $route = self::postRoute_ModuleUsersToGroups($routes_ns);
        }
        elseif (strtolower($routes_ns[2]) == 'userstogroups'){
            $route = self::postRoute_ModuleUsersToGroups($routes_ns);
        }
        elseif (strtolower($routes_ns[2]) == 'ntftemplates'){
            $route = self::postRoute_ModuleNtfTemplates($routes_ns);
        }
        elseif (strtolower($routes_ns[2]) == 'ntflist'){
            $route = self::postRoute_ModuleNtfList($routes_ns);
        }
        elseif (strtolower($routes_ns[2]) == 'ntfread'){
            $route = self::postRoute_ModuleNtfRead($routes_ns);
        }
        elseif (strtolower($routes_ns[2]) == 'services'){
            $route = self::postRoute_ModuleServices($routes_ns);
        }
        elseif (strtolower($routes_ns[2]) == 'blogarts'){
            $route = self::postRoute_ModuleBlogArts($routes_ns);
        }
        elseif (strtolower($routes_ns[2]) == 'blogtags'){
            $route = self::postRoute_ModuleBlogTags($routes_ns);
        }
        elseif (strtolower($routes_ns[2]) == 'blogtagstoarts') {
            $route = self::postRoute_ModuleBlogTagsToArts($routes_ns);
        }
        elseif (strtolower($routes_ns[2]) == 'blogcats') {
            $route = self::postRoute_ModuleBlogCats($routes_ns);
        }
        elseif (strtolower($routes_ns[2]) == 'sitemap'){
            $route = self::postRoute_ModuleSitemap($routes_ns);
        }
        return $route;
    }
/*
    static function getRoute_SitemanMusic($routes_ns):JointSiteRoute
    {
        $route = new JointSiteRoute();
        if(!isset($routes_ns[3])){
            $route
                ->withController("JointApp\Controllers\Components\Controller_Component_Music")
                ->withAction("actionModuleStat")
                ->withModel("JointApp\Models\Model")
                ->withView("JointApp\Views\Module\ModuleStatView");
        }
        return $route;
    }
*/
}