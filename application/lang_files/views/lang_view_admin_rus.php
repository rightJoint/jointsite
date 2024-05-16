<?php
class lang_view_admin_rus extends lang_view_rus
{
    function __construct()
    {
        $this->head["description"] = "С помощью админки можно подключаться к базе занных, ".
            "делать копии и вставки таблиц, выполнять sql запросы, ".
            "искать и редактировать записи в таблицах. ".
            "Это завершенный проект, можно использовать для развертвания других модулей чтоб ".
            "провести необходимые миграции в БД, подойдет тех кто не имеет для этого другого простого способа.";
        $this->head["title"] = "Админка для mysql";
        $this->head["h1"] = "Админка для mysql";
        $this->admin_h2 = "Воспользуйтесь меню для начала";
    }
}