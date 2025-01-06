<?php


namespace JointApp\Interfaces;

use JointApp\JointAppRequest;

interface WebViewInterface extends ViewInterface
{
    /*
    * return className controller->lang_map
     * to message multi language texts
    */
    public static function loadLangView(string $docRoot = __DIR__, string $viewLang = 'ru', $loads = []):LangWebViewInterface;

    public static function langNs(string $viewLang = 'ru'):string;

    /*
     * pass array to update properties that $langMap::getLangHead() return
     */
    public function langHeadUpdate(callable $updateFromArray):void;

    /*
* addMetaLinks to head of page
*/
    public static function addMetaLinks():array;

    /*
* addMetaLinks to add style links
*/
    public static function addStyleLinks(callable $addStyleLinks):void;

    /*
* addMetaLinks to add java script
*/
    public static function addScriptLinks(callable $addScriptLinks):void;

    /*
 * pass array to update properties that $langMap::langHeader() return
 */
    public function langHeaderUpdate(callable $updateFromArray);



    public function addViewParams(callable $addViewParams);

    /*
 * print content of html-page
 */
    public static function createPageContent(\stdClass $langPageContent, \stdClass $viewParams):string;


    public function putPageContentBefore(string $beforeText):void;

    public function putPageContentAfter(string $afterText):void;



    /*
* addMetaLinks to add java script
*/
    public static function createModalContent(\stdClass $langModal, \stdClass $viewParams):string;



    public static function printMenuItems(array $itemsList, $disp_url = null):array;
}