<?php
$query_text="(".
    "appl_id varchar(36) not null, ".
    "clientName varchar(128) collate utf8_unicode_ci, ".
    "clientPhone varchar(128) collate utf8_unicode_ci, ".
    "clientMail varchar(128) collate utf8_unicode_ci, ".
    "clientSubject TEXT collate utf8_unicode_ci, ".
    "dateEntered datetime not null, ".
    "basket TEXT collate utf8_unicode_ci, ".
    "status varchar(16) not null, ".
    "payStatus varchar(16) not null, ".
    "invoiceSum int(5), ".
    "info varchar(128) collate utf8_unicode_ci, ".
    "user_id varchar(36), ".
    "primary key (appl_id)".
    ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";