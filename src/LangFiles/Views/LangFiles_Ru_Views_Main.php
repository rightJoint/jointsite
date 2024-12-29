<?php
class LangFiles_Ru_Views_Main extends LangFiles_Ru_Views_SiteView
{
    static public function getLangPageContent():\stdClass
    {
        $langPageContent = parent::getLangPageContent();

        $langPageContent->jointSiteMenu = array(
            'about' => array(
                'refText' => 'назначение',
                'titleText' => 'фунции сайта',
            ),
            'deploy' => array(
                'refText' => 'установка приложения',
                'titleText' => 'установка приложения из образа или репозитория',
                'subMenu' => array(
                    'dockerhub' => array(
                        'refText' => 'Установка приложения docker hub',
                        'titleText' => 'Docker image',
                    ),
                    'github' => array(
                        'refText' => 'Установка приложения git hub',
                        'titleText' => 'git hub',
                    ),
                    'openserver' => array(
                        'refText' => 'Open server',
                        'titleText' => 'Open server',
                    ),
                    'portsforwarding' => array(
                        'refText' => 'Доступ через интернет, проброс портов',
                        'titleText' => 'portsforwarding',
                    ),
                ),
            ),
            'architecture' => array(
                'refText' => 'архитектура',
                'titleText' => 'архитектура приложения и стандарты',
                'subMenu' => array(
                    'lifecycle' => array(
                        'refText' => 'request lifecycle',
                        'titleText' => 'request lifecycle',
                    ),
                    'directories' => array(
                        'refText' => 'directories',
                        'titleText' => 'directories',
                    ),
                    'middleware' => array(
                        'refText' => 'middleware',
                        'titleText' => 'middleware',
                    ),
                    'routes' => array(
                        'refText' => 'routes',
                        'titleText' => 'routes',
                    ),
                    'mvc' => array(
                        'refText' => 'mvc-pattern',
                        'titleText' => 'mvc',
                        'subMenu' => array(
                            'model' =>  array(
                                'refText' => 'model',
                                'titleText' => 'model',
                            ),
                            'view' =>  array(
                                'refText' => 'View',
                                'titleText' => 'View',
                            ),
                            'Controller' =>  array(
                                'refText' => 'Controller',
                                'titleText' => 'Controller',
                            ),
                            'Action' =>  array(
                                'refText' => 'Action',
                                'titleText' => 'Action',
                            )
                        ),
                    ),
                    'throwerrors' => array(
                        'refText' => 'Throw errors',
                        'titleText' => 'Throw errors',
                    ),
                ),
            ),
            'components' => array(
                'refText' => 'компоненты JointApp',
                'titleText' => 'компоненты приложения, модули',
                'subMenu' => array(
                    'Record' => array(
                        'refText' => 'Record',
                        'titleText' => 'Record',
                    ),
                    'Migrations' => array(
                        'refText' => 'Migrations',
                        'titleText' => 'Migrations',
                    ),
                    'Notification' => array(
                        'refText' => 'Notification',
                        'titleText' => 'Notification',
                    ),
                    'auth' => array(
                        'refText' => 'Авторизация',
                        'titleText' => 'Авторизация',
                    ),
                ),
            ),
        );

        return $langPageContent;
    }
}
