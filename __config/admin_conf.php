<?php
define("PATH_TO_USR_LIST", JOINT_SITE_CONF_DIR."/admin/adminUsers.txt");
define("PATH_TO_TABLES_LIST", $_SERVER["DOCUMENT_ROOT"].
    JOINT_SITE_EXEC_DIR."/admin_db/createQueries");    // where look up create query files
define("PATH_TO_DB_UPLOAD", $_SERVER["DOCUMENT_ROOT"].
    JOINT_SITE_EXEC_DIR."/admin_db/upload");                           // where from download/upload tables content
define("TABLE_EXT_FILE", ".php");                              // create and download/upload files extension
define("LOWER_CASE_TABLE_NAMES", true);                              // use true on windows or false on linux
define("PATH_TO_MIGRATIONS", $_SERVER["DOCUMENT_ROOT"].
    JOINT_SITE_EXEC_DIR."/migrations");                           // where stored migrations sql files