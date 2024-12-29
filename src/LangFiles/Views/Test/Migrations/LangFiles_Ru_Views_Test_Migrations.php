<?php
class LangFiles_Ru_Views_Test_Migrations extends LangFiles_Ru_Views_Test
{
    static public function getLangHead():stdClass
    {
        $langHead = parent::getLangHead();
        $langHead->description = 'тесты миграции';
        $langHead->title = 'Тесты-Миграции';

        return $langHead;
    }
    static public function getLangHeader():stdClass
    {
        $langHeader = parent::getLangHeader();
        $langHeader->h1 = 'Тесты-Миграции';

        return $langHeader;
    }
/*
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
            'defaultrecords' => array(
                'refText' => 'все таблицы',
                'refTitle' => 'структура записи берется из базы данных',
            ),
            'customrecords' => array(
                'refText' => 'кастомные таблицы',
                'refTitle' => 'структура записи из кастомных rsf',
                'subMenu' => array(
                    'musicalb' => array(
                        'refText' => 'musicAlb',
                        'refTitle' => 'создание, контроль проведения минраций',
                    ),
                    'musictracks' => array(
                        'refText' => 'musicTracks',
                        'refTitle' => 'создание, контроль проведения минраций',
                    ),
                    'musictrackstoalb' => array(
                        'refText' => 'musicTracksToAlb',
                        'refTitle' => 'создание, контроль проведения минраций',
                    ),
                ),
            ),
        );
        $langPageContent->h2 = 'Web-тесты';

        return $langPageContent;
    }
*/
}
