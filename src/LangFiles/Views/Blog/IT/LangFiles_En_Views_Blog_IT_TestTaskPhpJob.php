<?php
class LangFiles_En_Views_Blog_IT_TestTaskPhpJob extends LangFiles_En_Views_BlogArts
{
    static public function getLangArtContent():\stdClass
    {
        $langArtContent = new stdClass();

        $langArtContent->analysis = self::getLangArtAnalysis();
        $langArtContent->docker = self::getLangArtDocker();
        $langArtContent->scripts = self::getLangArtScripts();
        $langArtContent->additional = self::getLangArtAdditional();

        return $langArtContent;
    }

    static public function getLangArtAnalysis():\stdClass
    {
        $analysis = new stdClass();
        $analysis->h2 = '1. Анализ постановки';
        $analysis->p1 = 'Задание мне было выдано в виде ms-word <a href="/userdata/blog/IT/bookshop_en.txt" title="скачать задание">документа</a> и при
            беглом просмотре показалось довольно обычным, 100% что оно не может нести коммерчекую выгоду тому кто его выдал и
            не очень большое по объему. Попробуем вникнуть в детали, что именно требуется.';
        $analysis->note = 'Прежде чем бросаться выполнять задание, лучше предварительно уточнить все расплывчатые формулировки.
            Так вы поймёте что задание вам было выдано не для того чтоб вы отъеб..ались и
            возможное его решение действительно поможет вам пройти на следующй этап.';
        $analysis->p2 = 'В моем случае обратная связь по вопросам поддреживалась через hr, которая обычно отвечала в течении дня.
            В данном задании было непонятно что следует понимать под суммой, а что под количеством книг (строка 17),
            так же непонятно было что такое mc чтоб включить его в образ (строка 8).';
        $analysis->p3 = 'На уточняющие вопросы я получил следующие ответы:';
        $analysis->li1 = 'сумму книг выводить не надо, только к-во';
        $analysis->li2 = 'внутри категории не может быть другой категории';
        $analysis->li3 = 'mc - это midnight commander';
        $analysis->p4 = 'Ну что же имеем: задание проанализировано, обратная связь установлена, каких-то подвохов незамечено.
            Попробуем выполнить задание.';

        return $analysis;
    }

    static public function getLangArtDocker():\stdClass
    {
        $docker = new stdClass();

        $docker->common = self::getLangArtDockerCommon();
        $docker->mc = self::getLangArtDockerMc();
        $docker->openSsh = self::getLangArtDockerOpenSsh();
        $docker->vh = self::getLangArtDockerVh();

        return $docker;
    }

    static public function getLangArtDockerCommon():\stdClass
    {
        $dockerCommon = new stdClass();

        $dockerCommon->h2 = '2. Сборка образа в docker-контейнере';
        $dockerCommon->p1 = 'Мне не часто приходилось выполнять сборки на Ubuntu, в пояснениях было указано что за основу
            можно взять образ mrxder/docker-apache-php7.2-mysql-phpmyadmin. Так и сделаем.';
        $dockerCommon->p2 = 'Клонируем репозиторий. Пока Dockerfile оставим без изменений, просто проверим как все работает.
            Попробуем собрать образ в docker, выполним следующие команды из каталога с Dockerfile.
            (bookshop-test-1 - имя image, bookshop-c-test-1 - имя контейнера)';
        $dockerCommon->p3 = 'По идее, после этих действий мы должны увидеть страницу входа в phpMyAdmin по адресу localhost:8080/phpmyadmin,
            но что-то пошло не так, попробуем разобраться.';
        $dockerCommon->p4 = 'Обратим внимание что контейнер не запущен. Посмотрим логи, они ведут к файлу rc.local, посмотрим что в нем написано:
            этот файл стартует mysql и apache2.';
        $dockerCommon->p5 = 'Пока закомментим эти строки в Dockerfile и проверим что выйдет. Снова соберем имадже и запустим контейнер.
            В этот раз он остался запущенным, но phpmyadmin по прежнему недоступно. Попробуем запустить mysql и apache2 вручную.';
        $dockerCommon->p6 = 'При ручном запуске серверов страница localhost:8080/phpmyadmin открывается браузером, можно зайти в phpmyadmin с
            теми логин и пароль что даны в описании к репозиторию. Пока оставим решение проблемы с автостартом серверов на потом.
            Продолжим выполнение задания...но помним что пока сервер после остановки контейнера придется запускать вручную.
            Для п.2.1 и 2.2 web все равно пока не потребуется.';
        return $dockerCommon;
    }

