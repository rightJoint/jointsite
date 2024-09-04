create table srvCards_dt (
    card_id int(5) AUTO_INCREMENT,
    cardName_rus varchar(128) collate utf8_unicode_ci not null,
    cardName_en varchar(128) collate utf8_unicode_ci,
    cardAlias varchar(128) collate utf8_unicode_ci not null,
    shortDescr_rus TEXT collate utf8_unicode_ci,
    shortDescr_en TEXT collate utf8_unicode_ci,
    longDescr_rus TEXT collate utf8_unicode_ci,
    longDescr_en TEXT collate utf8_unicode_ci,
    cardImg varchar(128) collate utf8_unicode_ci,
    cardActive BOOLEAN, 
    cardPrice_rus int(5) not null,
    cardPrice_en int(5) not null,
    cardCurr_rus varchar(16),
    cardCurr_en varchar(16),
    sortDate date not null,
    unit_rus varchar(8) collate utf8_unicode_ci,
    unit_en varchar(8) collate utf8_unicode_ci,
    created_by varchar(36) not null collate utf8_unicode_ci,
    primary key (card_id)
    ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;