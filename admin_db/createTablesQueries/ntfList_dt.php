<?php
$query_text="(".
    "ntf_id varchar(36) not null, ".
    "template_id varchar(36) not null, ".
    "subscriber_type varchar(36) not null, ".//group_id, user_id
    "type_id varchar(36) not null, ".
    "add_date datetime not null, ".
    "template_params text collate utf8_unicode_ci, ".
    "send_params text collate utf8_unicode_ci, ".
    "send_date datetime, ". //try send
    "created_by varchar(36), ".
    "send_res BOOLEAN, ".
    "send_log varchar(128), ".
    "primary key (ntf_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";