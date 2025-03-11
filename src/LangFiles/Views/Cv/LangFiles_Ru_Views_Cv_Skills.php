<?php
class LangFiles_Ru_Views_Cv_Skills extends LangFiles_Ru_Views_Cv_Main
{
    static public function getLangHead():stdClass
    {
        $langHead = parent::getLangHead();

        $langHead->description = 'Оченка собственных профессиональных навыков, которые чаще всего требуют в описаниях к вакансиям';
        $langHead->title = 'Резюме - профессиональные навыки';

        return $langHead;
    }
    static public function getLangHeader():stdClass
    {
        $langHeader = parent::getLangHeader();
        $langHeader->h1 = 'Резюме - профессиональные навыки';
        return $langHeader;
    }

    public static function cvContent(): stdClass
    {
        $langCvContent = new \stdClass();
        $langCvContent->langCvSkills = self::cvSkillsTexts();
        $langCvContent->langSkillsLegend = self::langSkillsLegend();
        $langCvContent->langSkillsTable = self::langSkillsTable();


        return $langCvContent;
    }

    public static function cvSkillsTexts(): stdClass
    {
        $langCvSkills = new \stdClass();
        $langCvSkills->h3 = 'Профессиональные навыки';
        $langCvSkills->p1 = 'Заказчику часто требуется чтоб сотрудник умел работать сразу с несколькими '.
            'инструментами/технологиями. Но сейчас стек настолько широк что на получение глубокого '.
            'практического опыта по всем технологиями потребуются десятилетия. '.
            'Я составил примерную шкалу для оценки своих навыков.';
        $langCvSkills->p2 = 'Список наиболее востребованных навыков, '.
            'которые часто запрашиваются в описании к вакансиям и свой опыт по ним я '.
            'описал в таблице.';
        return $langCvSkills;
    }

    public static function langSkillsLegend():stdClass
    {
        $tLeg = new \stdClass();
        $trCap = new \stdClass();
        $trCap->level = 'Уровень';
        $trCap->detail = 'Детали';
        $tLeg->trCap = $trCap;

        $tr1 = new \stdClass();
        $tr1->level = 'Довольно хорош';
        $tr1->detail = 'Хорошо знаком с технологией и ее возможностями, '.
            'имеется многолетний опыт работы и знание особенностей применения';
        $tLeg->tr1 = $tr1;

        $tr2 = new \stdClass();
        $tr2->level = 'Конкурентный';
        $tr2->detail = 'Базовый теоретический опыт с инструментами/технологией. '.
            'Практические навыки применения для большинства задач. '.
            'Предыдущий опыт и интуиция позволяют быстро находить решение проблем в сложных случаях';
        $tLeg->tr2 = $tr2;

        $tr3 = new \stdClass();
        $tr3->level = 'Начальный';
        $tr3->detail = 'Начальный теоретический уровень или небольшой практический опыт. Необходимо погружаться '.
            'в работу с документацией, сделать несколько тестовых примеров, перед тем как применять на рабочих задачах';
        $tLeg->tr3 = $tr3;

        $tr4 = new \stdClass();
        $tr4->level = 'Поверхностный';
        $tr4->detail = 'Поверхностные знания о технологии и ее возможностях';
        $tLeg->tr4 = $tr4;

        return $tLeg;
    }

    public static function langSkillsTable():stdClass
    {
        $skillsTable = new \stdClass();


        $tCap = new \stdClass();
        $tCap->skill = 'Навык';
        $tCap->descr = 'Описание';
        $tCap->level = 'Мой уровень';

        $skillsTable->tCap = $tCap;

        $skillsTable->php = self::langSkillsPhp();
        $skillsTable->html = self::langSkillsHtml();
        $skillsTable->js = self::langSkillsJs();
        $skillsTable->relDb = self::langSkillsRelDb();
        $skillsTable->nRelDb = self::langSkillsNRelDb();
        $skillsTable->shell = self::langSkillsShell();
        $skillsTable->vcs = self::langSkillsVcs();
        $skillsTable->cache = self::langSkillsCache();
        $skillsTable->hLoad = self::langSkillsCache();
        $skillsTable->docker = self::langSkillsDocker();
        $skillsTable->owasp = self::langSkillsOwasp();
        $skillsTable->tests = self::langSkillsTests();
        $skillsTable->queue = self::langSkillsQueue();
        $skillsTable->methods = self::langSkillsMethods();
        $skillsTable->hb = self::langSkillsHb();
        $skillsTable->other = self::langSkillsOther();


        return $skillsTable;
    }

