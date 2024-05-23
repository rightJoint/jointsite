<?php
$query_text="(".
    "migration_name varchar(256) not null, ".
    "status varchar(32) not null, ".
    "try_date datetime, ".
    "add_date datetime, ".
    "migr_file tinyint, ".
    "primary key (migration_name)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";