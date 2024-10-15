<?php

namespace JointSite\Core\Logger;

use JointSite\Psr\Log\LoggerInterface;
use JointSite\Psr\Log\LogLevel;



class JointSiteLogger implements LoggerInterface
{
    /*
    public function setLogger(LoggerInterface $logger)
    {

    }*/
    /**
     * System is unusable.
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    public function emergency($message, array $context = array())
    {
        global $js_result;
        $js_result["error"] = true;
        $js_result["errType"] = LogLevel::EMERGENCY;
        $js_result["message"][] = array(LogLevel::EMERGENCY => $message);
        return false;
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
        global $js_result;
        $js_result["error"] = true;
        $js_result["errType"] = LogLevel::ALERT;
        $js_result["message"][] = array(LogLevel::ALERT => $message);
        return false;
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
        global $js_result;
        $js_result["error"] = true;
        $js_result["errType"] = LogLevel::CRITICAL;
        $js_result["message"][] = array(LogLevel::CRITICAL => $message);
        return false;
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
        global $js_result;
        $js_result["error"] = true;
        $js_result["errType"] = LogLevel::ERROR;
        $js_result["message"][] = array(LogLevel::ERROR => $message);
        return false;
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
        global $js_result;
        $js_result["error"] = true;
        $js_result["errType"] = LogLevel::WARNING;
        $js_result["message"][] = array(LogLevel::WARNING => $message);
        return false;
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
        global $js_result;
        $js_result["error"] = true;
        $js_result["errType"] = LogLevel::NOTICE;
        $js_result["message"][] = array(LogLevel::NOTICE => $message);
        return false;
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
        global $js_result;
        $js_result["error"] = true;
        $js_result["errType"] = LogLevel::INFO;
        $js_result["message"][] = array(LogLevel::INFO => $message);
        return false;
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
        global $js_result;
        $js_result["error"] = true;
        $js_result["errType"] = LogLevel::DEBUG;
        $js_result["message"][] = array(LogLevel::DEBUG => $message);
        return false;
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

    }

    static function displayErr($errType, $message)
    {
        if(isset($_GET["errType"])){
            $errType = $_GET["errType"];
            if(isset($_GET["message"])){
                $message = $_GET["message"];
            }
        }

        $view = new JointSiteLoggerView();
        $model = new JointSiteLoggerModel();

        $view->lang_map->head["h1"] = $model->lang_map->stack_err[$errType]["h1"];
        $view->lang_map->head["title"] = $model->lang_map->stack_err[$errType]["title"];
        $view->lang_map->head["description"] = $view->view_data =
            $model->lang_map->stack_err[$errType]["description"];
        $view->response_code = $model->response_codes[$errType];

        //view modal menu active to display sign in forms
        if($view->response_code == 403){
            $view->active_modal_menu = true;
        }

        $view->alert_message = $message;

        if($view->response_code != 200){
            http_response_code($view->response_code);
        }

        $view->generate();
    }
}