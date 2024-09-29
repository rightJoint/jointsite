<?php
require_once JOINT_SITE_REQ_LANG."/views/lang_view_main.php";
class lang_view_products_jointsite extends lang_view_main
{
    function __construct()
    {
        parent::__construct();

        $this->head["h1"] = "JointSite - продукт";
        $this->head["title"] = "JointSite - продукт";
        $this->head["description"] = "ДжойнтСайт продукт: web-приложение, описание веток, установка";

        $this->product_custom["p1"] = "Это домашний проект, пока используется в целях тестирования технологий, ".
                "но так же может быть применен для решения реальных задач";

        $this->prodmenu = array(
            "h2_сontent" => "Содержание",
            "h2_common" => "О проекте",
            "h2_setup" => "Установка",
        );
        $this->product_deploy = array(
            "install" => array(
                'h3' => "Копирование файлов",
                'p1' => "Все библиотеки, конфиги и медиа-файлы максимально включены в репозирорий, ничего отдельно копировать не надо.",
                'p2' => "Для клонирования репозитория в каталог <span class='ex-conf'>/current_dir/jointsite</span>, ".
                    "выполните в текущем каталоге <span class='ex-conf'>/current_dir</span> команду git clone",
                'checkout-branch' => "theme-branch",
                "download_text" => "",
                "download_link" => "",
                "example-text" => "клонирование репозитория и переключение на ветку ".
                    "(<strong>вместо theme-branch вам надо указать название одной из веток сайта</strong>)",
                'p3' => "Чтоб использовать репозиторий в текущем пустом каталоге <span class='ex-conf'>/current_dir</span>, ".
                    "выполните следующие команды: ",
                "example-text2" => "Создание пустого и добавление к нему удаленного репозитория. ".
                    "Создание новой ветки и настройка на отслеживание одноименной удаленной ",
            ),
            "server" => array(
                "h3" => "Сервер",
                "p1" => "Сайт установлен на хостинг, локально тестировался на Open Server Panel со следующими настройками:",
            ),
        );
        $this->product_migration = array(
            "h3" => "Миграции",
            "p1" => "Обычно, после того как вы создадите базу данных, вам надо будет создать таблицы и вставить в них начальные данные для работы.",
            "p2" => "Для настройки подключений, создания таблиц и проведения миграций ".
                "вы можете клонировать и влить в проект тематичекую верку <span class='ex-conf'>admin</span>",
        );

        $this->product_config = array(
            "h3" => "Конфигурирование",
            "p1" => " <span class='ex-conf'>.htaccess</span> - файл включен в репозиторий. ".
                "Для запуска внутри другого сайта, необходимо отредактировать .htaccess",
            "example-text-1" => "настройка точки входа в приложение ",
            "p2" => "Так же для запуска из отдельной директории, необходимо указать приложению, откуда оно запускается ".
                " в <span class='ex-conf'>index.php</span>",
            "example-text-2" => "Устанока директории <span class='ex-conf'>/mirror</span> для запуска внутри другого приложения",
            "mirror_dir" => "/mirror",
            "mirror_base" => "mirror"
        );
    }
}