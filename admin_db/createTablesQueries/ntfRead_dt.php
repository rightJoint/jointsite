<?php
$query_text="(".
    "ntf_id varchar(36) not null, ".
    "user_id varchar(36) not null, ".//group, personal
    "read_date datetime, ".
    "put_date datetime, ".
    "send_flag BOOLEAN, ".
    "del_flag BOOLEAN, ".
    "primary key (ntf_id, user_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";