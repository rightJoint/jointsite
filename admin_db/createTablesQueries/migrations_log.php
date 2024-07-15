<?php
$query_text="(".
    "migration_log_id varchar(36) not null, ".
    "migration_name varchar(256) not null, ".
    "add_date datetime not null, ".
    "migration_log TEXT, ".
    "primary key (migration_log_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";