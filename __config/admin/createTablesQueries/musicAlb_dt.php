<?php
$query_text="(".
    "album_id varchar(36) not null, ".
    "albumName varchar(128) collate utf8_unicode_ci not null, ".
    "albumAlias varchar(128) collate utf8_unicode_ci not null, ".
    "metaDescr TEXT collate utf8_unicode_ci, ".
    "dateOfCr date not null, ".
    "albumImg varchar(128) collate utf8_unicode_ci, ".
    "activeFlag BOOLEAN, ".
    "refreshDate date, ".
    "robIndex BOOLEAN, ".
    "primary key (album_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";