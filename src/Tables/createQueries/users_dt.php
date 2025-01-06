<?php
$query_text="(".
    "user_id varchar(36) not null, ".
    "accLogin varchar(128) collate utf8_unicode_ci not null, ".
    "accAlias varchar(128) collate utf8_unicode_ci not null, ".
    "pw_hash varchar(256) collate utf8_unicode_ci, ".
    "vldCode varchar(128) collate utf8_unicode_ci, ".
    "regDate datetime not null, ".
    "netWork varchar(16) collate utf8_unicode_ci not null, ".
    "validDate datetime, ".
    "photoLink varchar(512) collate utf8_unicode_ci, ".
    "eMail varchar(128) collate utf8_unicode_ci, ".
    "birthDay date, ".
    "socProf varchar(512) collate utf8_unicode_ci, ".
    "blackList BOOLEAN not null, ".
    "created_by varchar(36) not null, ".
    "is_admin BOOLEAN, ".
    "send_ntf BOOLEAN, ".
    "pref_lang varchar(16) not null, ".
    "primary key (user_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";