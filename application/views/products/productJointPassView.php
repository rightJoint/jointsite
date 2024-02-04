<?php
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
            "rus" => "Органайзер паролей. Вам не придется помнить пароли от всех ваших учеток, достаточно помнить один МастерПасс от программы.",
        );

        $this->lang_map["product-info"] = array(
            "h2_сontent" => array(
                "en" => "Table of content",
                "rus" => "Содержание",
            ),
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
            "h2_feedback" => array(
                "en" => "Feedback",
                "rus" => "Обратная связь",
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
        $this->lang_map["jp-feedback"] = array(
            "p1" => array(
                "en" => "",
                "rus" => "Если у вас есть вопросы по программе Джойнт Пасс, напишите мне на eMail",
            ),
        );
        $this->lang_map["jp-dwl"] = array(
            "a_title" => array(
                "en" => "download",
                "rus" => "скачать",
            ),
            "p1_txt1" => array(
                "en" => "download",
                "rus" => "архив содержит приложение",
            ),
            "p1_txt2" => array(
                "en" => "download",
                "rus" => "Распакуйте jointPass.zip, содайте директорию для запуска приложения и скопируйте в нее jointPass.exe из архива.",
            ),
            "p2" => array(
                "en" => "download",
                "rus" => "Для проверки контрольных сумм можно использовать <span class='ex-conf'>CertUtil</span> из консоли. ".
                    "Хэш MD5 должен быть равен",
            ),
            "ex-text1" => array(
                "en" => "download",
                "rus" => "Проверка  <span class='ex-conf'>Хэш MD5</span>",
            ),
            "p3" => array(
                "en" => "download",
                "rus" => "Для скачивания, кому интересен код, доступен репозиторий",
            ),
            "ex-text2" => array(
                "en" => "download",
                "rus" => "клонирование репозитория программы Джойнт Пасс",
            ),
        );
        $this->lang_map["jp-gui"] = array(
            "p1" => array(
                "en" => "",
                "rus" => "Программа проверяет наличие файла настроек <span class='ex-conf'>jPass.ini</span> в директории запуска и при первом запуске создает этот файл. ".
                    "jPass.ini нельзя удалять, хотя в случае удаления .ini-файла данные все равно можно будет восстановить если вы помните МастерПасс.",
            ),
            "p2" => array(
                "en" => "",
                "rus" => "Введите МастерПасс и повторите, выберите язык интерфейса и каталог хранения данных, по умолчанию ".
                    "программа предложит <span class='ex-conf'>C:\Users\CurrentUser\Documents\jPass_data</span>",
            ),
            "example-text-1" => array(
                "en" => "",
                "rus" => "Окно первичной авторизации",
            ),
            "p3" => array(
                "en" => "",
                "rus" => "Далее вы перейдете к входу в обычном режиме.",
            ),
            "p4" => array(
                "en" => "",
                "rus" => "Иногда вы можете захотеть изменить MasterPass, для этого нажмите чекбокс изменить пароль в левом нижнем ".
                    "углу чтоб перейти к режиму изменения пароля.",
            ),
            "example-text-2" => array(
                "en" => "",
                "rus" => "Окно изменения пароля. Программа покажет сколько учеток проверено и сколько полей перешифровано",
            ),
            "p5" => array(
                "en" => "",
                "rus" => "После входа откроется главное окно программы, а из него по кнопкам с отдельной панели доступны другие окна.",
            ),
            "example-text-3" => array(
                "en" => "",
                "rus" => "Главное окно программы, слева фильтры, справа учетки.",
            ),
            "p6" => array(
                "en" => "",
                "rus" => "Левая часть, с группами и категориями используется для фильтра учеток в таблице в правой части.",
            ),
            "p7" => array(
                "en" => "",
                "rus" => "При выделении строки учетной записи на панели появятся кнопки для копирования в буфер обмена логина и пароля.",
            ),
            "p8" => array(
                "en" => "",
                "rus" => "Вы можете сортировать учетки по дате обновления пароля.",
            ),
            "p9" => array(
                "en" => "",
                "rus" => "Двойной клик на строке учетки приводит к открытию полей учетной записи, так как мы можете хранить и шифровать ".
                    "кастомные поля.",
            ),
            "example-text-4" => array(
                "en" => "",
                "rus" => "Окно поля учетной записи",
            ),
            "p10" => array(
                "en" => "",
                "rus" => "В верхней части главного окна на отдельной панели расположены кнопки для перехода к группам, категориям, списку полей и учеткам.</p>".
                    "<strong>Для применения большинства изменений в этих окнах на главном окне предназначены кнопки обновить на панели фильтров. ".
                    "Некоторые изменения применятся только после перезапуска программы.</strong>",
            ),
            "p11" => array(
                "en" => "",
                "rus" => "Группы и категории предназначены для классификации и фильтрации учетных записей, единственное различие в том что ".
                    "категории в главном окне отображаются в таблице, а группы в выпадающем списке.",
            ),
            "example-text-5" => array(
                "en" => "",
                "rus" => "Окно группы",
            ),
            "p12" => array(
                "en" => "",
                "rus" => "Вы можете добавлять изображения к группам, категориям и полям.<br>".
                    "<strong>Программа не обрабатывает изображения при загрузке, рекомендуется загружать иконки, а не фотографии высоком разрешении.</strong>",
            ),
            "example-text-6" => array(
                "en" => "",
                "rus" => "Окно категории",
            ),
            "p13" => array(
                "en" => "",
                "rus" => "Часто к учетной записи кроме логина и пароля хочется добавить еще какую нибудь полезную информацию, ".
                    "например token git hub или ip-адрес. ".
                    "Для этого вы можете создать собственные поля и включить их шифрование.",
            ),
            "example-text-7" => array(
                "en" => "",
                "rus" => "Окно поля (список)",
            ),
            "p14" => array(
                "en" => "",
                "rus" => "Добавьте учетную запись, двойным кликом сразу можно перейти к полям. Не забудьте нажать ".
                    "<span class='ex-conf'>кнопку Обновить</span> чтоб перезаргузить таблицу в главном окне",
            ),
            "example-text-8" => array(
                "en" => "",
                "rus" => "Окно учетные записи",
            ),
        );
        $this->lang_map["jp-craft"] = array(
            "p1" => array(
                "en" => "",
                "rus" => "При авторизации программа читает файл <span class='ex-conf'>jPass.ini</span> из каталога запуска и берет из него соль (обычный GUID), ".
                    "которая прибавляется к введенному паролю, от суммы вычисляется hash, который сравниваeтся с hash в jPass.ini. ".
                    "После создается новая соль и вычисляется новый hash, перезаписывается jPass.ini",
            ),
            "p2" => array(
                "en" => "",
                "rus" => "Введеный при входе в программу МастерПасс хранится в оперативной памяти на время работы программы ".
                    "и используется для ширования и расшифровки полей учетных записей. Расшифрованные пароли хранятся в ".
                    "оперативной памяти в элементах управления при доступах к полю.",
            ),
            "example-text-1" => array(
                "en" => "",
                "rus" => "Пример шифрования слова <span class='ex-conf'>silver</span> на МастерПасс <span class='ex-conf'>123</span>",
            ),
            "p3" => array(
                "en" => "",
                "rus" => "Принцип шифрования данных учетных записей основан на ".
                    "<a href='https://gist.github.com/Echo-Peak/b93ed94c48048a7041215d4a3f4ad0a2' title='отрывок с github'>этом примере</a>. ".
                    "В программе он реализуется в одном месте, может быть легко дополнен новыми опциями.</p>".
                    "<strong>Я не являюсь специалистом по алгоритмам шифрования или сбора метаданных, ".
                    "каких то способов вытащить пароли мне неизвестны, но это не значит что их не существует.</strong>",
            ),
            "p4" => array(
                "en" => "",
                "rus" => "Папка с данными программы задается в <span class='ex-conf'>jPass.ini</span> по умолчанию ".
                    "<span class='ex-conf'>C:\Users\CurrentUser\Documents\jPass_data</span> содержит файлы пользователя ".
                    "для групп, категорий, списка полей и учетных записей. ".
                    "Папка <span class='ex-conf'>accounts</span> предназначена для хранения полей учетных записей.",
            ),
            "example-text-2" => array(
                "en" => "",
                "rus" => "Папка с пользовательскими данными",
            ),
            "p5" => array(
                "en" => "",
                "rus" => "<strong>Для применения изменений файл accounts.jpass каждый раз перезаписывается целиком. Для теста использовал 25 учеток, ".
                    "но думаю не будет никаких проблем с большим количеством, однако это не база данных для хранения тысяч паролей.</strong>",
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
        $this->prod_feedback();
    }

    function prod_feedback()
    {
        echo "<div class='contentBlock-frame'><div class='contentBlock-center'>".
            "<div class='contentBlock-wrap'>".
            "<section style='margin-bottom: 4em'>".
            "<h2 id='product-feedback'>".$this->lang_map["product-info"]["h2_feedback"][$_SESSION["lang"]]."</h2>".
            "<p>".$this->lang_map["jp-feedback"]["p1"][$_SESSION["lang"]]." <span class='ex-conf'>rightjoint@yandex.ru</span>".
            "</p>".
            "</section>".
            "</div></div></div>";
    }

    function prod_downloads()
    {
        echo "<div class='contentBlock-frame'><div class='contentBlock-center'>".
            "<div class='contentBlock-wrap'>".
            "<section>".
            "<h2 id='product-downloads'>".$this->lang_map["product-info"]["h2_dwl"][$_SESSION["lang"]]."</h2>".
            "<p>".
            "<a class='dwl-img-link' href='/downloads/jointPass.zip' title='".$this->lang_map["jp-dwl"]["a_title"][$_SESSION["lang"]]." jointPass.zip'>".
            "<img src='/img/popimg/jointPass.png'>jointPass.zip".
            "</a>".
            " ".$this->lang_map["jp-dwl"]["p1_txt1"][$_SESSION["lang"]]." <span class='ex-conf'>jointPass.exe</span>. ".
            $this->lang_map["jp-dwl"]["p1_txt2"][$_SESSION["lang"]].
            "</p>".
            "<p>".$this->lang_map["jp-dwl"]["p2"][$_SESSION["lang"]]." <strong>cd4bbe9c5088226f9e781199d8c301cd</strong>".
            "</p>".
            "<div class='example'>".
            "<div class='example-code'>".
            "CertUtil -hashfile jointPass.exe MD5".
            "</div>".
            "<div class='example-code'>".
            "Хэш MD5 : jointPass.exe: cd4bbe9c5088226f9e781199d8c301cd".
            "</div>".
            "<div class='example-text'>".
            $this->lang_map["jp-dwl"]["ex-text1"][$_SESSION["lang"]].
            "</div>".
            "</div>".
            "</p>".
            "<p>".$this->lang_map["jp-dwl"]["p3"][$_SESSION["lang"]]."</p>".
            "<div class='example'>".
            "<div class='example-code'>".
            "git clone https://github.com/rightJoint/jointpass".
            "</div>".
            "<div class='example-code'>".
            "git checkout main".
            "</div>".
            "<div class='example-text'>".
            $this->lang_map["jp-dwl"]["ex-text2"][$_SESSION["lang"]].
            "</div>".
            "</div>".
            "</section>".
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
            "<p>".$this->lang_map["jp-gui"]["p1"][$_SESSION["lang"]]."</p>".
            "<p>".$this->lang_map["jp-gui"]["p2"][$_SESSION["lang"]]."</p>".
            "<div class='example'>".
            "<div class='example-img'>".
            "<img src='/img/Products/jp-signup_".$_SESSION["lang"].".png'>".
            "</div>".
            "<div class='example-text'>".
            $this->lang_map["jp-gui"]["example-text-1"][$_SESSION["lang"]].
            "</div>".
            "</div>".
            "<p>".
            $this->lang_map["jp-gui"]["p3"][$_SESSION["lang"]].
            "</p>".
            "<p>".
            $this->lang_map["jp-gui"]["p4"][$_SESSION["lang"]].
            "</p>".
            "<div class='example'>".
            "<div class='example-img'>".
            "<img src='/img/Products/jp-change-pass_".$_SESSION["lang"].".png'>".
            "</div>".
            "<div class='example-text'>".
            $this->lang_map["jp-gui"]["example-text-2"][$_SESSION["lang"]].
            "</div>".
            "</div>".
            "<p>".
            $this->lang_map["jp-gui"]["p5"][$_SESSION["lang"]].
            "</p>".
            "<div class='example'>".
            "<div class='example-img'>".
            "<img src='/img/Products/jp-mainWin_".$_SESSION["lang"].".png'>".
            "</div>".
            "<div class='example-text'>".
            $this->lang_map["jp-gui"]["example-text-3"][$_SESSION["lang"]].
            "</div>".
            "</div>".
            "<p>".
            $this->lang_map["jp-gui"]["p6"][$_SESSION["lang"]].
            "</p>".
            "<p>".
            $this->lang_map["jp-gui"]["p7"][$_SESSION["lang"]].
            "</p>".
            "<p>".
            $this->lang_map["jp-gui"]["p8"][$_SESSION["lang"]].
            "</p>".
            "<p>".
            $this->lang_map["jp-gui"]["p9"][$_SESSION["lang"]].
            "</p>".
            "<div class='example'>".
            "<div class='example-img'>".
            "<img src='/img/Products/jp-accFields_".$_SESSION["lang"].".png'>".
            "</div>".
            "<div class='example-text'>".
            $this->lang_map["jp-gui"]["example-text-4"][$_SESSION["lang"]].
            "</div>".
            "</div>".
            "<p>".
            $this->lang_map["jp-gui"]["p10"][$_SESSION["lang"]].
            "<p>".
            $this->lang_map["jp-gui"]["p11"][$_SESSION["lang"]].
            "</p>".
            "<div class='example'>".
            "<div class='example-img'>".
            "<img src='/img/Products/jp-group_".$_SESSION["lang"].".png'>".
            "</div>".
            "<div class='example-text'>".
            $this->lang_map["jp-gui"]["example-text-5"][$_SESSION["lang"]].
            "</div>".
            "</div>".
            "<p>".
            $this->lang_map["jp-gui"]["p12"][$_SESSION["lang"]].
            "</p>".
            "<div class='example'>".
            "<div class='example-img'>".
            "<img src='/img/Products/jp-cat_".$_SESSION["lang"].".png'>".
            "</div>".
            "<div class='example-text'>".
            $this->lang_map["jp-gui"]["example-text-6"][$_SESSION["lang"]].
            "</div>".
            "</div>".
            "<p>".
            $this->lang_map["jp-gui"]["p13"][$_SESSION["lang"]].
            "</p>".
            "<div class='example'>".
            "<div class='example-img'>".
            "<img src='/img/Products/jp-fields_".$_SESSION["lang"].".png'>".
            "</div>".
            "<div class='example-text'>".
            $this->lang_map["jp-gui"]["example-text-7"][$_SESSION["lang"]].
            "</div>".
            "</div>".
            "<p>".
            $this->lang_map["jp-gui"]["p14"][$_SESSION["lang"]].
            "</p>".
            "<div class='example'>".
            "<div class='example-img'>".
            "<img src='/img/Products/jp-acc_".$_SESSION["lang"].".png'>".
            "</div>".
            "<div class='example-text'>".
            $this->lang_map["jp-gui"]["example-text-8"][$_SESSION["lang"]].
            "</div>".
            "</div>";
    }

    function prod_craft()
    {
        echo "<div class='contentBlock-frame'><div class='contentBlock-center'>".
            "<div class='contentBlock-wrap'>".
            "<section class='prod-deploy'>".
            "<h2 id='product-craft'>".$this->lang_map["product-info"]["h2_craft"][$_SESSION["lang"]]."</h2>".
            "<p>".
            $this->lang_map["jp-craft"]["p1"][$_SESSION["lang"]].
            "</p>".
            "<p>".
            $this->lang_map["jp-craft"]["p2"][$_SESSION["lang"]].
            "</p>".
            "<div class='example'>".
            "<div class='example-code'>".
            "4O5VjnGixFORFSNfwfZwSl+LDrkF3C98EiaY87EweKN7bKSSv3ER6U8rq03yx8rwsCCK5DrP6yrR0ED6oVttrlotC8Cqu4E4I8MCQqxwDu61U4PE/sOUrNkI9SSrAzqj".
            "</div>".
            "<div class='example-text'>".
            $this->lang_map["jp-craft"]["example-text-1"][$_SESSION["lang"]].
            "</div>".
            "</div>".
            "<p>".
            $this->lang_map["jp-craft"]["p3"][$_SESSION["lang"]].
            "<p>".
            $this->lang_map["jp-craft"]["p4"][$_SESSION["lang"]].
            "</p>".
            "<div class='example'>".
            "<div class='example-img'>".
            "<img src='/img/Products/jp-dataFolder.png'>".
            "</div>".
            "<div class='example-text'>".
            $this->lang_map["jp-craft"]["example-text-2"][$_SESSION["lang"]].
            "</div>".
            "</div>".
            "<p>".
            $this->lang_map["jp-craft"]["p5"][$_SESSION["lang"]].
            "</p>".
            "</section>".
            "</div></div></div>";
    }

    function prod_about()
    {
        echo "<div class='contentBlock-frame'><div class='contentBlock-center'>".
            "<div class='contentBlock-wrap'>".
            "<section class='prod-about'>".
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
            "<h2>".$this->lang_map["product-info"]["h2_сontent"][$_SESSION["lang"]]."</h2>".
            "<ul>".
            "<li><a href='#product-downloads'>".$this->lang_map["product-info"]["h2_dwl"][$_SESSION["lang"]]."</a></li>".
            "<li><a href='#product-info'>".$this->lang_map["product-info"]["h2_common"][$_SESSION["lang"]]."</a></li>".
            "<li><a href='#product-craft'>".$this->lang_map["product-info"]["h2_craft"][$_SESSION["lang"]]."</a></li>".
            "<li><a href='#product-feedback'>".$this->lang_map["product-info"]["h2_feedback"][$_SESSION["lang"]]."</a></li>".
            "</ul>".
            "</section>".
            "</div></div></div>";
    }
}