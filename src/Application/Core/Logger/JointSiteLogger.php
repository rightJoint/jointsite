<?php

namespace JointSite\Core\Logger;

use JointSite\Psr\Log\LoggerInterface;
use JointSite\Psr\Log\LoggerAwareInterface;
use JointSite\Psr\Log\LogLevel;

use JointSite\Core\Logger\JointSiteLoggerController;
use JointSite\Core\Logger\JointSiteLoggerModel;
use JointSite\Core\Logger\JointSiteLoggerView;

class JointSiteLogger implements LoggerInterface, LoggerAwareInterface
{
    public function setLogger(LoggerInterface $logger)
    {

    }
    /**
     * System is unusable.
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    public function emergency($message, array $context = array())
    {
        echo "emergency";
        exit;
    }

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    public function alert($message, array $context = array())
    {
        echo "alert";
        exit;
    }

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    public function critical($message, array $context = array())
    {
        echo "critical";
        exit;
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    public function error($message, array $context = array())
    {
        echo "error";
        exit;
    }

    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    public function warning($message, array $context = array())
    {
        echo "warning";
        exit;
    }

    /**
     * Normal but significant events.
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    public function notice($message, array $context = array())
    {
        echo "notice";
        exit;
    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    public function info($message, array $context = array())
    {
        echo "info";
        exit;
    }

    /**
     * Detailed debug information.
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    public function debug($message, array $context = array())
    {
        echo "debug";
        exit;
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     * @return void
     */
    public function log($level, $message, array $context = array())
    {
        echo "log";
        exit;
    }


    static function throwErr($errType, $message):bool
    {
        global $js_result;
        $js_result["error"] = true;
        $js_result["errType"] = $errType;
        $js_result["message"][] = array($errType => $message);
        /*always return false*/
        return false;

    }

    static function displayErr($errType, $message)
    {
        //require_once (JOINT_SITE_REQUIRE_DIR."/application/core/controller.php");
        //require_once (JOINT_SITE_REQUIRE_DIR."/application/core/alerts/Alerts_controller.php");
        //require_once (JOINT_SITE_REQUIRE_DIR."/application/core/alerts/Alerts_model.php");
        //require_once (JOINT_SITE_REQUIRE_DIR."/application/core/View.php");
        //require_once (JOINT_SITE_REQUIRE_DIR."/application/views/SiteView.php");
        //require_once (JOINT_SITE_REQUIRE_DIR."/application/core/alerts/alerts_view.php");
        $controller = new JointSiteLoggerController();
        $controller->generateErr($errType, $message);
    }
}