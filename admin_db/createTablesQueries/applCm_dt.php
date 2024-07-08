<?php
$query_text="(".
    "applCm_id varchar(36) not null, ".
    "appl_id varchar(36) not null, ".
    "dateEntered datetime not null, ".
    "attach TEXT collate utf8_unicode_ci, ".
    "content varchar(128) collate utf8_unicode_ci, ".
    "user_id varchar(36), ".
    "primary key (applCm_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";