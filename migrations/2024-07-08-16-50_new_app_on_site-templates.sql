insert into ntfTemplates_dt (
    template_id, tName, tHeader_en, tHeader_rus, tBody_en, tBody_rus, date_created, created_by)
values
('A8B40BF3-1A23-40B5-9CD7-1038F3841FBE', 'new-app-siteman', 'New app on (site for siteman)', 'Новая заявка на сайте (для siteman)', '<p>New app on site (for siteman) <a title="see app" href="$^server_host/applications/details/$^appl_id">see app</a></p>', '<p>New app on site (for siteman) <a title="see app" href="$^server_host/applications/details/$^appl_id">see app</a></p>', '2024-04-08 12:49:00', '36332131-C26E-4B63-A22D-11A3076074ED'),
('D90DF7C2-B1CA-439B-9963-11294C6A6697', 'new-app-user', 'Application on rightjoint.ru is accepted', 'Заявка на rightjoint.ru принята', '<p>Your app on $^server_host is accepted<a title="see your app" href="$^server_host/applications/details/$^appl_id">see app</a></p>', '<p>Your app on $^server_host is accepted<a title="see your app" href="$^server_host/applications/details/$^appl_id">see app</a></p>', '2024-04-08 15:11:45', '36332131-C26E-4B63-A22D-11A3076074ED');