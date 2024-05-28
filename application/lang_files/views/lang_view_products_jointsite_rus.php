<?php
require_once ($_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
    "/application/lang_files/views/lang_view_main_rus.php");
class lang_view_products_jointsite_rus extends lang_view_main_rus
{
    function __construct()
    {
        parent::__construct();

        $this->head["h1"] = "JointSite - продукт";
        $this->head["title"] = "JointSite - продукт";
        $this->head["description"] = "ДжойнтСайт продукт: web-приложение, описание веток, установка";

        $this->product_custom["p1"] = "Реальный сайт настроен на этот репозитории и может содержать другие ветки, ".
                "для скачивания в полностью собраном виде доступны только те ветки, что даны в описании. ".
        "Приложение можно запустить как сайт или на существующем сайте в отдельном каталоге.";

        $this->prodmenu = array(
            "h2_сontent" => "Содержание",
            "h2_common" => "О продукте",
            "h2_setup" => "Установка",
            "h2_test" => "Тест",
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
        $this->prod_test = array(
            "p1" => "Для теста внутри этого приложения используется отдельный url <span class='ex-conf'>/test</span>."
        );
    }
}