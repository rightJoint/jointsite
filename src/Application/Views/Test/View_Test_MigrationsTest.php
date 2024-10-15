<?php

namespace JointSite\Views\Test;

use JointSite\Views\SiteView;

class View_Test_MigrationsTest extends SiteView
{
    function printPageContent()
    {
        parent::printPageContent();
        echo "<div class='contentBlock-frame'><div class='contentBlock-center'>".
            "<div class='contentBlock-wrap'>".
            "<div class='test-menu' style='text-align: left'>".
            "<h2>Tests migrations list</h2>".
            "<ul>".
            "<li><a href='".JOINT_SITE_SL_LANG."/test/migrationstest/checkConnectServerStatus'>checkConnectServerStatus</a></li>".
            "<li><a href='".JOINT_SITE_SL_LANG."/test/migrationstest/createMigrationsTables'>createMigrationsTables</a></li>".
            "<li><a href='".JOINT_SITE_SL_LANG."/test/migrationstest/execNewMigrations'>execNewMigrations</a></li>".
            "<li><a href='".JOINT_SITE_SL_LANG."/test/migrationstest/migrationsList'>migrationsList</a></li>".
            "<li><a href='".JOINT_SITE_SL_LANG."/test/migrationstest/migrationsLog'>migrationsLog</a></li>".
            "</ul>".
            "</div>".
            "</div></div></div>";
    }
}