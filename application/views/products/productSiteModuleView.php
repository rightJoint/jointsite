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

        $this->lang_map["product-deploy"] = array(
            "install" => array(
                'checkout-branch' => array(
                    "en" => "module",
                    "rus" => "module",
                ),

                "download_link" => array(
                    "en" => null,
                    "rus" => "null",
                ),
                "example-text" => array(
                    "en" => "clone repository and checkout branch <span class='ex-conf'>module</span>",
                    "rus" => "клонирование репозитория и переключение на ветку <span class='ex-conf'>module</span>",
                ),
            ),
        );

    }

    function prod_info_custom(){

        echo "<p>Ветка Модуль или управление сайтом наследуется от ветки Запись, дополняет существующие методы групповыми операциями и ".
            "правами на записи в таблицах.</p>".
            "<p>Для входа в админку требуется авторизация на сайте.</p>".
            "<div class='example eximg'>".
            "<div class='example-img'>".
            "<img src='/img/Products/user-auth_form_".$_SESSION["lang"].".png'>".
            "</div>".
            "<div class='example-text'>".
            "Вход на сайт через меню.".
            $this->lang_map["prod-info-text"]["tables"][$_SESSION["lang"]].
            "</div>".
            "</div>".

            "<p>После авторизации адмика доступна по url /siteman</p>".
            "<div class='example eximg'>".
            "<div class='example-img'>".
            "<img src='/img/Products/siteman-menu-1_".$_SESSION["lang"].".png'>".
            "</div>".
            "<div class='example-text'>".
            "Меню админки. ".
            $this->lang_map["prod-info-text"]["tables"][$_SESSION["lang"]].
            "</div>".
            "</div>".
            "<p>В миграциях добавляются пользователи и группы.</p>".
            "<ul>".
            "<li>login: siteman, password: siteman</li>".
            "<li>login: groupman, password: siteman</li>".
            "<li>login: userman, password: siteman</li>".
            "</ul>".
            "<p>Вы можете зарегистрировать нового пользователя на сайте через меню.</p>".
            "<div class='example eximg'>".
            "<div class='example-img'>".
            "<img src='/img/Products/siteman-users_module_".$_SESSION["lang"].".png'>".
            "</div>".
            "<div class='example-text'>".
            "Модуль пользователи. ".
            $this->lang_map["prod-info-text"]["tables"][$_SESSION["lang"]].
            "</div>".
            "</div>".
            "<div class='example eximg'>".
            "<div class='example-img'>".
            "<img src='/img/Products/siteman-users_list_".$_SESSION["lang"].".png'>".
            "</div>".
            "<div class='example-text'>".
            "Список пользователей, поиск.".
            $this->lang_map["prod-info-text"]["tables"][$_SESSION["lang"]].
            "</div>".
            "</div>".
            "<div class='example eximg'>".
            "<div class='example-img'>".
            "<img src='/img/Products/siteman-users_detail_".$_SESSION["lang"].".png'>".
            "</div>".
            "<div class='example-text'>".
            "Детализация пользователя.".
            $this->lang_map["prod-info-text"]["tables"][$_SESSION["lang"]].
            "</div>".
            "</div>".
            "<p>Личный кабинет доступен по url /user, ссылка на него появится в меню после авторизации.</p>".
            "<div class='example eximg'>".
            "<div class='example-img'>".
            "<img src='/img/Products/user-lk_".$_SESSION["lang"].".png'>".
            "</div>".
            "<div class='example-text'>".
            "личный кабинет /user".
            $this->lang_map["prod-info-text"]["tables"][$_SESSION["lang"]].
            "</div>".
            "</div>".
            "<p></p>".


            "<p>Доступ к модую задается для групп в конфигурации модуля.</p>".
            "<p>Для включения доступа пользователя к модулю, его надо добавить в соответствующую группу.</p>".
            "<p>Отдельно для пользователя задаются уровни доступа в группе (создание, удаление, просмотр и редактирование)</p>".
            "<p>Права пользователя на модуль применяются ко всем таблицам модуля по полю created_by в таблице.</p>".
            "<p>Если доступ к модулю настроен для нескольких групп, то применяются максимальные права из всех групп пользователя.</p>".
            "<p>Для включенния полного доступа без учета групп надо использовать настройку is_admin у пользователя.</p>".
            "<h3>Уведомления</h3>".
            "<p>Отправка уведомлений настроена в коде (загрлушка для отправки уведомлений).</p>".
            "<p>Отправка личных уведомлений на email (смена пароля) для пользователя можно включить в основных настройках в личном кабинете</p>".
            "<p>Отправка групповых уведомлений на email (регистрация пользователя и т.п.) можно включить в настройках группы в личном кабинете</p>";
    }

    function prod_deploy_migrations()
    {
        parent::prod_deploy_migrations(); // TODO: Change the autogenerated stub
        echo "<div class='example eximg'>".
            "<div class='example-img'>".
            "<img src='/img/Products/siteman-migr_".$_SESSION["lang"].".png'>".
            "</div>".
            "<div class='example-text'>".
            "Миграции через админку".
            $this->lang_map["prod-info-text"]["tables"][$_SESSION["lang"]].
            "</div>".
            "</div>".

            "<p>Вам надо создать таблицы. Запросы на создание таблиц расположены по умолчанию в каталоге __config/admin/createTablesQueries</p>".
            "<ul>".
            "<li>users_dt</li>".
            "<li>userstogroups_dt</li>".
            "<li>usersgroups_dt</li>".
            "<li>ntftemplates_dt</li>".
            "<li>ntfread_dt</li>".
            "<li>ntflist_dt</li>".
            "</ul>".
            "<p>Добавление данных в таблицы. Запросы на добавление данных в таблице по умолчанию в каталоге usrdata/db</p>".
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
        echo "<p>По умолчанию каталог для файлов конфигурации настраивается в <span class='ex-conf'>core/application.php</span></p>".
            "<p>в каталоге <span class='ex-conf'>__config</span> находится файл <span class='ex-conf'>dir_const.php</span>, ".
            "он включается в код и содержит информацию о других настройках сайта</p>".
            "<div class='example'>".
            "<div class='example-code'>".
            "define('UPLOAD_DIR_DEFAULT', '/usrdata');".
            "</div>".
            "<div class='example-code'>".
            "define('USERS_AVATARS_DIR', '/usrdata/avatars');".
            "</div>".
            "<div class='example-text'>".
            "каталоги для хранения данных пользователя <span class='ex-conf'>/usrdata</span> аватарки <span class='ex-conf'>/usrdata/avatars</span>".
            "</div>".
            "</div>".
            "<p>Дополнительно устанавлюваются еще две настройки</p>".
            "<ul>".
            "<li>UPLOAD_DIR_DEFAULT - директория хранения данных пользователя /usrdata </li>".
            "<li>USERS_AVATARS_DIR - директория для выгрузки аватарок пользователей /usrdata/avatars</li>".
            "</ul>".
            "<p><strong>Настройки модуля, доступы, связи, элиасы и другие устанавливаются в __config/modulesInfo.php</strong></p>".
            "<div class='example'>".
            "<div class='example-code'>".
            "require_once JOINT_CONF_DIR.'/modulesInfo.php';".
            "</div>".
            "<div class='example-text'>".
            "включение файла <span class='ex-conf'>__config/modulesInfo.php</span> в <span class='ex-conf'>controller_siteman.php</span>".
            "</div>".
            "</div>";
    }

}