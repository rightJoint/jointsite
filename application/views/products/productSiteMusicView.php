<?php
include "application/views/products/productSiteView.php";
class productSiteMusicView extends productSiteView
{
    public $logo="/img/popimg/music-logo.png";

    function __construct()
    {
        parent::__construct();
        $this->lang_map["head"]["title"] = array(
            "en" => "jointSite - branch Music",
            "rus" => "джойнтСайт - ветка Музыка",
        );
        $this->lang_map["head"]["h1"] = array(
            "en" => "Web Site - branch Music",
            "rus" => "Web site - ветка Музыка",
        );
        $this->lang_map["prod_about"] = $this->lang_map["branches"]["list"]["music"]["descr"];

        $this->lang_map["product-info"] = array(
            "h2_common" => array(
                "en" => "About branch music",
                "rus" => "О ветке Музыка",
            ),
            "h2_setup" => array(
                "en" => "Set up music gallery",
                "rus" => "Установка музыкально галлереи",
            ),
        );
        $this->lang_map["product-deploy"] = array(
            "install" => array(
                'checkout-branch' => array(
                    "en" => "music",
                    "rus" => "music",
                ),

                "download_link" => array(
                    "en" => "ref to wdl",
                    "rus" => "ref to wdl",
                ),
                "example-text" => array(
                    "en" => "clone repository and checkout branch <span class='ex-conf'>music</span>",
                    "rus" => "клонирование репозитория и переключение на ветку <span class='ex-conf'>music</span>",
                ),
            ),
        );

        $this->lang_map["product-migration"] = array(

            "p1" => array(
                "en" => "Set up",
                "rus" => "Миграции проводятся по аналогии с веткой Модуль (Управление сайтом)",
            ),
            "p2" => array(
                "en" => "Set up",
                "rus" => "Создайте табллицы".
            "<ul>".
            "<li>musicalb_dt</li>".
            "<li>musictrackstoalb_dt</li>".
            "<li>musictracks_dt</li>".
            "</ul>",
            ),
            "p3" => array(
                "en" => "About product",
                "rus" => "Вставьте данные в таблицы".
                    "<ul>".
                    "<li>20240110_musicalb_dt.php</li>".
                    "<li>20240110_musictracks_dt.php</li>".
                    "<li>20240110_musictrackstoalb_dt.php</li>".
                    "<li>20240128_users_dt.php</li>".
                    "<li>20240128_usersgroups_dt.php</li>".
                    "<li>20240128_userstogroups_dt.php</li>".
                    "</ul>",
            ),
        );
    }

    function prod_info_custom(){

        echo "<p>Эта музыкальная галлерея точно такая же как на этом сайте <a href='/music' title='слушать'>смотреть</a> </p>".
            "<p>Ветка музыка использует ветку Управление сайтом в админской части для создания альбомов и трэков, ".
            "доступ к управлению музыкой как и с другими группами ветки Управление сайтом".
            "</p>".
            "<p>После проведения миграций, для входа используйте логин musicman и пароль siteman</p>".
            "<div class='example eximg'>".
            "<div class='example-img'>".
            "<img src='/img/Products/music-sm-main_".$_SESSION["lang"].".png'>".
            "</div>".
            "<div class='example-text'>".
            "Управление музыкой в /siteman/music.".
            $this->lang_map["prod-info-text"]["tables"][$_SESSION["lang"]].
            "</div>".
            "</div>".

            "<p>После авторизации адмика доступна по url /siteman</p>";
    }

    function prod_deploy_config()
    {
        echo "<h3>Конфигурирование</h3>".
            "<p>Конфигурирование для Музыка<span class='ex-conf'>core/application.php</span></p>";
        //parent::prod_deploy_config();
        /*
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
        */
    }

    function prod_deploy_migrations()
    {

        parent::prod_deploy_migrations(); // TODO: Change the autogenerated stub
        echo "<div class='example'>".
            "<div class='example-img'>".
            "<img src='/img/Products/music-migr_".$_SESSION["lang"].".png'>".
            "</div>".
            "<div class='example-text'>".
            "Миграции через админку".
            $this->lang_map["prod-info-text"]["tables"][$_SESSION["lang"]].
            "</div>".
            "</div>";
    }

}