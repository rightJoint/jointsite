<?php


namespace JointApp\Interfaces;


use JointApp\JointAppRequest;

interface ViewInterface
{
    /*
     * return viewBody html page text format
     */
    function getResponseText():string;

    /*
     * return viewData json format
     */
    function getResponseJson():array;
}