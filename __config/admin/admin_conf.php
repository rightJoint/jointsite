<?php
define("PATH_TO_USR_LIST", "/".JOINT_CONF_DIR."/admin/adminUsers.txt");
define("PATH_TO_TABLES_LIST", "/".JOINT_CONF_DIR."/admin/createTablesQueries/");    // where look up create query files
define("PATH_TO_DB_UPLOAD", UPLOAD_DIR_DEFAULT."/db/");                           // where from download/upload tables content
define("TABLE_EXT_FILE", ".php");                              // create and download/upload files extension
define("LOWER_CASE_TABLE_NAMES", true);                              // use true on windows or false on linux