<?php
namespace JointSite\Core\Interfaces;
interface JointSiteInterface
{
    public function js_Run();

    /*
        $_SERVER["DOCUMENT_ROOT"] = "",
        $_SERVER["REQUEST_URI"] = "/mirror/ru/test/phpmysqladmin/printquery?test=1111"

         * global request =
Array
(
    [routes_uri] => /ru/test/phpmysqladmin/printquery?test=1111      uri with get request, its $_SERVER["REQUEST_URI"]
    [routes_path] => /ru/test/phpmysqladmin/printquery               no get request in $_SERVER[REQUEST_URI]
    [routes] => Array
        (
            [0] =>                                                          always zero
            [1] => test
            [2] => phpmysqladmin
            [3] => printquery
        )

    [routes_cnt] => 4                                                       count(routes)
)
        define constants:
        JOINT_SITE_REQUIRE_DIR                                              its $_SERVER["DOCUMENT_ROOT"]
        JOINT_SITE_REQ_LANG                                                 shortcut for lang_file C:/OSPanel/domains/rj-test.local/mirror/application/lang_files/ru
        JOINT_SITE_APP_LANG                                                 ru or en
        JOINT_SITE_APP_REF                                                  null, /ru or /en
        JOINT_SITE_REQ_ROOT                                                 it routes_uri cut of lang uri to process logic
                                                                            /test/phpmysqladmin/printquery?test=1111

         */
    public function js_PrepareRequest();

    public function js_get_env();

    public function js_HandleResult(bool $result);

    public static function throwErr($errType, $message):bool;

    public function js_display_err($errType, $message);
}