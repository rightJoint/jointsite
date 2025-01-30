create table IF NOT EXISTS blogArts
(
    art_id varchar(36) not null,
    artCat varchar(36) not null,
    artRef varchar(256) not null,
    artName_en varchar(256) not null,
    artName_ru varchar(256) not null,
    artMeta_en text collate utf8_unicode_ci,
    artMeta_ru text collate utf8_unicode_ci, 
    artImg varchar(256), 
    activeFlag BOOLEAN, 
    indexFlag BOOLEAN, 
    pubDate date not null,
    refreshDate date,
    commentsFlag BOOLEAN, 
    popFlag BOOLEAN, 
    created_by varchar(36) not null, 
    primary key (art_id)
)
ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
