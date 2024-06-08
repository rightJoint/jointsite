create table ntfList_dt (
    ntf_id varchar(36) not null, 
    template_id varchar(36) not null, 
    subscriber_type varchar(36) not null, 
    type_id varchar(36) not null, 
    add_date datetime not null, 
    template_params text collate utf8_unicode_ci, 
    send_params text collate utf8_unicode_ci, 
    send_date datetime, 
    created_by varchar(36), 
    send_res BOOLEAN, 
    send_log varchar(128), 
    primary key (ntf_id)
    ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
create table ntfRead_dt ( 
    ntf_id varchar(36) not null, 
    user_id varchar(36) not null, 
    read_date datetime, 
    put_date datetime, 
    send_flag BOOLEAN, 
    del_flag BOOLEAN, 
    primary key (ntf_id, user_id)
    ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
create table ntfTemplates_dt (
    template_id varchar(36) not null, 
    tName varchar(36) not null, 
    tHeader_en text collate utf8_unicode_ci, 
    tHeader_rus text collate utf8_unicode_ci, 
    tBody_en text collate utf8_unicode_ci, 
    tBody_rus text collate utf8_unicode_ci, 
    date_created datetime, 
    created_by varchar(36) not null, 
    primary key (template_id)
    ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;