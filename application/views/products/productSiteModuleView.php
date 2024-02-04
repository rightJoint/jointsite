<?php
include "application/views/products/productSiteView.php";
class productSiteModuleView extends productSiteView
{
    public $logo="/img/popimg/leverage.png";

    function __construct()
    {
        parent::__construct();
        $this->lang_map["head"]["title"] = array(
            "en" => "jointSite - branch Module",
            "rus" => "джойнтСайт - ветка Модуль",
        );
        $this->lang_map["head"]["h1"] = array(
            "en" => "Web Site - branch Module",
            "rus" => "Web site - ветка Модуль",
        );
        $this->lang_map["prod_about"] = $this->lang_map["branches"]["list"]["module"]["descr"];


        $this->lang_map["product-info"] = array(
            "h2_common" => array(
                "en" => "About Module (site manager)",
                "rus" => "О ветке Модуль (Управление сайтом)",
            ),
            "h2_setup" => array(
                "en" => "Set up Module",
                "rus" => "Установка ветки Модуль",
            ),
        );

        $this->lang_map["product-deploy"]["install"]["checkout-branch"] = array(
            "en" => "module",
            "rus" => "module",
        );
        $this->lang_map["product-deploy"]["install"]["download_link"] = array(
            "en" => null,
            "rus" => "null",
        );
        $this->lang_map["product-deploy"]["install"]["example-text"] = array(
            "en" => "clone repository and checkout branch <span class='ex-conf'>module</span>",
            "rus" => "клонирование репозитория и переключение на ветку <span class='ex-conf'>module</span>",
        );

        $this->lang_map["prod_info_custom"] = array(
            "p1" => array(
                "en" => null,
                "rus" => "Ветка Модуль или управление сайтом наследуется от ветки Запись, дополняет существующие методы групповыми операциями и ".
                    "правами на записи в таблицах.",
            ),
            "p1_1" => array(
                "en" => null,
                "rus" => "Для входа в Управление сайтом требуется авторизация на сайте.",
            ),
            "example-text-1" => array(
                "en" => null,
                "rus" => "Вход на сайт через меню",
            ),
            "p2" => array(
                "en" => null,
                "rus" => "После авторизации адмика доступна по url",
            ),
            "example-text-2" => array(
                "en" => null,
                "rus" => "Меню админки",
            ),
            "p3" => array(
                "en" => null,
                "rus" => "В миграциях добавляются пользователи и группы.".
                    "<ul>".
                    "<li>login: siteman, password: siteman</li>".
                    "<li>login: groupman, password: siteman</li>".
                    "<li>login: userman, password: siteman</li>".
                    "</ul>",
            ),
            "p4" => array(
                "en" => null,
                "rus" => "Вы можете зарегистрировать нового пользователя на сайте через меню.",
            ),
            "example-text-3" => array(
                "en" => null,
                "rus" => "Модуль пользователи",
            ),
            "example-text-4" => array(
                "en" => null,
                "rus" => "Список пользователей, поиск",
            ),
            "example-text-5" => array(
                "en" => null,
                "rus" => "Детализация пользователя",
            ),
            "p5" => array(
                "en" => null,
                "rus" => "Личный кабинет доступен по url <span class='ex-conf'>/user</span>, ссылка на него появится в меню после авторизации.",
            ),
            "example-text-6" => array(
                "en" => null,
                "rus" => "личный кабинет /user",
            ),
            "p6" => array(
                "en" => null,
                "rus" => "Доступ к модую задается для групп в конфигурации модуля. ".
                    "Для включения доступа пользователя к модулю, его надо добавить в соответствующую группу. ".
                    "Отдельно для пользователя задаются уровни доступа в группе (создание, удаление, просмотр и редактирование)",
            ),
            "p7" => array(
                "en" => null,
                "rus" => "Права пользователя на модуль применяются ко всем таблицам модуля по полю created_by в таблице. ".
                    "Если доступ к модулю настроен для нескольких групп, то применяются максимальные права из всех групп пользователя.",
            ),
            "p8" => array(
                "en" => null,
                "rus" => "Для включенния полного доступа без учета групп надо использовать настройку <span class='ex-conf'>админ</span> у пользователя.",
            ),
            "h3" => array(
                "en" => null,
                "rus" => "Уведомления",
            ),
            "p9" => array(
                "en" => null,
                "rus" => "Отправка уведомлений настроена в коде (заглушка для отправки уведомлений).",
            ),
            "p10" => array(
                "en" => null,
                "rus" => "Отправка личных уведомлений на email (смена пароля) для пользователя можно включить в основных настройках в личном кабинете",
            ),
            "p11" => array(
                "en" => null,
                "rus" => "Отправка групповых уведомлений на email (регистрация пользователя и т.п.) можно включить в настройках группы в личном кабинете.",
            ),
        );

        $this->lang_map["product-migration"]["example-text-1"] = array(
            "en" => null,
            "rus" => "Миграции через админку",
        );
        $this->lang_map["product-migration"]["p3"] = array(
            "en" => null,
            "rus" => "Вам надо создать таблицы. Запросы на создание таблиц расположены по умолчанию в каталоге",
        );
        $this->lang_map["product-migration"]["p4"] = array(
            "en" => null,
            "rus" => "Добавление данных в таблицы. Запросы на добавление данных в таблице по умолчанию в каталоге",
        );

        $this->lang_map["product-config"]["p3"] = array(
            "en" => null,
            "rus" => "Дополнительно устанавлюваются еще две настройки",
        );
        $this->lang_map["product-config"]["li-1"] = array(
            "en" => null,
            "rus" => "директория хранения данных пользователя",
        );
        $this->lang_map["product-config"]["li-2"] = array(
            "en" => null,
            "rus" => "директория для выгрузки аватарок пользователей",
        );
        $this->lang_map["product-config"]["example-text-3-1"] = array(
            "en" => null,
            "rus" => "каталоги для хранения данных пользователя",
        );
        $this->lang_map["product-config"]["example-text-3-2"] = array(
            "en" => null,
            "rus" => "аватарки",
        );
        $this->lang_map["product-config"]["p4"] = array(
            "en" => null,
            "rus" => "Настройки модуля, доступы, связи, элиасы и другие устанавливаются в",
        );
        $this->lang_map["product-config"]["example-text-4-1"] = array(
            "en" => null,
            "rus" => "включение файла",
        );
        $this->lang_map["product-config"]["example-text-4-2"] = array(
            "en" => null,
            "rus" => "в",
        );

    }

