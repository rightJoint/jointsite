<?php
//include "application/views/products/productSiteView.php";
class productJointPassView extends View
{
    public $logo="/img/popimg/jointPass.png";

    function __construct()
    {
        parent::__construct();
        $this->styles[] = "/css/products/prod-deploy.css";
        $this->lang_map["head"]["title"] = array(
            "en" => "jointPass - product",
            "rus" => "ДжойнтПасс - продукт",
        );
        $this->lang_map["head"]["h1"] = array(
            "en" => "jointPass - product",
            "rus" => "ДжойнтПасс - продукт",
        );

        $this->lang_map["prod_about"] = array(
            "en" => "tra-ta-ta",
            "rus" => "Упорядоченное и безопасное хранение паролей. Вам не придется помнить пароли от всех ваших учеток, достаточно помнить один МастерПасс от программы.",
        );

        $this->lang_map["product-info"] = array(
            "h2_dwl" => array(
                "en" => "Download jointPass",
                "rus" => "Скачать jointPass",
            ),
            "h2_common" => array(
                "en" => "About product",
                "rus" => "Описание интерфейса",
            ),
            "h2_craft" => array(
                "en" => "Set up",
                "rus" => "Принцип работы программы",
            ),
        );
        $this->lang_map["product-deploy"] = array(
            "install" => array(
                'checkout-branch' => array(
                    "en" => "theme-branch",
                    "rus" => "theme-branch",
                ),
                "download_text" => array(
                    "en" => "",
                    "rus" => "",
                ),
                "download_link" => array(
                    "en" => "(or download archive file, if link presents)",
                    "rus" => "(или скачать архив с файлами если выложен для загрузки)",
                ),
                "example-text" => array(
                    "en" => "clone repository and checkout branch (<strong>use real name of branch instead theme-branch</strong>)",
                    "rus" => "клонирование репозитория и переключение на ветку (<strong>вместо theme-branch вам надо указать название одной из веток сайта</strong>)",
                ),
            ),
        );
        /*
        $this->lang_map["product-migration"] = array(

            "p1" => array(
                "en" => "Set up",
                "rus" => "После того как вы создадите базу данных, вам надо будет создать таблицы и вставить в них начальные данные для работы",
            ),
            "p2" => array(
                "en" => "About product",
                "rus" => "Для настройки подключения к базе данных и проведения миграций можно использовать ветку Admin, если у вас нет другого простого способа для этого.",
            ),
        );*/
        $this->lang_map["product-dwl"] = array(

            "p1" => array(
                "en" => "Set up",
                "rus" => "После того как вы создадите базу данных, вам надо будет создать таблицы и вставить в них начальные данные для работы",
            ),
            "p2" => array(
                "en" => "About product",
                "rus" => "Для настройки подключения к базе данных и проведения миграций можно использовать ветку Admin, если у вас нет другого простого способа для этого.",
            ),
        );
    }

    function print_page_content()
    {

        $this->prod_about();
        $this->prod_menu();
        $this->prod_downloads();
        $this->prod_info();
        $this->prod_craft();
    }

    function prod_downloads()
    {
        echo "<div class='contentBlock-frame'><div class='contentBlock-center'>".
            "<div class='contentBlock-wrap'>".
            "<section>".
            "<h2 id='product-info'>".$this->lang_map["product-info"]["h2_dwl"][$_SESSION["lang"]]."</h2>";
        echo "<p>".
            "<a class='dwl-img-link' href='/downloads/jointPass.zip'><img src='/img/popimg/jointPass.png' title='download jointPass.zip'>jointPass.zip</a>".
            ".zip архив содержит приложение jointPass.exe".
            "<div>КОНТРОЛЬНЫЕ СУММЫ</div>".
            "</p>".
            "<p>Для скачивания доступен репозиторий</p>".
            "<div class='example'>".
            "<div class='example-code'>".
            "git clone jointpass".
            "</div>".
            "<div class='example-code'>".
            "git checkout main".
            "</div>".
            "<div class='example-text'>".
            "установка каталога <span class='ex-conf'>__config</span> в <span class='ex-conf'>core/application.php</span>".
            "</div>".
            "</div>";
        //$this->prod_info_custom();
        echo "</section>".
            "</div></div></div>";
    }

    function prod_info(){

        echo "<div class='contentBlock-frame'><div class='contentBlock-center'>".
            "<div class='contentBlock-wrap'>".
            "<section>".
            "<h2 id='product-info'>".$this->lang_map["product-info"]["h2_common"][$_SESSION["lang"]]."</h2>";
        $this->prod_info_custom();
        echo "</section>".
            "</div></div></div>";
    }

