<?php
class lang_view_user_validate_rus extends lang_view_rus
{
    function __construct()
    {
        $this->head["title"] ="Валидация на сайте";
        $this->head["description"] = "Валидация на сайте";
        $this->head["h1"] = "подтверждение email";
        $this->vld_login = "логин";
        $this->vld_alias = "псевдоним";
        $this->vld_success = "успешно";
        $this->vld_txt_1 = "Валидация для пользователя";
        $this->vld_txt_2 = "Валидация уже была дата";
        $this->vld_txt_3 = "Используйте меню чтоб войти на сайт ";
    }
}