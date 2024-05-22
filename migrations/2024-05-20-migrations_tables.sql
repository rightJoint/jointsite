create table migrations (
                            migration_name varchar(256) not null,
                            status varchar(32) not null,
                            try_date datetime,
                            add_date datetime,
                            migr_file tinyint,
                            primary key (migration_name)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
create table migrations_log (
                                migration_log_id varchar(36) not null,
                                migration_name varchar(256) not null,
                                add_date datetime not null,
                                migration_log TEXT,
                                primary key (migration_log_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;