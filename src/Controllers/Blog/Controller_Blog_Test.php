<?php


namespace Src\Controllers\Blog;


use JointApp\Controllers\Controller;
use Src\Views\Blog\It\AlvasarCode;

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

    public function alvasarCode()
    {

        $err = false;
        $code = '---';

        if(isset($this->requestParams['fio'])){
            $fio = $this->requestParams['fio'];
        }else{
            $err = true;
        }

        if(isset($this->requestParams['birthday'])){
            $birthday = $this->requestParams['birthday'];
            $birthday_date = new \DateTime($birthday);
            $birthday_trim = date_format($birthday_date, 'd.m.Y');
            $birthday_trim = str_replace('.', '', $birthday_trim);
        }else{
            $err = true;
        }

        if(!$err){
            $code = @AlvasarCode::calcCode($birthday_trim, $fio);
        }

        $this->view->responseJson = array('resultCode' => $code);
    }
}