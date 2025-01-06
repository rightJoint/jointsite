<?php


namespace JointApp\Views\Migrations;


use JointApp\Views\View;

class Migrations_Top_Panel extends View
{
    public function listTopPanel():string
    {
        return '<div class="contentBlock-frame"><div class="contentBlock-center">'.
            '<div class="contentBlock-wrap">'.
            '<form class="migration-form" method="post" action="topPanelActions">'.
            '<div class="apply-line">'.
            '<input type="submit" class="exec" name="exec_all_migrations" value="exec-new-migrations">'.
            '<input type="submit" class="glob" name="glob_migr_files" value="glob-migr-files">'.
            '</div>'.
            '</form>'.
            '</div></div></div>'.
            '<link rel="stylesheet" href="/css/migrations/migrations.css" type="text/css" media="screen, projection"/>';
    }

    public function editTopPanel($sqlFileName):string
    {
        return '<div class="contentBlock-frame"><div class="contentBlock-center">'.
            '<div class="contentBlock-wrap">'.
            '<form class="migration-form" method="post" action="topPanelActions">'.
            '<div class="apply-line">'.
            '<input type="submit" class="exec" name="exec_migration" value="exec-migration">'.
            '<input type="hidden" name="exec_migr_file" value="'.$sqlFileName.'">'.
            '</div>'.
            '</form>'.
            '</div></div></div>'.
            '<link rel="stylesheet" href="/css/migrations/migrations.css" type="text/css" media="screen, projection"/>';
    }
}