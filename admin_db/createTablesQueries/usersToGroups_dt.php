<?php
$query_text="(".
    "group_id varchar(36) not null, ".
    "user_id varchar(36) not null, ".
    "read_rule varchar(36) not null, ".
    "create_rule varchar(36) not null, ".
    "edit_rule varchar(36) not null, ".
    "delete_rule varchar(36) not null, ".
    "created_by varchar(36) not null, ".
    "send_ntf BOOLEAN, ".
    "primary key (group_id, user_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";