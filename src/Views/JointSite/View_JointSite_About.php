<?php


namespace Src\Views\JointSite;


use JointApp\Interfaces\LangWebViewInterface;
use Src\Views\View_Main;

class View_JointSite_About extends View_JointSite
{

    public string $logo = '/img/siteLogo/rightjoint-logo-400.png';

    public static function loadLangView(string $docRoot = __DIR__, string $viewLang = 'ru', $loads = []):LangWebViewInterface
    {
        $name = 'LangFiles_'.self::langNs($viewLang).'_Views_JointSite_About';
        $loads[] = [$name => $docRoot.'/LangFiles/Views/JointSite/'.$name];
        return parent::loadLangView($docRoot, $viewLang, $loads);
    }

    public static function addStyleLinks(callable $addStyleLinks):void
    {
        parent::addStyleLinks($addStyleLinks);

        $addStyleLinks([
            '/css/jointSite/jointSiteMenu.css',
            '/css/jointSite/pageContentJointSite.css',
            ]);
    }

    public static function addScriptLinks($addScriptLinks):void
    {
        parent::addScriptLinks($addScriptLinks);

        $addScriptLinks(['/js/jointSite/jointSiteMenu.js']);
    }

    public static function createPageContent(\stdClass $langPageContent, \stdClass $viewParams = null):string
    {
        $pageContent =
            '<div class="contentBlock-frame"><div class="contentBlock-center">'.
            '<div class="contentBlock-wrap">'.
            '<div class="joint-site-menu">'.
            self::jointSiteMenu($langPageContent->jointSiteMenu).
            '</div>'.
            '</div></div></div>'.

            //contentBlock
            '<div class="contentBlock-frame"><div class="contentBlock-center">'.
            '<div class="contentBlock-wrap">'.
            '<div class="pageContentJointSite">'.
            static::pageContentJointSite($langPageContent->contentBlock).
            '</div>'.
            '</div></div></div>';

        return $pageContent;
    }

    //content after menu
    protected static function pageContentJointSite(\stdClass $contentBlock):string
    {
        return '<section>'.
            'Это тренировочный проект, стоит ли вам его использовать для реальных задач решайте сами. '.
            'При проектировании были выбраны мне уже знакомые технологии php, js, docker. '.
            'Было решено сделать собственный тренировочный фрэймворк нативном php с поддержкой основных интерфейсов psr. '.
            'При приложение задумывалось как двуязычный сайт для решения широкого круга задач. '.
            'Основные требования были - простота и скорость разработки нового фунционала на основе разработанного каркаса. '.
            'Стай поддерживанеи стандартные psr-интерфейсы для возможности интеграции с другими проектами'.
            '</section>'.
            '<section>'.
            '<p>Для работы с сайтом вам потребуется работать создать базу данных и провести миграции.</p>'.
            '<p>Настройки подключения к базе данных по умолчанию находятся в ....</p>'.
            '<h3>Работа с таблицами</h3>'.
            '<p>Для работы с таблицами я использую свой свой контролер и модель, как в этом <a href="/test/tables">примере</a>, '.
            'для небольшой базы данных этого достаточно, '.
            'хотя я знаком с phpMyAdmin.</p>'.
            '<p></p>'.
            '<h3>проведение миграций</h3>'.
            '<p>Провести миграции миграции через веб-интерфейс <a href="/test/migration">пример</a> '.
            'который позволяет редактировать предустановленные типы запросов в sql-файлах миграций, '.
            'следить за выполением миграций в логах</p>'.
            '<p>Для проведения миграций через командную строку выполните команду '.
            'php ./vendor/bin/phpunit tests/Exec_Migrations_TEST.php</p>'.
            //'<p>Для работы с таблицами</p>'.
            '<h3>Работа с записями</h3>'.
            '<p>Для работы с записями в таблицах и выполнения CRUD операций реализован тестовый <a href="/test/records">пример</a></p>'.
            '<h3>Загрузка файлов</h3>'.

            '</section>'.
            '<section>'.
            '<h2>Module Model ModuleController</h2>'.
            '<p>Модель предоставляет доступ к записи по содержанию поля created_by.</p>'.
            '<p>На основе Module Model настроен пример админки сайта</p>'.
            '</section>'.
            '<section>'.
            '<h2>Уведомление пользователей</h2>'.
            '<h3>Модель уведомлений</h3>'.
            '<h3>Шаблоны уведомлений</h3>'.
            '<h3>Очередь уведомлений</h3>'.
            '<h3>Очередь чтение</h3>'.
            '<h3>Логи уведомлений</h3>'.
            '<p></p>'.
            '</section>'.
            '<section>'.
            '<p>Rest api record, Rest api module</p>'.
            '</section>'.
            '<section>'.
            '<p>Программирование</p>'.
            '<p>как программировать view</p>'.
            '<p>ссылка ка программировать модель подробнее о модели</p>'.
            '</section>'.
            '<section>'.
            '<h2>Что с этим делать</h2>'.
            '<p>Кнопка донат</p>'.
            '</section>';
            //'<section>'.

            //'</section>';

    }
}