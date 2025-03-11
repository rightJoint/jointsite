<?php


namespace Src\Views\Blog\IT;


trait SkillsTableTrait
{
    public static function skillsTable():string
    {
        return
        '<table class="skills">'.
        '<tr>'.
        '<td class="skill skill-cap">Навык</td>'.
        '<td class="option skill-cap">Описание</td>'.
        '<td class="level skill-cap">Мой уровень</td>'.
        '</tr>'.
        self::skillsPhp().
        self::skillsHtml().
        self::skillsJavaScript().
        self::skillsDatabase().
        self::skillsOtherDb().
        self::skillsShell().
        self::skillsVsc().
        self::skillsCache().
        self::skillsDocker().
        self::skillsOwasp().
        self::skillsTest().
        self::skillsQueue().
        self::skillsMethods().
        self::skillsOther().
        self::skillsHb().
        '</table>';
    }

    public static function skillsLegendTable():string
    {
        return '<div class="s-legend">'.
            '<table class="skill-legend">'.
            '<tr><td class="c-level">Уровень</td><td class="c-descr">Детали</td></tr>'.
            '<tr>'.
            '<td class="pretty-good">Довольно хорош</td>'.
            '<td class="l-descr">'.
            'Хорошо знаком с технологией и ее возможностями, '.
            'имеется многолетний опыт работы и знание особенностей применения'.
            '</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="competitive">'.
            'Конкурентный'.
            '</td>'.
            '<td class="l-descr">Базовый теоретический опыт с инструментами/технологией. '.
            'Практические навыки применения для большинства задач. '.
            'Предыдущий опыт и интуиция позволяют быстро находить решение проблем в сложных случаях</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="junior">Начальный</td>'.
            '<td class="l-descr">Начальный теоретический уровень или небольшой практический опыт. Необходимо погружаться '.
            'в работу с документацией, сделать несколько тестовых примеров, перед тем как применять на рабочих задачах</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="surficial">Поверхностный</td>'.
            '<td class="l-descr">Поверхностные знания о технологии и ее возможностях</td>'.
            '</tr>'.
            '</table>'.
            '</div>';
    }

    public static function skillsPhp():string
    {
        return '<td rowspan="15" class="skill">php</td>'.
            '<td class="option pretty-good">Конструкции: циклы, суперглобальные, рекурсия, регулярные выражения, анонимные функции, парсинг и т.п.</td>'.
            '<td class="level">использовал на каждом проекте, опыт использования на других языках программирования.</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option competitive">принципы ООП и SOLID, интерфейсы, трейты, абстрактные классы</td>'.
            '<td class="level">Я хорошо в этом разбираюсь. Есть опыт код-верью, опыт работы с legacy-кодом</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option competitive">Паттерны, MVC</td>'.
            '<td class="level">я глубоко не изучал все паттерны, но самый популярный MVC использовал на каждом проекте</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option competitive">Современная версия 8+</td>'.
            '<td class="level">10 лет назад я начинал с версии 5.6, на рабочих проектах мне встречались 7-е версии, '.
            'сейчас в своих проектах использую 8+</td>'.
            '</tr>'.
            '<tr>'.
            '<tr>'.
            '<td class="option competitive">REST JSON, XML</td>'.
            '<td class="level">У меня есть опыт создания REST API, обычно все приложения его поддерживают, включая мой pet-проект. '.
            'С api xml не работал, использовал формат для настройки php composer и sitemap</td>'.
            '</tr>'.
            '<tr>'.
            '<tr>'.
            '<td class="option competitive">API, интеграция со сторонними сервисами</td>'.
            '<td class="level">Я часто сталкивался с задачами по разработке и настройке интеграции приложений с множеством сторонних сервисов: sber pay, yoomoney, yandex map, '.
            'социальные сети, кладр и многие другие</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option competitive">PSR-стандарты, composer</td>'.
            '<td class="level">'.
            'composer я начал использовать только на pet-проекте с применения psr-4, который не поддерживали рабочие проекты. '.
            'В своей работе я руководствуюсь стандартами и применяю многие из интерфесов php-fig'.
            '</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option junior">Фрэймворки: Laravel, Symfony, Yii, Birtix, ModX, WordPress</td>'.
            '<td class="level">'.
            '<b>Laravel</b>: пробовал следовать документации и установить проек с herd панелью.</br>'.
            '<b>Birtix</b>: настраивал тестовые стенды интернет-магазинов и git-репозитории. Добавлял '.
            'формы, скрипты, настривал умный фильтр и т.п.</br>'.
            '<b>Yii2</b>: участвовал в написании rest-api. Делал миграции, action и т.п.'.
            '<p>С остальными фрэймворками я знаком поверхностно.</p>'.
            '</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option competitive">Unit-тесты</td>'.
            '<td class="level">Я нахожу применение unit-тестам на своем pet-проекте и '.
            'близок с php-uint. На рабочих проектах большинство заказчиков принебрегали тестами, но я '.
            'считаю что это не правильно и для себя так не делаю.</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option competitive">Debugging</td>'.
            '<td class="level">я пробовал успешно применять xDebug с phpStorm и Docker. '.
            'Мне иногда приходилось искать ошибки на рабочих проектах.</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option competitive">ORM</td>'.
            '<td class="level">'.
            'Некоторые рабочие проекты поддерживали свою ORM и я использовал возможности '.
            'для рабочих задач. С Eloquent, Doctrine знаком поверхностно</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option competitive">Консоль</td>'.
            '<td class="level">Мне приходилось писать php-скрипты для консоли, '.
            'не только unit-тесты</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option competitive">Программы: phpStorm, VSCode, Postman</td>'.
            '<td class="level">Я уверенно владею основными средствами разработки, моя любимая ide PhpStorm</td>'.
            '</tr>';
    }

