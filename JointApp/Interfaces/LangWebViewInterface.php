<?php


namespace JointApp\Interfaces;


interface LangWebViewInterface
{
    static public function getLangHead();

    static public function getLangHeader();

    static public function getLangPageContent();

    static public function getLangModal();
}