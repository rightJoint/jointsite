<?php


namespace Src\Views\Test;


use JointApp\Views\SiteView;

class View_Test_Files extends SiteView
{
    public static function createPageContent(\stdClass $langPageContent, \stdClass $viewParams): string
    {
        return '<form method="post" enctype="multipart/form-data">'.
            '<h2>files-form</h2>'.
            '<input type="text" name="test-txt" value="testText">'.
            '<input type="file" name="photo[]" multiple>'.
            '<input type="submit" value="Submit">'.
            '</form>';
    }
}