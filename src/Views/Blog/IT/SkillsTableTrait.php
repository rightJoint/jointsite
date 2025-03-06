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
        self::skillsShell().
        self::skillsVsc().
        self::skillsCache().
        self::skillsDocker().
        self::skillsMicroservice().
        self::skillsOwasp().
        self::skillsTest().
        self::skillsQueue().
        self::skillsMethods().
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
            'для рабочих задач. С Eloquent знаком поверхностно</td>'.
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
            '<td class="option">html DOM: заголовки (формат ответа, статус код, ), документ, линки, разметка тэгами и прочее</td>'.
            '<td class="level competitive">Мой уровень</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option">css, адаптивная верстка, Bootstrap </td>'.
            '<td class="level competitive">Мой уровень</td>'.
            '</tr>';
    }

    public static function skillsJavaScript():string
    {
        return '<tr>'.
            '<td rowspan="6" class="skill">JavaScript</td>'.
            '<td class="option">Конструкции: </td>'.
            '<td class="level competitive">Мой уровень</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option">Jquery, Ajax</td>'.
            '<td class="level competitive">Мой уровень</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option">ООП в JS</td>'.
            '<td class="level junior">Мой уровень</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option">Фрэймворки React, Vue.js, TypeScript, Nuxt.js, Angular</td>'.
            '<td class="level junior">Мой уровень</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option">ES-6</td>'.
            '<td class="level junior">Мой уровень</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option">node.js npm</td>'.
            '<td class="level junior">Мой уровень</td>'.
            '</tr>';
    }

    public static function skillsDatabase():string
    {
        return '<tr>'.
            '<td rowspan="12" class="skill">Реляционные базы данных</td>'.
            '<td class="option">mySql, MariaDb</td>'.
            '<td class="level competitive">Мой уровень</td>'.
            '</tr>'.
            '<tr>'.
            //'<td rowspan="2">php</td>'.
            '<td class="option">MsSql</td>'.
            '<td class="level competitive">Мой уровень</td>'.
            '</tr>'.
            '<tr>'.
            //'<td rowspan="2">php</td>'.
            '<td class="option">PostgreSql, Oracle</td>'.
            '<td class="level junior">Мой уровень</td>'.
            '</tr>'.
            '<tr>'.
            //'<td rowspan="2">php</td>'.
            '<td class="option">Запросы</td>'.
            '<td class="level pretty-good">Мой уровень</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option">Нормализация, денормализация</td>'.
            '<td class="level competitive">Мой уровень</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option">Ключи, индексы, схема данных</td>'.
            '<td class="level competitive">Мой уровень</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option">Отчеты</td>'.
            '<td class="level competitive">Мой уровень</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option">Оконные функции</td>'.
            '<td class="level junior">Мой уровень</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option">Процедуры, триггры, блокировки</td>'.
            '<td class="level competitive">Мой уровень</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option">Транзакции, TSQL</td>'.
            '<td class="level junior">Мой уровень</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option">Репликации</td>'.
            '<td class="level junior">Мой уровень</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option">Шардирование</td>'.
            '<td class="level junior">Мой уровень</td>'.
            '</tr>';
    }

    public static function skillsShell():string
    {
        return '<tr>'.
            '<td rowspan="2" class="skill">Shell linux, windows</td>'.
            '<td class="option">Умения рабоать с командной стройкой, проверить службы, порты и т.п., использовать putty, sftp</td>'.
            '<td class="level">Мой уровень</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option">Умение прочитать логи, настрить конфги</td>'.
            '<td class="level">Мой уровень</td>'.
            '</tr>';
    }

    public static function skillsVsc():string
    {
        return '<tr>'.
            '<td rowspan="2" class="skill">Git</td>'.
            '<td class="option">Работа с репозиториями, ветками, комитами, решение конфликтов и т.п.</td>'.
            '<td class="level">Мой уровень</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option">Настройка Workflow, PullRequest и т.п.</td>'.
            '<td class="level">Мой уровень</td>'.
            '</tr>';
    }

    public static function skillsCache():string
    {
        return '<tr>'.
            '<td rowspan="3" class="skill">Кэш (высоконагруженные системы)</td>'.
            '<td class="option">Redis</td>'.
            '<td class="level">Мой уровень</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option">Memcache</td>'.
            '<td class="level">Мой уровень</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option">npm---????</td>'.
            '<td class="level">Мой уровень</td>'.
            '</tr>';
    }

    public static function skillsDocker():string
    {
        return '<tr>'.
            '<td rowspan="2" class="skill">Docker</td>'.
            '<td class="option">mySql, MariaDb</td>'.
            '<td class="level">Мой уровень</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option">MsSql</td>'.
            '<td class="level">Мой уровень</td>'.
            '</tr>';
    }

    public static function skillsMicroservice():string
    {
        return '<tr>'.
            '<td rowspan="2" class="skill">Микросервисы</td>'.
            '<td class="option">mySql, MariaDb</td>'.
            '<td class="level">Мой уровень</td>'.
            '</tr>'.
            '<tr>';
    }

    public static function skillsOwasp():string
    {
        return '<tr>'.
            '<td rowspan="1" class="skill">OWASP</td>'.
            '<td class="option">mySql, MariaDb</td>'.
            '<td class="level">Мой уровень</td>'.
            '</tr>';
    }

    public static function skillsTest():string
    {
        return '<tr>'.
            '<td rowspan="2" class="skill">тесты</td>'.
            '<td class="option">юнит-тесты, интеграционные тесты), опыт написания тестов.</td>'.
            '<td class="level">Мой уровень</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option">интеграционные тесты, опыт написания тестов.</td>'.
            '<td class="level">Мой уровень</td>'.
            '</tr>';
    }

    public static function skillsQueue():string
    {
        return '<tr>'.
            '<td rowspan="2" class="skill">Брокеры очередей</td>'.
            '<td class="option">Kafka</td>'.
            '<td class="level junior">Мой уровень</td>'.
            '</tr>'.
            '<tr>'.
            '<td class="option">Rabbit Mq</td>'.
            '<td class="level junior">Мой уровень</td>'.
            '</tr>';
    }

    public static function skillsMethods():string
    {
        return '<tr>'.
            '<td rowspan="1" class="skill">Методологии</td>'.
            '<td class="option">TTD, MariaDb</td>'.
            '<td class="level">Мой уровень</td>'.
            '</tr>';
    }
}