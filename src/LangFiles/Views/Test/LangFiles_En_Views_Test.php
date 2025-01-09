<?php
class LangFiles_En_Views_Test extends LangFiles_En_Views_SiteView
{
    static public function getLangHead():stdClass
    {
        $langHead = parent::getLangHeader();
        $langHead->description = 'что то про web-тесты';
        $langHead->title = 'список Web-тестов';

        return $langHead;
    }
    static public function getLangHeader():stdClass
    {
        $langHeader = parent::getLangHeader();
        $langHeader->h1 = 'список Web-тестов';

        return $langHeader;
    }

    static public function getLangPageContent():stdClass
    {
        $langPageContent = new stdClass();

        $langPageContent->menuItems = array(
            'migrations' => array(
                'refText' => 'миграции',
                'refTitle' => 'создание, контроль проведения минраций',
                'subMenu' => array(
                    'checkconnectserverstatus' => array(
                        'refText' => 'checkConnectServerStatus',
                        'refTitle' => 'создание, контроль проведения минраций',
                    ),
                    'createmigrationstables' => array(
                        'refText' => 'createMigrationsTables',
                        'refTitle' => 'создание, контроль проведения минраций',
                    ),
                    'execnewmigrations' => array(
                        'refText' => 'execNewMigrations',
                        'refTitle' => 'создание, контроль проведения минраций',
                    ),
                    'migrationslist' => array(
                        'refText' => 'migrationsList',
                        'refTitle' => 'создание, контроль проведения минраций',
                    ),
                    'migrationslog' => array(
                        'refText' => 'migrationsLog',
                        'refTitle' => 'создание, контроль проведения минраций',
                    ),
                ),
            ),
            'records' => array(
                'refText' => 'записи в таблицах',
                'refTitle' => 'структура записи берется из базы данных',
            ),
            'tables' => array(
                'refText' => 'таблицы',
                'refTitle' => 'работа с таблицами',
            ),
            'email' => array(
                'refText' => 'рассылки',
                'refTitle' => 'отправить шаблон уведомлений',
            ),
        );
        $langPageContent->h2 = 'Web-тесты';

        return $langPageContent;
    }
}
