<?php
namespace JointSite\Core\Interfaces;
interface JointSiteInterface
{
    public function jsRun();

    /*
     * Example:
     *
     * app folder (DOCUMENT_ROOT) is /scr
     *
     * input parameters:
     *
     * $_SERVER["REQUEST_URI"] = "/en/test/migrationstest/migrationsList?xxx=yyy"
     * $_SERVER["DOCUMENT_ROOT"] = "C:/OSPanel/domains/rj-test.local/src"
     *
     * Request parameters:
     *
     * global
     * $routes = Array(
     * "routes_uri" => "/en/test/migrationstest/migrationsList?xxx=yyy",
     * "routes_path" => "/en/test/migrationstest/migrationsList",
     * "routes" = Array(
     * [0] => null,
     * [1] => "en",
     * [2] => "test",
     * [3] => "migrationstest",
     * [4] => "migrationsList",
     * ),
     * "routes_ns" = Array(
     * [0] => null,
     * [1] => "test",
     * [2] => "migrationstest",
     * [3] => "migrationsList",
     * ),
     * )
     *
     * routes_ns used to process logic
     *
     * Constants:
     *
     * where stored users data like files
     * JOINT_SITE_USERS_DIR = "/userdata"
     *
     * where from load config (connect to database etc)
     * JOINT_SITE_CONF_DIR = "C:/OSPanel/domains/rj-test.local/src/__config"
     *
     * base $_SERVER["DOCUMENT_ROOT"] for different meanings
     * JOINT_SITE_ROOT_DIR = "C:/OSPanel/domains/rj-test.local/src"
     *
     * lang const:
     *
     * shortcut to lang_files
     * JOINT_SITE_REQ_LANG = "C:/OSPanel/domains/rj-test.local/src/Application/LangFiles/En"
     *
     * wildcard for namespaces
     * JOINT_SITE_NS_LANG = "En"
     *
     * wildcard for lang_arrays
     * JOINT_SITE_LW_LANG = "en"
     *
     * wildcard for hrefs contains slash
     * JOINT_SITE_SL_LANG = "/en"
     *
     * wildcard for hrefs parts after lang
     * JOINT_SITE_LP_LANG = "/test/migrationstest/migrationsList?xxx=yyy"
     */
    public function jsPrepareRequest();

    public function jsGetEnv();

    public function jsHandleResult(bool $result);
}