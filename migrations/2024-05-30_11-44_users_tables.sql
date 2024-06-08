create table users_dt (
    user_id varchar(36) not null, 
    accLogin varchar(128) collate utf8_unicode_ci not null, 
    accAlias varchar(128) collate utf8_unicode_ci not null, 
    pw_hash varchar(256) collate utf8_unicode_ci, 
    vldCode varchar(128) collate utf8_unicode_ci, 
    regDate datetime not null, 
    netWork varchar(16) collate utf8_unicode_ci not null, 
    validDate datetime, 
    photoLink varchar(512) collate utf8_unicode_ci, 
    eMail varchar(128) collate utf8_unicode_ci, 
    birthDay date, 
    socProf varchar(512) collate utf8_unicode_ci, 
    blackList BOOLEAN not null, 
    created_by varchar(36) not null, 
    is_admin BOOLEAN, 
    send_ntf BOOLEAN, 
    pref_lang varchar(16) not null,
    primary key (user_id)
    ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
create table usersGroups_dt (
    group_id varchar(36) not null, 
    groupAlias_en varchar(128) not null, 
    groupAlias_rus varchar(128) not null, 
    activeFlag BOOLEAN not null, 
    created_by varchar(36) not null, 
    primary key (group_id)
    ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
create table usersToGroups_dt (
    group_id varchar(36) not null, 
    user_id varchar(36) not null, 
    read_rule varchar(36) not null, 
    create_rule varchar(36) not null, 
    edit_rule varchar(36) not null, 
    delete_rule varchar(36) not null, 
    created_by varchar(36) not null, 
    send_ntf BOOLEAN, 
    primary key (group_id, user_id)
    ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;