    function prod_info_custom(){

        echo "<p>".
            $this->lang_map["prod_info_custom"]["p1"][$_SESSION["lang"]].

            "</p>".
            "<p>".
            $this->lang_map["prod_info_custom"]["p1_1"][$_SESSION["lang"]].
            "</p>".
            "<div class='example eximg'>".
            "<div class='example-img'>".
            "<img src='/img/Products/user-auth_form_".$_SESSION["lang"].".png'>".
            "</div>".
            "<div class='example-text'>".
            $this->lang_map["prod_info_custom"]["example-text-1"][$_SESSION["lang"]].
            "</div>".
            "</div>".
            "<p>".
            $this->lang_map["prod_info_custom"]["p2"][$_SESSION["lang"]].
            " <span class='ex-conf'>/siteman</span></p>".
            "<div class='example eximg'>".
            "<div class='example-img'>".
            "<img src='/img/Products/siteman-menu-1_".$_SESSION["lang"].".png'>".
            "</div>".
            "<div class='example-text'>".
            $this->lang_map["prod_info_custom"]["example-text-2"][$_SESSION["lang"]].
            "</div>".
            "</div>".
            "<p>".
            $this->lang_map["prod_info_custom"]["p3"][$_SESSION["lang"]].
            "</p>".
            "<p>".
            $this->lang_map["prod_info_custom"]["p4"][$_SESSION["lang"]].
            "</p>".
            "<div class='example eximg'>".
            "<div class='example-img'>".
            "<img src='/img/Products/siteman-users_module_".$_SESSION["lang"].".png'>".
            "</div>".
            "<div class='example-text'>".
            $this->lang_map["prod_info_custom"]["example-text-3"][$_SESSION["lang"]].
            "</div>".
            "</div>".
            "<div class='example eximg'>".
            "<div class='example-img'>".
            "<img src='/img/Products/siteman-users_list_".$_SESSION["lang"].".png'>".
            "</div>".
            "<div class='example-text'>".
            $this->lang_map["prod_info_custom"]["example-text-4"][$_SESSION["lang"]].
            "</div>".
            "</div>".
            "<div class='example eximg'>".
            "<div class='example-img'>".
            "<img src='/img/Products/siteman-users_detail_".$_SESSION["lang"].".png'>".
            "</div>".
            "<div class='example-text'>".
            $this->lang_map["prod_info_custom"]["example-text-5"][$_SESSION["lang"]].
            "</div>".
            "</div>".
            "<p>".
            $this->lang_map["prod_info_custom"]["p5"][$_SESSION["lang"]].
            "</p>".
            "<div class='example eximg'>".
            "<div class='example-img'>".
            "<img src='/img/Products/user-lk_".$_SESSION["lang"].".png'>".
            "</div>".
            "<div class='example-text'>".
            $this->lang_map["prod_info_custom"]["example-text-6"][$_SESSION["lang"]].
            "</div>".
            "</div>".
            "<p>".
            $this->lang_map["prod_info_custom"]["p6"][$_SESSION["lang"]].
            "</p>".
            "<p>".
            $this->lang_map["prod_info_custom"]["p7"][$_SESSION["lang"]].
            "</p>".
            "<p>".
            $this->lang_map["prod_info_custom"]["p8"][$_SESSION["lang"]].
            "</p>".
            "<h3>".$this->lang_map["prod_info_custom"]["h3"][$_SESSION["lang"]]."</h3>".
            "<p>".$this->lang_map["prod_info_custom"]["p9"][$_SESSION["lang"]]."</p>".
            "<p>".$this->lang_map["prod_info_custom"]["p10"][$_SESSION["lang"]]."</p>".
            "<p>".$this->lang_map["prod_info_custom"]["p11"][$_SESSION["lang"]]."</p>";
    }

