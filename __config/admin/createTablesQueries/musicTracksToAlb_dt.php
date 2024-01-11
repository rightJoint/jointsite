<?php
$query_text="(".
    "track_id varchar(36) not null, ".
    "album_id varchar(36) not null, ".
    "comment TEXT collate utf8_unicode_ci not null, ".
    "sortDate date, ".
    "mActive BOOLEAN, ".
    "primary key (track_id, album_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";