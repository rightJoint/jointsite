<?php
$query_text="(".
    "track_id varchar(36) not null, ".
    "track_name varchar(128) collate utf8_unicode_ci not null, ".
    "track_artist varchar(128) collate utf8_unicode_ci not null, ".
    "track_file varchar(128) collate utf8_unicode_ci, ".
    "loadDate date not null, ".
    "sortDate date, ".
    "primary key (track_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";