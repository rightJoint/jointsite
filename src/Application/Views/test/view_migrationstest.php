<?php
use JointSite\Views\SiteView;

class view_migrationstest extends SiteView
{
    function print_page_content()
    {
        parent::print_page_content();
        echo "<div class='contentBlock-frame'><div class='contentBlock-center'>".
            "<div class='contentBlock-wrap'>".
            "<div class='test-menu' style='text-align: left'>".
            "<h2>Tests migrations list</h2>".
            "<ul>".
            "<li><a href='".JOINT_SITE_APP_REF."/test/migrationstest/checkConnectServerStatus'>checkConnectServerStatus</a></li>".
            "<li><a href='".JOINT_SITE_APP_REF."/test/migrationstest/createMigrationsTables'>createMigrationsTables</a></li>".
            "<li><a href='".JOINT_SITE_APP_REF."/test/migrationstest/execNewMigrations'>execNewMigrations</a></li>".
            "<li><a href='".JOINT_SITE_APP_REF."/test/migrationstest/migrationsList'>migrationsList</a></li>".
            "<li><a href='".JOINT_SITE_APP_REF."/test/migrationstest/migrationsLog'>migrationsLog</a></li>".
            "</ul>".
            "</div>".
            "</div></div></div>";
    }
}