    function prod_deploy_migrations()
    {
        parent::prod_deploy_migrations(); // TODO: Change the autogenerated stub
        echo "<div class='example eximg'>".
            "<div class='example-img'>".
            "<img src='/img/Products/siteman-migr_".$_SESSION["lang"].".png'>".
            "</div>".
            "<div class='example-text'>".
            $this->lang_map["product-migration"]["example-text-1"][$_SESSION["lang"]].
            "</div>".
            "</div>".
            "<p>".
            $this->lang_map["product-migration"]["p3"][$_SESSION["lang"]].
            " <span class='ex-conf'>__config/admin/createTablesQueries</span>".
            "<ul>".
            "<li>users_dt</li>".
            "<li>userstogroups_dt</li>".
            "<li>usersgroups_dt</li>".
            "<li>ntftemplates_dt</li>".
            "<li>ntfread_dt</li>".
            "<li>ntflist_dt</li>".
            "</ul>".
            "</p>".
            "<p>".$this->lang_map["product-migration"]["p4"][$_SESSION["lang"]]." <span class='ex-conf'>usrdata/db</span></p>".
            "<ul>".
            "<li>202401013_ntftemplates_dt.php</li>".
            "<li>20240110_213035_userstogroups_dt</li>".
            "<li>20240110_213034_usersgroups_dt</li>".
            "<li>20240109_213034_users_dt</li>".
            "</ul>";
    }

    function prod_deploy_config()
    {
        parent::prod_deploy_config();
        echo "<p>".
            $this->lang_map["product-config"]["p3"][$_SESSION["lang"]].
            "<ul>".
            "<li>UPLOAD_DIR_DEFAULT - ".$this->lang_map["product-config"]["li-1"][$_SESSION["lang"]]." /usrdata </li>".
            "<li>USERS_AVATARS_DIR - ".$this->lang_map["product-config"]["li-2"][$_SESSION["lang"]]." /usrdata/avatars</li>".
            "</ul>".
            "</p>".
            "<div class='example'>".
            "<div class='example-code'>".
            "define('UPLOAD_DIR_DEFAULT', '/usrdata');".
            "</div>".
            "<div class='example-code'>".
            "define('USERS_AVATARS_DIR', '/usrdata/avatars');".
            "</div>".
            "<div class='example-text'>".
            $this->lang_map["product-config"]["example-text-3-1"][$_SESSION["lang"]].
            " <span class='ex-conf'>/usrdata</span> ".$this->lang_map["product-config"]["example-text-3-2"][$_SESSION["lang"]].
            " <span class='ex-conf'>/usrdata/avatars</span>".
            "</div>".
            "</div>".
            "<p><strong>".$this->lang_map["product-config"]["p4"][$_SESSION["lang"]]." __config/modulesInfo.php</strong></p>".
            "<div class='example'>".
            "<div class='example-code'>".
            "require_once JOINT_CONF_DIR.'/modulesInfo.php';".
            "</div>".
            "<div class='example-text'>".$this->lang_map["product-config"]["example-text-4-1"][$_SESSION["lang"]].
            " <span class='ex-conf'>__config/modulesInfo.php</span> ".$this->lang_map["product-config"]["example-text-4-2"][$_SESSION["lang"]].
            " <span class='ex-conf'>controller_siteman.php</span>".
            "</div>".
            "</div>";
    }

}