    static public function getLangArtDockerMc():\stdClass
    {
        $dockerMc = new stdClass();

        $dockerMc->h3 = '2.1 Устанавливаем midnight commander';
        $dockerMc->p1 = 'Чисто для теста я сначала устанавливал его в запущенном контейнере из командной строки, проверил,
                а после добавил ту же команду в Dockerfile, снова собрал image и запустил контейнер.';
        $dockerMc->p2 = 'Отлично, с этим проблем не возникло, так что двигаемся дальше...';

        return $dockerMc;
    }

    static public function getLangArtDockerOpenSsh():\stdClass
    {
        $openSsh = new stdClass();

        $openSsh->h3 = '2.2 Устанавливаем openssh - сервер';
        $openSsh->p1t1 = 'Немного погуглив я нашел рабочий пример по';
        $openSsh->p1ref = 'ссылке';
        $openSsh->p1t2 = 'Это как раз то, что надо. Добавляем те пять
                строчек из примера в Dockerfile. Но вот просто поменять логин и пароль мы не можем. Нам надо
                сначала создать нового пользователя в системе добавив еще одну строку в Dockerfile.';
        $openSsh->p2 = 'Снова пересобираем имадже, проверяем, незабыв добавить 2222-й порт в команду при запуске контейнера.';
        $openSsh->p3 = 'Пытаемся подключиться с помощью putty с логин admin и пароль trust. Збс, работает!';
        $openSsh->p4 = 'Вспоминаем что в задании написано, хост должен быть доступен по адресу bookshop.loc Так как я использую
                linux docker engine на windows, настроим хост';
        $openSsh->p5 = 'Для этого откроем файл';
        $openSsh->p6 = 'Запустим контейнер, указав при этом название хоста, проверим доступность по ssh. Получилось!';
        return $openSsh;
    }

    static public function getLangArtDockerVh():\stdClass
    {
        $vh = new stdClass();

        $vh->h3 = '2.3 Настраиваем virtual host apache';
        $vh->p1 = 'В репозитории уже была заготовка, 000-default.conf для конфигурации apache и виртуальных хостов,
            ей я и воспользуюсь. Это ясно, что виртуальных хостов может быть несколько. Поправим 000-default.conf,
            поменяем настройку DocumentRoot на /var/www/<b>html</b>/bookshop.loc и добавим в него настройку';
        $vh->p2 = 'А в Dockerfile закоментим строчку и убрав лишние знаки, это нам уже не нужно.';
        $vh->p3 = 'Скопируем папку проекта, дописав команду в Dockerfile, без нее при старте apache выдаст ошибку.';
        $vh->p4 = 'Снова собираем сборку и запускаем контейнер, из контейнера в ручном режиме запускаем mysql и apache,
            проверяем доступность в браузере по адресу http://bookshop.loc:8080/phpmyadmin/ Отлично, все работает,
            значит осталась последняя часть задания.';


        return $vh;
    }
    static public function getLangArtScripts():\stdClass
    {
        $scripts = new stdClass();

        $scripts->h2 = '3. php скрипты и нормализация базы данных';
        $scripts->p = 'Сразу скажу что я не дэбажил в контейнере, делал эту чать отдельно на OpenServer, а потом просто скопировал
            файлы.';

        $scripts->db = self::getLangArtScriptsDb();
        $scripts->php = self::getLangArtScriptsPhp();

        return $scripts;
    }

