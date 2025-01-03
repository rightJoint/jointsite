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


        $jobInterviewMenu = new stdClass();
        $jobInterviewMenu->menuItems = array(
            'php' => array(
                'refText' => 'вопросы по backend php',
                'refTitle' => 'вопросы на собеседовании по php',
                'usage' => true,
            ),
            'database' => array(
                'refText' => 'вопросы по базам данных',
                'refTitle' => 'вопросы на собеседовании по базам данных',
                'usage' => true,
            ),
            'testTasks' => array(
                'refText' => 'тестовые задания',
                'refTitle' => 'вопросы на собеседовании по базам данных',
                'usage' => true,
            ),
        );
        $jobInterviewMenu->menuLine = array(
            'refText' => 'Full-stack собеседование',
            'refTitle' => 'подготовка к собеседованию на full-stack разработчика',
            'supText' => 'php, js, etc',
            'dropText' => 'q&a',
        );

        $langModal->jobInterviewMenu = $jobInterviewMenu;

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
            'email' => array(
                'refText' => 'рассылки',
                'refTitle' => 'тест отправки уведомлений',
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
