<?php
$query_text="(".
    "group_id varchar(36) not null, ".
    "groupAlias_en varchar(128) not null, ".
    "groupAlias_rus varchar(128) not null, ".
    "activeFlag BOOLEAN not null, ".
    "created_by varchar(36) not null, ".
    "primary key (group_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";