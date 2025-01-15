<?php
class LangFiles_Ru_Views_SiteView extends LangFiles_Ru_Views_WebView
{
    static public function getLangModal():stdClass
    {
        $langModal = parent::getLangModal();

        $jointSiteMenu = new stdClass();
        $jointSiteMenu->menuItems = array(
            'deploy' => array(
                'refText' => 'установка',
                'refTitle' => 'установка приложения из образа или репозитория',
                'usage' => true,
            ),
            'architecture' => array(
                'refText' => 'архитектура',
                'refTitle' => 'архитектура приложения и стандарты',
                'usage' => true,
            ),
            'components' => array(
                'refText' => 'компоненты',
                'refTitle' => 'компоненты приложения, модули',
                'usage' => true,
            ),
        );
        $jointSiteMenu->menuLine = array(
            'refText' => 'Web - приложение JointSite',
            'refTitle' => 'Подробнее о приложении',
            'supText' => 'php, js, mvc',
            'dropText' => 'проект',
        );

        $langModal->jointSiteMenu = $jointSiteMenu;

        $webTestMenu = new stdClass();
        $webTestMenu->menuItems = array(
            'migrations' => array(
                'refText' => 'миграции',
                'refTitle' => 'создание, контроль проведения минраций',
                'usage' => true,
            ),
            'records' => array(
                'refText' => 'записи',
                'refTitle' => 'структура записи берется из базы данных',
                'usage' => true,
            ),
            'tables' => array(
                'refText' => 'таблицы',
                'refTitle' => 'список, сохраниение, загрузка таблиц',
                'usage' => true,
            ),
        );
        $webTestMenu->menuLine = array(
            'refText' => 'Web-тесты',
            'refTitle' => 'некоторые браузерные тесты через брау',
            'supText' => '',
            'dropText' => 'список',
        );

        $langModal->webTestMenu = $webTestMenu;

        $musicMenu = new stdClass();
        $musicMenu->link_text = 'Избранные трэки';
        $musicMenu->link_title = 'Работать приятней под хорошую музыку';

        $langModal->musicMenu = $musicMenu;

        return $langModal;
    }
}