    function prod_info_custom()
    {

        echo "<div class='branches-block'>".

            "<p>Распакуйте jointPass.zip, содайте директорию для запуска приложения и скопируйте в нее jointPass.exe из архива.</p>".
            "<p>Программа проверяет наличие файла настроек jPass.ini в директории запуска и при первом запуске создает этот файл. ".
            "jPass.ini нельзя удалять, хотя в случае удаления .ini-файла данные все равно можно будет восстановить если вы помните МастерПасс</p>".
            "<p>Введите МастерПасс и повторите, выберите язык интерфейса и каталог хранения данных, по умолчанию ".
            "программа предложит /jPass_data</p>";
        echo "<div class='example'>".
            "<div class='example-img'>".
            "<img src='/img/Products/jp-signup_".$_SESSION["lang"].".png'>".
            "</div>".
            "<div class='example-text'>".
            "выберите язык интерфейса и каталог хранения данных".
            $this->lang_map["prod-info-text"]["tables"][$_SESSION["lang"]].
            "</div>".
            "</div>";
        echo "<p>Далее вы перейдете к входу в обычном режиме.</p>";
        echo "<p>Иногда вы можете захотеть изменить MasterPass, для этого нажмите изменить пароль в левом нижнем ".
            "углу чтоб перейти к режиму изменения пароля</p>";
        echo "<div class='example'>".
            "<div class='example-img'>".
            "<img src='/img/Products/jp-change-pass.png'>".
            "</div>".
            "<div class='example-text'>".
            "Программа покажет сколько учеток проверено и сколько паролей перешифровано".
            $this->lang_map["prod-info-text"]["tables"][$_SESSION["lang"]].
            "</div>".
            "</div>";
        echo "<p>После входа вам доступно главное окно программы, а из него остальные окна с отдельной панели</p>";
        echo "<div class='example'>".
            "<div class='example-img'>".
            "<img src='/img/Products/jp-mainWin_".$_SESSION["lang"].".png'>".
            "</div>".
            "<div class='example-text'>".
            "Главное окно программы".
            $this->lang_map["prod-info-text"]["tables"][$_SESSION["lang"]].
            "</div>".
            "</div>";
        echo "<p>Левая часть, с группами и категориями используется для фильтра учеток в таблице в правой части.</p>";
        echo "<p>При выделении строки учетной записи на панели появятся кнопки для копирования в буфер обмена логина и пароля.</p>";
        echo "<p>Вы можете сортировать учетки по дате обновления пароля.</p>";
        echo "<p>Двойной клик на строке учетной приводит к открытию полей учетной записи, так как мы можете хранить и шифровать ".
            "кастомные поля.</p>";
        echo "<div class='example'>".
            "<div class='example-img'>".
            "<img src='/img/Products/jp-accFields_".$_SESSION["lang"].".png'>".
            "</div>".
            "<div class='example-text'>".
            "Создание и удаление полей учетной записи".
            $this->lang_map["prod-info-text"]["tables"][$_SESSION["lang"]].
            "</div>".
            "</div>";
        echo
            "<p>В верхней части главного окна расположены кнопки для перехода к группам, категорям, полям и учеткам</p>".
            "<strong>Для применения большинства изменений в этих окнах на главном окне предназначены кнопки обновить на панели фильтров. ".
            "Некоторые изменения применятся только после перезапуска программы.</strong>";

        echo "<p>Группы и категории предназначены для классификации и фильтрации уетных записей, единственное различие в том что ".
            "категории в главном окне отображаются в таблице, а группы в выпадающем списке.</p>";

        echo "<div class='example'>".
            "<div class='example-img'>".
            "<img src='/img/Products/jp-group_".$_SESSION["lang"].".png'>".
            "</div>".
            "<div class='example-text'>".
            "Миграции через админку".
            $this->lang_map["prod-info-text"]["tables"][$_SESSION["lang"]].
            "</div>".
            "</div>";



        echo "<p>Создайте группу, нажмите обновить</p>";
        echo "<p>Создайте категории, нажмите обновить</p>";
        echo "<div class='example'>".
            "<div class='example-img'>".
            "<img src='/img/Products/jp-cat_".$_SESSION["lang"].".png'>".
            "</div>".
            "<div class='example-text'>".
            "Миграции через админку".
            $this->lang_map["prod-info-text"]["tables"][$_SESSION["lang"]].
            "</div>".
            "</div>";
        echo "<p>Создайте поля</p>";
        echo "<p>Создайте категории, нажмите обновить</p>";
        echo "<div class='example'>".
            "<div class='example-img'>".
            "<img src='/img/Products/jp-fields_".$_SESSION["lang"].".png'>".
            "</div>".
            "<div class='example-text'>".
            "Миграции через админку".
            $this->lang_map["prod-info-text"]["tables"][$_SESSION["lang"]].
            "</div>".
            "</div>";
        echo "<p>Добавьте учетнуюзапись</p>";
        echo "<div class='example'>".
            "<div class='example-img'>".
            "<img src='/img/Products/jp-acc_".$_SESSION["lang"].".png'>".
            "</div>".
            "<div class='example-text'>".
            "Миграции через админку".
            $this->lang_map["prod-info-text"]["tables"][$_SESSION["lang"]].
            "</div>".
            "</div>";




        //    "<p>Введите МастерПасс и повторите пароль, выберите язык интерфейса и каталог хранения данных</p>".
            /*"<h3>Тематические ветки</h3>";
        $this->print_branch("music", $this->lang_map["branches"]["list"]["music"]);
        $this->print_branch("admin", $this->lang_map["branches"]["list"]["admin"]);

        echo "<h3>Core - ветки</h3>";
        $this->print_branch("module", $this->lang_map["branches"]["list"]["module"]);
        $this->print_branch("record", $this->lang_map["branches"]["list"]["record"]);
        echo "</div>";*/
    }