    public static function langSkillsPhp():stdClass
    {
        $php = new \stdClass();
        $c2 = new \stdClass();
        $c3 = new \stdClass();

        $c2->c21 = 'Конструкции: циклы, суперглобальные, рекурсия, регулярные выражения, анонимные функции, парсинг и т.п.';
        $c3->c31 = 'использовал на каждом проекте, опыт использования на других языках программирования.';

        $c2->c22 = 'принципы ООП и SOLID, интерфейсы, трейты, абстрактные классы';
        $c3->c32 = 'Я хорошо в этом разбираюсь. Есть опыт код-верью, опыт работы с legacy-кодом';

        $c2->c23 = 'Паттерны, MVC';
        $c3->c33 = 'я глубоко не изучал все паттерны, но самый популярный MVC использовал на каждом проекте';

        $c2->c24 = 'Современная версия 8+';
        $c3->c34 = '10 лет назад я начинал с версии 5.6, на рабочих проектах мне встречались 7-е версии, '.
            'сейчас в своих проектах использую 8+';

        $c2->c25 = 'REST JSON, XML';
        $c3->c35 = 'У меня есть опыт создания REST API, обычно все приложения его поддерживают, включая мой pet-проект. '.
            'С api xml не работал, использовал формат для настройки php composer и sitemap';

        $c2->c26 = 'API, интеграция со сторонними сервисами';
        $c3->c36 = 'Я часто сталкивался с задачами по разработке и настройке интеграции приложений с множеством сторонних сервисов: sber pay, yoomoney, yandex map, '.
            'социальные сети, кладр и многие другие';

        $c2->c27 = 'PSR-стандарты, composer';
        $c3->c37 = 'composer я начал использовать только на pet-проекте с применения psr-4, который не поддерживали рабочие проекты. '.
            'В своей работе я руководствуюсь стандартами и применяю многие из интерфесов php-fig';

        $c2->c28 = 'Фрэймворки: Laravel, Symfony, Yii, Birtix, ModX, WordPress';
        $c3->c38 = '<b>Laravel</b>: пробовал следовать документации и установить проек с herd панелью.</br>'.
            '<b>Birtix</b>: настраивал тестовые стенды интернет-магазинов и git-репозитории. Добавлял '.
            'формы, скрипты, настривал умный фильтр и т.п.</br>'.
            '<b>Yii2</b>: участвовал в написании rest-api. Делал миграции, action и т.п.'.
            '<p>С остальными фрэймворками я знаком поверхностно.</p>';

        $c2->c29 = 'Unit-тесты';
        $c3->c39 = 'Я нахожу применение unit-тестам на своем pet-проекте и '.
            'близок с php-uint. На рабочих проектах большинство заказчиков принебрегали тестами, но я '.
            'считаю что это не правильно и для себя так не делаю.';

        $c2->c210 = 'Debugging';
        $c3->c310 = 'я пробовал успешно применять xDebug с phpStorm и Docker. '.
            'Мне иногда приходилось искать ошибки на рабочих проектах.';

        $c2->c211 = 'ORM';
        $c3->c311 = 'Некоторые рабочие проекты поддерживали свою ORM и я использовал возможности '.
            'для рабочих задач. С Eloquent, Doctrine знаком поверхностно';

        $c2->c212 = 'Консоль';
        $c3->c312 = 'Мне приходилось писать php-скрипты для консоли, '.
            'не только unit-тесты';

        $c2->c213 = 'Программы: phpStorm, VSCode, Postman';
        $c3->c313 = 'Я уверенно владею основными средствами разработки, моя любимая ide PhpStorm';

        $php->c2 = $c2;
        $php->c3 = $c3;

        return $php;
    }

    public static function langSkillsHtml():stdClass
    {
        $html = new \stdClass();

        $c2 = new \stdClass();
        $c3 = new \stdClass();

        $c2->c21 = 'html DOM: заголовки, код ответа, документ, линки, разметка тэгами и прочее';
        $c3->c31 = 'Использовалось на каждом проекте, обычно моего опыта достаточно для пешения большинства задач';

        $c2->c22 = 'css, адаптивная верстка, bootstrap';
        $c3->c32 = 'У меня есть опыт отзывчивой верстки под разные разрешения, ориентации и viewport, '.
            'обычно с помощью медиа-тегов в css-файлах';

        $html->c2 = $c2;
        $html->c3 = $c3;

        return $html;
    }

