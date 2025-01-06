<?php


namespace JointApp;


use JointApp\Interfaces\ResponseAdapterInterface;
use JointFramework\Http\Response;
use Psr\Log\LogLevel;

class JointAppResponse extends Response
{

    //log err included 200 status codes: DEBUG, NOTICE, INFO
    public $customLog = [];

    //store run time of JointApp, Action, View
    public $stopwatch = [];

    //defined in JointSiteRoute RoutesCollection traits
    //text format, or json
    public $responseFormat = 'text';

    //used view text response
    public string $responseText = '';
    //used view json response
    public $responseJson = [];

    //list of redirects if need redirect
    //for example when add (newView)
    //or delete (deleteView) record, then redirect to listView
    public $redirect = [];

    //list of redirects if need redirect
    //for example when add (newView)
    //or delete (deleteView) record, then redirect to listView
    public function redirect(string $location):void
    {
        $this->redirect[] = $location;
    }
}