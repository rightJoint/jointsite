<?php
class LangFiles_En_Views_SiteView extends LangFiles_En_Views_WebView
{
    static public function getLangModal():stdClass
    {
        $langModal = parent::getLangModal();

        $jointSiteMenu = new stdClass();
        $jointSiteMenu->menuItems = array(
            'about' => array(
                'refText' => 'функции',
                'refTitle' => 'функции приложения',
                'usage' => true,
            ),
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

        $blogMenuLine = array(
            'refText' => 'Blog',
            'refTitle' => 'Pop topics',
            'supText' => 'discuss',
            'dropText' => 'subj',
        );

        $langModal->blogMenuLine = $blogMenuLine;

        return $langModal;
    }

    public static function modulesList():stdClass
    {
        $modulesMenu = parent::modulesList();

        $modulesMenu->menuItems['services'] = array(
            'refText' => 'services',
            'refTitle' => 'services list and details',
            'usage' => true,
        );
        $modulesMenu->menuItems['blogarts'] = array(
            'refText' => 'blog',
            'refTitle' => 'blog articles',
            'usage' => true,
        );
        $modulesMenu->menuItems['blogtags'] = array(
            'refText' => 'blog-tags',
            'refTitle' => 'blog-tags',
            'usage' => false,
        );
        $modulesMenu->menuItems['blogtagstoarts'] = array(
            'refText' => 'blog-tags-to-arts',
            'refTitle' => 'blog-tags-to-arts',
            'usage' => false,
        );
        $modulesMenu->menuItems['blogcats'] = array(
            'refText' => 'categories',
            'refTitle' => 'categories',
            'usage' => false,
        );
        $modulesMenu->menuItems['blogcomments'] = array(
            'refText' => 'comments',
            'refTitle' => 'comments',
            'usage' => false,
        );

        return $modulesMenu;
    }
}