    function prod_deploy_migrations()
    {
        echo "<h3>Миграции</h3>".
            "<p>".$this->lang_map["product-migration"]["p1"][$_SESSION["lang"]]."</p>".
            "<p>".$this->lang_map["product-migration"]["p2"][$_SESSION["lang"]]."</p>";
    }

    function prod_deploy_config()
    {
        echo "<h3>Конфигурирование</h3>".
            "<p>По умолчанию каталог для файлов конфигурации настраивается в <span class='ex-conf'>core/application.php</span></p>".
            "<div class='example'>".
            "<div class='example-code'>".
            "define('JOINT_CONF_DIR', '__config');".
            "</div>".
            "<div class='example-text'>".
            "установка каталога <span class='ex-conf'>__config</span> в <span class='ex-conf'>core/application.php</span>".
            "</div>".
            "</div>".
            "<p>в каталоге <span class='ex-conf'>__config</span> находится файл <span class='ex-conf'>dir_const.php</span>, ".
            "он включается в код и содержит информацию о других настройках сайта</p>".
            "<div class='example'>".
            "<div class='example-code'>".
            "define('SQL_CONN_DEFAULT', '/'.JOINT_CONF_DIR.'/db_conn.php');".
            "</div>".
            "<div class='example-text'>".
            "настройки подключения к БД в <span class='ex-conf'>dir_const.php</span> указывают на файл <span class='ex-conf'>__config/db_conn.php</span>".
            "</div>".
            "</div>";
    }
    function prod_deploy_install()
    {
        echo "<h3>Копирование файлов</h3>".
            "<p>Все библиотеки, конфиги и медиа-файлы максимально включены в репозирорий, ничего отдельно копировать не надо.</p>".
            "<p>Получить файлы проекта можно с помощью гит, клонировав верку из репозитория ".
            $this->lang_map["product-deploy"]["install"]["download_link"][$_SESSION["lang"]].
            "</p>".
            "<div class='example'>".
            "<div class='example-code'>".
            "git clone jointsite".
            "</div>".
            "<div class='example-code'>".
            "git checkout ".$this->lang_map["product-deploy"]["install"]["checkout-branch"][$_SESSION["lang"]].
            "</div>".
            "<div class='example-text'>".
            $this->lang_map["product-deploy"]["install"]["example-text"][$_SESSION["lang"]].
            "</div>".
            "</div>";
    }

    function prod_craft()
    {
        echo "<div class='contentBlock-frame'><div class='contentBlock-center'>".
            "<div class='contentBlock-wrap'>".
            "<section class='prod-deploy'>".
            "<h2 id='product-setup'>".$this->lang_map["product-info"]["h2_craft"][$_SESSION["lang"]]."</h2>";

        echo "<p>При авторизации программа читает jPass.ini и берет из него\ соль (обычный GUID), ".
            "которая прибаляется к введенному паролю, вычисляется hash, который сравниеватся с hash в jointPass.ini. ".
            "После создается новая соль и вычисляется новый hash, перезаписывается jPass.ini</p>";
        echo "<p>Введеный при входе в программу МастерПасс хранится в оперативной памяти на время работы программы ".
            "и испольуется для ширования полей учетных записей. Расшифрованные пароли хранятся в элементах управления при доступах к полю.</p>".
        "<p>Принцип шифрования остнован на этом классе отрывок с гитаба. В программе он реализуется в одном месте, может быть лего дополнен новыми опциями</p>".
            "<p>Пример зашированного поля</p>".
            "<strong>Я не являюсь специалистом по алгоритмам шифрования или сбора метаданных ".
            "работы программы, каких то способов вытащить пароли мне неизвестны, но это не значит что их не существует.</strong>";
        //$this->prod_deploy_install();

        //$this->prod_deploy_migrations();
        echo "</section>".
            "</div></div></div>";

    }

    function prod_about()
    {
        echo "<div class='contentBlock-frame'><div class='contentBlock-center'>".
            "<div class='contentBlock-wrap'>".
            "<section>".
            "<p>".
            $this->lang_map["prod_about"][$_SESSION["lang"]].
            "</p>".
            "</section>".
            "</div></div></div>";
    }

    function prod_menu()
    {
        echo "<div class='contentBlock-frame'><div class='contentBlock-center'>".
            "<div class='contentBlock-wrap'>".
            "<section class='prod-menu'>".
            "<h2>Содержание</h2>".
            "<ul>".
            "<li><a href='#product-info'>".$this->lang_map["product-info"]["h2_dwl"][$_SESSION["lang"]]."</a></li>".
            "<li><a href='#product-info'>".$this->lang_map["product-info"]["h2_common"][$_SESSION["lang"]]."</a></li>".
            "<li><a href='#product-setup'>".$this->lang_map["product-info"]["h2_craft"][$_SESSION["lang"]]."</a></li>".
            "</ul>".
            "</section>".
            "</div></div></div>";

    }
}