    public static function skillsHtml():string
    {
        return '<tr>'.
            '<td rowspan="2" class="skill">html, css</td>'.
            '<td class="option competitive">html DOM: заголовки, код ответа, документ, линки, разметка тэгами и прочее</td>'.
            '<td class="level">Использовалось на каждом проекте, обычно моего опыта достаточно для пешения большинства задач</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option competitive">css, адаптивная верстка, Bootstrap </td>'.
            '<td class="level">У меня есть опыт отзывчивой верстки под разные разрешения, ориентации и viewport, '.
            'обычно с помощью медиа-тегов в css-файлах</td>'.
            '</tr>';
    }

    public static function skillsJavaScript():string
    {
        return '<tr>'.
            '<td rowspan="6" class="skill">JavaScript</td>'.
            '<td class="option competitive">Конструкции: </td>'.
            '<td class="level">Знаком с основыными конструкциями и их примением</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option competitive">Jquery, Ajax</td>'.
            '<td class="level">Применял на каждом проекте</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option junior">ООП в JS</td>'.
            '<td class="level">Пока я мало интересовался как устроено наследование или полиморфизм в js</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option junior">Фрэймворки React, Vue.js, TypeScript, Nuxt.js, Angular</td>'.
            '<td class="level">Знаком немного в теории, пока не использовал на практике, но есть к этому интерес</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option junior">ES-6</td>'.
            '<td class="level">Пока я мало интересовался js стандартами</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option junior">node.js npm</td>'.
            '<td class="level">Не пробовал, но кое-что читал, знаком поверхностно</td>'.
            '</tr>';
    }

    public static function skillsDatabase():string
    {
        return '<tr>'.
            '<td rowspan="11" class="skill">Реляционные базы данных</td>'.
            '<td class="option competitive">mySql, MariaDb</td>'.
            '<td class="level">Использовал на рабочих и pet-проектах</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option competitive">MsSql</td>'.
            '<td class="level">Использовал на одном рабочем проекте и на тестовых заданиях</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option junior">PostgreSql, Oracle</td>'.
            '<td class="level">Я читал об этих БД, но пока не приходилось работать с ними</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option pretty-good">Запросы</td>'.
            '<td class="level">Я довольно хорошо умею составлять сложные sql-запросы с агрегационными функциями для '.
            'реализации безнес-логики</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option competitive">Нормализация, денормализация, ключи, индексы, схема данных</td>'.
            '<td class="level">Мне часто приходилось добавлять/изменять таблицы в базе данных, '.
            'настраивать первичные ключи и связывать таблицы внешними ключами. С оптимизацией запросов я '.
            'знаком в меньшей степени, но есть понимание плана запроса и как это работает.</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option competitive">Отчеты</td>'.
            '<td class="level">Иногда мне приходилось создавать/изменять отчеты в базе даннх</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option junior">Оконные функции</td>'.
            '<td class="level">На практике я почти не стакливался с этим</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option competitive">Процедуры, триггры, блокировки</td>'.
            '<td class="level">Иногда рабочие задачи касались и таких вещей, но на практике не часто</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option junior">Транзакции, TSQL</td>'.
            '<td class="level">В теории я имею представление об атомарности, консистентности, проблем параллельного доступа и '.
            'уровнях изоляции транзакций, но на практике пока не использовал транзакции</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option junior">Репликации</td>'.
            '<td class="level">Начальные знания о способах репликации и RAID</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option junior">Шардирование</td>'.
            '<td class="level">Начальные знания, немного касался вопроса по elasticsearch</td>'.
            '</tr>';
    }

    public static function skillsOtherDb():string
    {
        return '<tr>'.
            '<td rowspan="1" class="skill">Не реляционные базы данных</td>'.
            '<td class="option junior">ClickHouse, MonogoDb</td>'.
            '<td class="level">Немного читал об этом, пока не использовал</td>'.
            '</tr>';
    }

