<?php

namespace JointSite\Views;

use JointSite\Views\SiteView;

class View_Test extends SiteView
{
    function __construct()
    {
        parent::__construct();
        //$this->styles[] = JOINT_SITE_EXEC_DIR."/lib/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css";

        //$this->scripts[] = JOINT_SITE_EXEC_DIR."/lib/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js";
    }

    function printPageContent()
    {
        parent::printPageContent();
        echo "<div class='contentBlock-frame'><div class='contentBlock-center'>".
            "<div class='contentBlock-wrap'>".
            "<div class='test-menu' style='text-align: left'>".
            "<h2>Tests list</h2>".
            "<ul>".
            "<li><a href='".JOINT_SITE_SL_LANG."/test/records' title='test all tables'>Test Records - all tables</a></li>".
            "<ol>".
            "<li><a href='".JOINT_SITE_SL_LANG."/test/musicAlb' title='test custom rsf'>Test musicAlb - custom rsf</a></li>".
            "<li><a href='".JOINT_SITE_SL_LANG."/test/musicTracks' title='test custom rsf'>Test musicTracks - custom rsf</a></li>".
            "<li><a href='".JOINT_SITE_SL_LANG."/test/musicTracksToAlb' title='test custom rsf'>Test musicTracksToAlb - custom rsf</a></li>".
            "</ol>".
            "<li><a href='".JOINT_SITE_SL_LANG."/test/migrationstest'>Test Migrations</a></li>".
            "</ul>".
            "</div>".
        "</div></div></div>";
    }
}