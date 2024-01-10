<?php
$query_text="(".
    "template_id varchar(36) not null, ".
    "tName varchar(36) not null, ".
    "tHeader_en text collate utf8_unicode_ci, ".
    "tHeader_rus text collate utf8_unicode_ci, ".
    "tBody_en text collate utf8_unicode_ci, ".
    "tBody_rus text collate utf8_unicode_ci, ".
    "date_created datetime, ".
    "created_by varchar(36) not null, ".
    "primary key (template_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";