<?php
class lang_cntrl_admin_rus extends lang_cntrl_rus
{
    public $auth_required_err = "Контроллер админ: требуется авторизация";
    public $auth_err_login = "Контроллер админ: неправильный логин или пароль";
    public $no_connect_module = "Контроллер админ: невозможно без подключения";
    public $admin_users = array(
        "login_reserved" => "Логин зарезирвирован",
        "login_unacceptable" => "недопустимы логин",
        "password_unacceptable" => "недопустимы пароль",
        "unknown" => "проблема сохранить файл пользователей",
        "Success" => "Успешно",
    );
    public $admin_sql = array(
        "susses" => "Успенно",
        "row" => "запись(ей)",
        "success_no_rows" => "Успешно: нет записей",
        "fail" => "Невыполнимый запрос",
    );
    public $admin_printquery = array(
        "fail" => "запрос на выборку не выполнился",
    );
    public $table_actions = array(
        "create" => "создание",
        "drop" => "удаление",
        "clear" => "очистка",
        "download" => "загрузка",
        "upLoad" => "выгрузка",
        "use_table_name" => "таблицы",
        "fail" => "неудачно",
        "action" => "Действие",
        "options" => "опции",
        "tableName" => "имя таблицы",
    );
}