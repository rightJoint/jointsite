<?php


namespace Src\Controllers\Blog;


use JointApp\Controllers\Controller;

class Controller_Blog_Test extends Controller
{
    public function parseBrackets()
    {
        $testString = '';
        if(isset($this->requestParams['testString'])){
            $testString = $this->requestParams['testString'];
        }
        $brSigns = $this->view::getBracketsSigns();
        foreach ($brSigns as $brNum => $br){
            if(!(isset($this->requestParams[$brNum]) and $this->requestParams[$brNum] == 'on')){
                unset($brSigns[$brNum]);
            }
        }

        $checkResult = $this->view::checkBrackets($testString, $brSigns);


        $this->view->responseJson = array('checkResult' => $checkResult);
    }
}