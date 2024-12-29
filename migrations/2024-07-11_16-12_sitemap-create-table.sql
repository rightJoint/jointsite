create table siteMap_dt (
    maploc varchar(128) not null,
    lastmod date,
    changefreq varchar(36),
    priority tinyint,
    comment varchar(128),
    use_flag BOOLEAN,
    date_created datetime,
    created_by varchar(36) not null,
    primary key (maploc)
    ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;