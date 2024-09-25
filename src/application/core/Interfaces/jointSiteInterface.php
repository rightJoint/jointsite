<?php
interface jointSiteInterface
{
    public function js_Run($JOINT_SITE_EXEC_DIR = null, $DOCUMENT_ROOT = null, $REQUEST_URI = null);

    /*
        run site on /mirror

        $JOINT_SITE_EXEC_DIR = "/mirror",
        $_SERVER["DOCUMENT_ROOT"] = "",
        $_SERVER["REQUEST_URI"] = "/mirror/ru/test/phpmysqladmin/printquery?test=1111"

         * global request =
Array
(
    [routes_uri] => /mirror/ru/test/phpmysqladmin/printquery?test=1111      uri with get request, its $_SERVER["REQUEST_URI"]
    [routes_path] => /mirror/ru/test/phpmysqladmin/printquery               no get request in $_SERVER[REQUEST_URI]
    [routes] => Array
        (
            [0] =>                                                          always zero
            [1] => mirror
            [2] => test
            [3] => phpmysqladmin
            [4] => printquery
        )

    [exec_dir] => Array
        (
            [0] =>
            [1] => mirror
        )

    [routes_cnt] => 5                                                       count(routes)
    [exec_path] => /mirror                                                  its $JOINT_SITE_EXEC_DIR = /mirror
    [exec_dir_cnt] => 2                                                     CASE: 1 in root, 2 on mirror
    [diff_cnt] => 4
)
        define constants:
        JOINT_SITE_EXEC_DIR                                                 $JOINT_SITE_EXEC_DIR = /mirror
        JOINT_SITE_REQUIRE_DIR                                              its $_SERVER["DOCUMENT_ROOT"]
        JOINT_SITE_REQ_LANG                                                 shortcut for lang_file C:/OSPanel/domains/rj-test.local/mirror/application/lang_files/ru
        JOINT_SITE_APP_LANG                                                 ru or en
        JOINT_SITE_APP_REF                                                  null, /ru or /en
        JOINT_SITE_REQ_ROOT                                                 it routes_uri cut of lang uri to process logic
                                                                            /mirror/test/phpmysqladmin/printquery?test=1111

        JS_SAIK                                                             main or mirror

         */
    public function js_PrepareRequest($JOINT_SITE_EXEC_DIR = null, $DOCUMENT_ROOT = null, $REQUEST_URI = null);

    public function js_ExplodeRequest($JOINT_SITE_EXEC_DIR = null, $DOCUMENT_ROOT = null, $REQUEST_URI = null);

    public function js_LangReq($acceptable_lang = array("en", "ru", ));

    public function js_session_key();

    public function load_app_lang();

    public function js_config_dir();

    public function js_app_exec():bool;

    public function set_app_config();

    public function loadControllerFromRequest():string;

    public function load_instance($instance_type):string;

    public function checkAppControllerSettings($controller_name, $default_name="Controller"):bool;

    public function loadModelFromRequest():string;

    public function checkAppModelSettings($model_name, $default_model="Model_pdo"):bool;

    public function loadViewFromRequest():string;

    public function checkAppViewSettings($view_name, $default_name="SiteView"):bool;

    public function getActionFromRequest():string;

    public function js_ExecAction($loaded_controller, $loaded_model, $loaded_view, $action_name):bool;

    public function js_HandleResult(bool $result);

    public static function throwErr($errType, $message):bool;

    public function js_display_err($errType, $message);
}