<?php

namespace JointFramework\Logger;

use Psr\Log\AbstractLogger;
use Psr\Log\LogLevel;


class JointSiteLogger extends AbstractLogger
{
    public $logger_context;

    private int $startTime = 0;
    private int $endTime = 0;
    private int $runTime = 0;

    public function withContext(array $logger_context):self
    {
        $new = clone $this;
        $new->logger_context = $logger_context;

        return $new;

    }

    /**
     * @var HandlerInterface
     */

    public function log($level, string|\Stringable $message, array $context = array()):void
    {
        global $jointAppResponse;

        $levelToCode = function ($level) {
            $responseCodes = array(
                LogLevel::ERROR => 404,
                LogLevel::DEBUG =>  200,
                LogLevel::WARNING => 403,
                LogLevel::CRITICAL =>503,
                LogLevel::ALERT => 400,
                LogLevel::EMERGENCY => 400,
                LogLevel::NOTICE =>  200,
                LogLevel::INFO =>  200);
            return $responseCodes[$level];
        };

        if($levelToCode($level) != 200){
            $jointAppResponse = $jointAppResponse->withStatus($levelToCode($level), self::interpolate($message, $context));
        }

        $this->customLog($level, $message, $context, $levelToCode);
    }

    protected static function interpolate(string $message, array $context = []): string
    {
        $replace = [];
        foreach ($context as $key => $val) {
            if (is_string($val) || method_exists($val, '__toString')) {
                $replace['{' . $key . '}'] = $val;
            }
        }
        return strtr($message, $replace);
    }

    //list of redirects if need redirect
    //for example when add (newView)
    //or delete (deleteView) record, then redirect to listView
    public function redirect($location)
    {
        global $jointAppResponse;
        $jointAppResponse->redirect($location);
    }

    public function logStartTime($context = null):int
    {
        global $jointAppResponse;
        if(empty($context)){
            $logContext = key($this->logger_context);;
        }else{
            $logContext = $context;
        }

        $jointAppResponse->stopwatch[] = [$logContext => ['start' => microtime(true)]];
        return count($jointAppResponse->stopwatch);

        return 0;
    }

    public function logEndTime($context = null):int
    {
        global $jointAppResponse;

        if(empty($context)){
            $logContext = key($this->logger_context);;
        }else{
            $logContext = $context;
        }

        $jointAppResponse->stopwatch[] = [$logContext => ['end' => microtime(true)]];
        return count($jointAppResponse->stopwatch);

        return 0;
    }

    public function calcRunTime(int $firstEvent = 0, int $lastEvent = 0):float
    {
        global $jointAppResponse;

        if(isset($jointAppResponse->stopwatch)){
            if($lastEvent == 0){
                if(count($jointAppResponse->stopwatch)){
                    $lastEvent = count($jointAppResponse->stopwatch) - 1;
                }
            }

            $keyStart = key($jointAppResponse->stopwatch[$firstEvent]);
            $keyEnd = key($jointAppResponse->stopwatch[$lastEvent]);

            return $jointAppResponse->stopwatch[$lastEvent][$keyEnd]['end'] - $jointAppResponse->stopwatch[$firstEvent][$keyStart]['start'];
        }
        return 0;
    }

    public function getRunTime():float
    {
        return $this->runTime;
    }

    //extended log cause save $context fields
    //used in views do display included 200 status codes: DEBUG, NOTICE, INFO
    public function customLog(string $level, string $message, array $context, callable $levelToCode):void
    {
        global $jointAppResponse;
        foreach ($context as $key => $val){
            if(is_array($val)){
                $jointAppResponse->customLog[][$level] = '['.$levelToCode($level).'], thrown in '.$key.' with message "'.$message.'"'.
                    ' reason not available '.
                    'in JointAppResponse->customLog cause its array';
            }else{
                $jointAppResponse->customLog[][$level] = '['.$levelToCode($level).'], thrown in '.$key.': '.$val.
                    ' with message "'.$message.'"';
            }
        }

    }
}