    public static function langSkillsJs():stdClass
    {
        $js = new \stdClass();

        $c2 = new \stdClass();
        $c3 = new \stdClass();

        $c2->c21 = 'Конструкции';
        $c3->c31 = 'Знаком с основыными конструкциями и их примением';

        $c2->c22 = 'Jquery, Ajax';
        $c3->c32 = 'Применял на каждом проекте';

        $c2->c23 = 'ООП в JS';
        $c3->c33 = 'Пока я мало интересовался как устроено наследование или полиморфизм в js';

        $c2->c24 = 'Фрэймворки React, Vue.js, TypeScript, Nuxt.js, Angular';
        $c3->c34 = 'Знаком немного в теории, пока не использовал на практике, но есть к этому интерес';

        $c2->c25 = 'ES-6';
        $c3->c35 = 'Пока я мало интересовался js стандартами';

        $c2->c26 = 'node.js npm';
        $c3->c36 = 'Не пробовал, но кое-что читал, знаком поверхностно';

        $js->c2 = $c2;
        $js->c3 = $c3;

        return $js;
    }

    public static function langSkillsRelDb():stdClass
    {
        $relDb = new \stdClass();

        $c2 = new \stdClass();
        $c3 = new \stdClass();

        $c2->c21 = 'mySql, MariaDb';
        $c3->c31 = 'Использовал на рабочих и pet-проектах';

        $c2->c22 = 'MsSql';
        $c3->c32 = 'Использовал на одном рабочем проекте и на тестовых заданиях';

        $c2->c23 = 'PostgreSql, Oracle';
        $c3->c33 = 'Я читал об этих БД, но пока не приходилось работать с ними';

        $c2->c24 = 'Запросы';
        $c3->c34 = 'Я довольно хорошо умею составлять сложные sql-запросы с агрегационными функциями для '.
            'реализации безнес-логики';

        $c2->c25 = 'Нормализация, денормализация, ключи, индексы, схема данных';
        $c3->c35 = 'Мне часто приходилось добавлять/изменять таблицы в базе данных, '.
            'настраивать первичные ключи и связывать таблицы внешними ключами. С оптимизацией запросов я '.
            'знаком в меньшей степени, но есть понимание плана запроса и как это работает.';

        $c2->c26 = 'Отчеты';
        $c3->c36 = 'Иногда мне приходилось создавать/изменять отчеты в базе даннх';

        $c2->c27 = 'Оконные функции';
        $c3->c37 = 'На практике я почти не стакливался с этим';

        $c2->c28 = 'Процедуры, триггры, блокировки';
        $c3->c38 = 'Иногда рабочие задачи касались и таких вещей, но на практике не часто';

        $c2->c29 = 'Транзакции, T-SQL';
        $c3->c39 = 'В теории я имею представление об атомарности, консистентности, проблем параллельного доступа и '.
            'уровнях изоляции транзакций, но на практике пока не использовал транзакции';

        $c2->c210 = 'Репликации';
        $c3->c310 = 'Начальные знания о способах репликации и RAID';

        $c2->c211 = 'Шардирование';
        $c3->c311 = 'Начальные знания, немного касался вопроса по elasticsearch';

        $relDb->c1 = 'Реляционные базы данных';
        $relDb->c2 = $c2;
        $relDb->c3 = $c3;

        return $relDb;
    }

    public static function langSkillsNRelDb():stdClass
    {
        $nRelDb = new \stdClass();

        $c2 = new \stdClass();
        $c3 = new \stdClass();

        $c2->c21 = 'ClickHouse, MonogoDb';
        $c3->c31 = 'Немного читал об этом, пока не использовал';

        $nRelDb->c1 = 'Не реляционные базы данных';
        $nRelDb->c2 = $c2;
        $nRelDb->c3 = $c3;

        return $nRelDb;
    }

    public static function langSkillsShell():stdClass
    {
        $shell = new \stdClass();

        $c2 = new \stdClass();
        $c3 = new \stdClass();

        $c2->c21 = 'Умения рабоать с командной стройкой, проверить службы, порты и т.п., использовать ssh putty, sftp';
        $c3->c31 = 'Я часто использую консоль на windows, linux, в Docker';

        $c2->c22 = 'Умение прочитать логи, настрить конфги';
        $c3->c32 = 'Мне часто приходилось разбираться в настройках конфигураций различных серверных и не только программ';

        $shell->c1 = 'Shell linux, windows';
        $shell->c2 = $c2;
        $shell->c3 = $c3;

        return $shell;
    }