    static public function getLangArtScriptsDb():\stdClass
    {
        $db = new stdClass();
        $db->h3 = '3-1. Таблицы и связи в базе данных';
        $db->p1 = 'Внимательно посмотрим задание и определим какие таблицы нам потребуются и какие связи между ними мы создадим:';
        $db->li1 = 'books - таблица с книгами, связь с таблицей категории (много к одному)';
        $db->li2 = 'authors - таблица с авторами';
        $db->li3 = 'categories - таблица с категориями';
        $db->li4 = 'bookstoauthors - таблица, связанная с книгами (много к одному) и с авторами (много к одному)';
        $db->p2 = 'Сейчас очень часто на собесах спрашивают про внешние ключи, используем их для автоматического удаления строк
            из таблицы bookstoauthors при удалении строки из authors или books, а также для установки поля books.bookCategory_id
            в NULL при удалении записи из таблицы categories, для этого создадим таблицы ENGINE=InnoDB';
        return $db;
    }

    static public function getLangArtScriptsPhp():\stdClass
    {
        $php = new stdClass();
        $php->h3 = '3-2. php-скрипты';
        $php->p1 = 'С точки зрения php-кода проект довольно простой, в нем не будет наследования, интерфесов и прочих штук.
            Однако оформим весь код классами, для разнообразия сделаем публичные и приватные методы, некоторые методы
            сделаем статическими.';
        $php->p2 = 'По итогу у нас будут следующие скриты:';
        $php->li1 = 'Классы';
        $php->li11 = 'Db.php (класс) extends PDO - для подключения и БД, чтоб не дублировать код в скрипте установки и в отчете';
        $php->li12 = 'BookShopInstall.php (класс) - создание БД, таблиц и заполнения тестовыми данными';
        $php->li13 = 'Report.php (класс) - отчет, один метод реализует логику, а второй представление';
        $php->li2 = '<b>Файлы</b>, буквально 3-5 строчек, в них влючаются классы и вызываются их методы';
        $php->li21 = 'install.php - для  загрузки тестовых данных';
        $php->li22 = 'index.php - для отчета';
        $php->li3 = 'файлы';
        $php->li31 = 'это';
        $php->li32 = 'это для разворачивания списка';
        $php->p3 = 'Собираем имадже, запускаем контейнер';
        $php->p4 = 'Вручную в контейнере запускаем mysql и apache';
        $php->p5 = 'Проверяем http://bookshop.loc:8080/install.php и отчет http://bookshop.loc:8080';
        $php->p6 = 'Похоже, на этом задание выполнено';
        return $php;
    }

    static public function getLangArtAdditional():\stdClass
    {
        $additional = new stdClass();

        $additional->h2 = '4. Дополнительные шаги';
        $additional->p1 = 'Подумаем, что еще хорошо было бы сделать в этом тестовом проекте чтоб он был немного лучше...';

        $additional->h31 = '4.1 Подключаем второй репозиторий к проекту';
        $additional->p2 = 'Я создал на своем аккаунте голый репозиторий https://github.com/rightJoint/test-bookshop в который
            буду отправлять изменения. Может мне придется публиковать эту статью, но давать в ней ссылку на архив как-то
            не очень, куда лучше ссылку на репозиторий. Подключим репозиторий и сделаем push.';
        $additional->p3 = 'Кроме ноута у меня есть ещё micro-pc, подключенный к по hdmi к телеку. На нем и проверим.';
        $additional->h32 = '4.2 Рефакторинг Dockerfile';
        $additional->p4 = 'Можно удалить лишние команды из Dokerfile и лишние файлы из проекта, которые для него сейчас уже не нужны.';
        $additional->h33 ='4.3 Решить проблему с автозапуском';
        $additional->p51 = 'Конечно меня напрягает запускать сервера вручную. Пока я не нашел способа сделать это, гугл выводил меня на
            следующие ресурсы по этому запросу';
        $additional->p52 ='но предложенные там решения мне не помогли.';
        return $additional;
    }
}
