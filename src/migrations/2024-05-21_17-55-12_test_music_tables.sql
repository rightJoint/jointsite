create table IF NOT EXISTS rjt_musicAlb (
album_id varchar(36) not null, 
albumName varchar(128) collate utf8_unicode_ci not null, 
albumAlias varchar(128) collate utf8_unicode_ci not null, 
metaDescr TEXT collate utf8_unicode_ci, 
dateOfCr date not null, 
albumImg varchar(128) collate utf8_unicode_ci, 
activeFlag BOOLEAN, 
refreshDate date, 
robIndex BOOLEAN, 
created_by varchar(36) not null,
primary key (album_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
create table IF NOT EXISTS rjt_musicTracks (
track_id varchar(36) not null, 
track_name varchar(128) collate utf8_unicode_ci not null, 
track_artist varchar(128) collate utf8_unicode_ci not null, 
track_file varchar(128) collate utf8_unicode_ci, 
loadDate date not null, 
sortDate date,
created_by varchar(36) not null,
primary key (track_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
create table IF NOT EXISTS rjt_musicTracksToAlb (
track_id varchar(36) not null, 
album_id varchar(36) not null, 
comment TEXT collate utf8_unicode_ci,
sortDate date, 
mActive BOOLEAN,
created_by varchar(36) not null,
primary key (track_id, album_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;