    public static function langSkillsVcs():stdClass
    {
        $vsc = new \stdClass();

        $c2 = new \stdClass();
        $c3 = new \stdClass();

        $c2->c21 = 'Работа с репозиториями, ветками, комитами, решение конфликтов и т.п.';
        $c3->c31 = 'Я довольно близко знаком с git, использовал на рабочих и pet-проектах';

        $c2->c22 = 'Настройка Workflow, PullRequest и т.п.';
        $c3->c32 = 'Мне приходилось настраивать git для командной работы и автоматизировать ci/cd на pet-проекте';

        $vsc->c1 = 'Git';
        $vsc->c2 = $c2;
        $vsc->c3 = $c3;

        return $vsc;
    }

    public static function langSkillsCache():stdClass
    {
        $hLoad = new \stdClass();

        $c2 = new \stdClass();
        $c3 = new \stdClass();

        $c2->c21 = 'Redis';
        $c3->c31 = 'Я сталкивалися с установкой Redis применительно к задачам по Ansible, '.
            'немного знаком в теории как использовать для хранения ключей/списков и т.п.';

        $c2->c22 = 'Memcache';
        $c3->c32 = 'Начальные теоретические знания';

        $hLoad->c1 = 'Кэш (высоконагруженные системы)';
        $hLoad->c2 = $c2;
        $hLoad->c3 = $c3;

        return $hLoad;
    }

    public static function langSkillsDocker():stdClass
    {
        $docker = new \stdClass();

        $c2 = new \stdClass();
        $c3 = new \stdClass();

        $c2->c21 = 'Сборка';
        $c3->c31 = 'У меня есть опыт сборки приложения в docker, настройки docker-файла на pet-проекте';

        $c2->c22 = 'Микросервисы';
        $c3->c32 = 'Я вплотную подошел к микросервисам на pet-проекте и настройки сети между контейнерами в docker, '.
            'имею представление о kubernetes';

        $docker->c1 = 'Docker';
        $docker->c2 = $c2;
        $docker->c3 = $c3;

        return $docker;
    }

    public static function langSkillsOwasp():stdClass
    {
        $owasp = new \stdClass();

        $owasp->c2 = 'Безопасность web-приложений';
        $owasp->c3 = 'Базовые знания и практические уменя в части безопасности web-приложений и способов защиты от атак';

        return $owasp;
    }

    public static function langSkillsTests():stdClass
    {

        $test = new \stdClass();

        $c2 = new \stdClass();
        $c3 = new \stdClass();

        $c2->c21 = 'юнит-тесты';
        $c3->c31 = 'к сожалению большинство работодаьелей принебрегают тестами на рабочих проектах, '.
            'но я нахожу выгоду от использования unit-тесты на своем pet-проекте';

        $c2->c22 = 'интеграционные тесты';
        $c3->c32 = 'Немного знаком, думаю мог бы освоить без проблем';

        $c2->c23 = 'Регресс';
        $c3->c33 = 'Пока мне писать регресс-тесты не приходилось';

        $test->c1 = 'тесты';
        $test->c2 = $c2;
        $test->c3 = $c3;

        return $test;
    }

    public static function langSkillsQueue():stdClass
    {
        $queue = new \stdClass();

        $queue->c1 = 'Брокеры очередей';
        $queue->c2 = 'Вообще мне часто приходилось иметь дело с обменом сообщениями с различными сервисами с '.
            'помощью очередей, и по опыту в этом есть много тонких моментов. Именно с Rabbit и Kafka я не работал';

        return $queue;
    }

    public static function langSkillsMethods():stdClass
    {
        $methods = new \stdClass();

        $c3 = new \stdClass();

        $c3->c31 = 'На последнем месте я работал в небольшой команде по Scrum и 4-х недельным спринтам';
        $c3->c32 = 'Немного читал об этом';
        $c3->c33 = 'Иногда я считаю такую методолгию полезной и и сначала пишу тест';

        $methods->c1 = 'Методологии';
        $methods->c3 = $c3;

        return $methods;
    }

    public static function langSkillsHb():stdClass
    {
        $hb = new \stdClass();

        $hb->c1 = 'Процессы';
        $hb->c3 = 'У меня есть опыт работы по задачам и учету рабочего времени в Jira, '.
            'ведении документации по проекту в Confluence';

        return $hb;
    }

    public static function langSkillsOther():stdClass
    {
        $other = new \stdClass();

        $c3 = new \stdClass();

        $c3->c31 = 'Успешный опыт настройки стенда Ansible и передова cron-задач с распределенных серверов';
        $c3->c32 = 'Успешный опыт установка и настройка сборщиков логов filebeat, pipelines logstash, '.
            'rollover lifecycle policy';
        $c3->c33 = 'Начальные теоретические знания о технологии и ее возможностях';
        $c3->c34 = 'Поверхностные знания';
        $other->c1 = 'Прочие';
        $other->c3 = $c3;

        return $other;
    }
}
