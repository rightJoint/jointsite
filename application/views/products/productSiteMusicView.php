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
                "rus" => "Установка музыкальной галлереи",
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
                "rus" => "Дополнительно создайте таблицы:".
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

        echo "<p>".
            "Музыкальная галлерея, точно такая же как на этом сайте <a href='/music' title='слушать'>смотреть</a>".
            "</p>".
            "<p>".
            "Ветка музыка использует ветку Модуль (Управление сайтом) в админской части для создания альбомов и трэков, ".
            "доступ к управлению музыкой настраивается через админку <span class='ex-conf'>siteman</span> по аналогии с другими ".
            "группами ветки Управление сайтом".
            "</p>".
            "<p>".
            "После проведения миграций, для входа используйте логин <span class='ex-conf'>musicman</span> и пароль <span class='ex-conf'>siteman</span>".
            "</p>".
            "<div class='example eximg'>".
            "<div class='example-img'>".
            "<img src='/img/Products/music-sm-main_".$_SESSION["lang"].".png'>".
            "</div>".
            "<div class='example-text'>".
            "Управление музыкой в <span class='ex-conf'>/siteman/music</span>".
            $this->lang_map["prod-info-text"]["tables"][$_SESSION["lang"]].
            "</div>".
            "</div>".

            "<p>После авторизации адмика доступна по url <span class='ex-conf'>/siteman</span></p>";
    }

    function prod_deploy_config()
    {
        echo "<h3>Конфигурирование</h3>".
            "<p>Поскольку ветка музыка зависит от ветки Модуль, то и начальное конфигурирование такое же как и для ".
            "Управление сайтом. В файле <span class='ex-conf'>dir_const.php</span> дополнительно настраиваются директории для ".
            "хранения трэков и обложек альбомов</p>".
            "<div class='example'>".
            "<div class='example-code'>".
            "define('MUSIC_COVERS_DIR', UPLOAD_DIR_DEFAULT.'/music/covers');".
            "</div>".
            "<div class='example-code'>".
            "define('MUSIC_TRACKS_DIR', UPLOAD_DIR_DEFAULT.'/music/tracks');".
            "</div>".
            "<div class='example-text'>".
            "каталоги для хранения данных пользователя <span class='ex-conf'>/usrdata/music/covers</span> обложки".
            " <span class='ex-conf'>/usrdata/avatars/music/tracks</span> мелодии".
            "</div>".
            "</div>";
    }

    function prod_deploy_migrations()
    {

        parent::prod_deploy_migrations(); // TODO: Change the autogenerated stub
        echo "<div class='example'>".
            "<div class='example-img'>".
            "<img src='/img/Products/music-migr_".$_SESSION["lang"].".png'>".
            "</div>".
            "<div class='example-text'>".
            "Миграции в музыке через админку".
            $this->lang_map["prod-info-text"]["tables"][$_SESSION["lang"]].
            "</div>".
            "</div>".
            "<p>".
            $this->lang_map["product-migration"]["p3"][$_SESSION["lang"]].
            "</p>";
    }

}