    public static function skillsShell():string
    {
        return '<tr>'.
            '<td rowspan="2" class="skill">Shell linux, windows</td>'.
            '<td class="option competitive">Умения рабоать с командной стройкой, проверить службы, порты и т.п., использовать ssh putty, sftp</td>'.
            '<td class="level">Я часто использую консоль на windows, linux, в Docker</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option competitive">Умение прочитать логи, настрить конфги</td>'.
            '<td class="level">Мне часто приходилось разбираться в настройках конфигураций различных серверных и не только программ</td>'.
            '</tr>';
    }

    public static function skillsVsc():string
    {
        return '<tr>'.
            '<td rowspan="2" class="skill">Git</td>'.
            '<td class="option competitive">Работа с репозиториями, ветками, комитами, решение конфликтов и т.п.</td>'.
            '<td class="level">Я довольно близко знаком с git, использовал на рабочих и pet-проектах</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option competitive">Настройка Workflow, PullRequest и т.п.</td>'.
            '<td class="level">Мне приходилось настраивать git для командной работы и автоматизировать ci/cd на pet-проекте</td>'.
            '</tr>';
    }

    public static function skillsCache():string
    {
        return '<tr>'.
            '<td rowspan="2" class="skill">Кэш (высоконагруженные системы)</td>'.
            '<td class="option junior">Redis</td>'.
            '<td class="level">'.
            'Я сталкивалися с установкой Redis применительно к задачам по Ansible, '.
            'немного знаком в теории как использовать для хранения ключей/списков и т.п.</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option junior">Memcache</td>'.
            '<td class="level">Начальные теоретические знания</td>'.
            '</tr>';
    }

    public static function skillsDocker():string
    {
        return '<tr>'.
            '<td rowspan="2" class="skill">Docker</td>'.
            '<td class="option competitive">Сборка</td>'.
            '<td class="level">'.
            'У меня есть опыт сборки приложения в docker, настройки docker-файла на pet-проекте'.
            '</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option junior">Микросервисы</td>'.
            '<td class="level">Я вплотную подошел к микросервисам на pet-проекте и настройки сети между контейнерами в docker, '.
            'имею представление о kubernetes</td>'.
            '</tr>';
    }

    public static function skillsOwasp():string
    {
        return '<tr>'.
            '<td rowspan="1" class="skill">OWASP</td>'.
            '<td class="option competitive">Безопасность web-приложений</td>'.
            '<td class="level">Базовые знания и практические уменя в части безопасности web-приложений и способов защиты от атак</td>'.
            '</tr>';
    }

    public static function skillsTest():string
    {
        return '<tr>'.
            '<td rowspan="3" class="skill">тесты</td>'.
            '<td class="option competitive">юнит-тесты</td>'.
            '<td class="level">Мой уровень</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option junior">интеграционные тесты</td>'.
            '<td class="level">Мой уровень</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option junior">Регресс</td>'.
            '<td class="level">Мой уровень</td>'.
            '</tr>';
    }

    public static function skillsQueue():string
    {
        return '<tr>'.
            '<td rowspan="2" class="skill">Брокеры очередей</td>'.
            '<td class="option junior">Kafka</td>'.
            '<td class="level" rowspan="2">Вообще мне часто приходилось иметь дело с обменом сообщениями с различными сервисами с '.
            'помощью очередей, и по опыту в этом есть много тонких моментов. Именно с Rabbit и Kafka я не работал</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option junior">Rabbit Mq</td>'.
            '</tr>';
    }

    public static function skillsMethods():string
    {
        return '<tr>'.
            '<td rowspan="5" class="skill">Методологии</td>'.
            '<td class="option competitive">Scrum</td>'.
            '<td class="level">На последнем месте я работал в небольшой команде по Scrum и 4-х недельным спринтам</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option junior" >Kanban</td>'.
            '<td class="level" rowspan="3">Немного читал об этом</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option junior">Aglie</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option junior">Lean</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option competitive">TTD</td>'.
            '<td class="level">Иногда я считаю такую методолгию полезной и и сначала пишу тест</td>'.
            '</tr>';
    }

    public static function skillsHb():string
    {
        return '<tr>'.
            '<td rowspan="1" class="skill">Процессы</td>'.
            '<td class="option competitive">Swagger, Confluence, Jira</td>'.
            '<td class="level">У меня есть опыт работы по задачам и учету рабочего времени в Jira, '.
            'ведении документации по проекту в Confluence</td>'.
            '</tr>';
    }

    public static function skillsOther():string
    {
        return '<tr>'.
            '<td rowspan="5" class="skill">Прочие</td>'.
            '<td class="option competitive">Ansible</td>'.
            '<td class="level">Успешный опыт настройки стенда Ansible и передова cron-задач с распределенных серверов</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option competitive">Elasticsearch</td>'.
            '<td class="level">Успешный опыт установка и настройка сборщиков логов filebeat, pipelines logstash, '.
            'rollover lifecycle policy</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option junior">Web-Sockets</td>'.
            '<td class="level">Начальные теоретические знания о технологии и ее возможностях</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option junior">TelegramBot</td>'.
            '<td class="level" rowspan="2">Поверхностные знания</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option junior">BlockChain</td>'.
            '</tr>';
    }
}