<?php


namespace Src\Views\JointSite\About;


use JointApp\Interfaces\LangWebViewInterface;

class View_JointSite_About_Lang extends View_JointSite_About
{

    public static function loadLangView(string $docRoot = __DIR__, string $viewLang = 'ru', $loads = []):LangWebViewInterface
    {
        $name = 'LangFiles_'.self::langNs($viewLang).'_Views_JointSite_About_Lang';
        $loads[] = [$name => $docRoot.'/LangFiles/Views/JointSite/About/'.$name];
        return parent::loadLangView($docRoot, $viewLang, $loads);
    }

    public static function addStyleLinks(callable $addStyleLinks):void
    {
        parent::addStyleLinks($addStyleLinks);

        $addStyleLinks([
            '/css/jointSite/diffTable.css',
            ]);
    }

    //content after menu
    protected static function pageContentJointSite(\stdClass $contentBlock, string $langSl = ''):string
    {
        return '<section>'.
            '<p>'.
            'Технически, существуют несколько способов показывать пользователю контент на разных языках: '.
            '</p>'.
            '<div class="diffTable">'.
            '<table>'.
            '<tr>'.
            '<td>№</td><td>способ</td><td>пример</td><td>коммент</td>'.
            '</tr>'.
            '<tr class="rec">'.
            '<td>1</td>'.
            '<td>Top level domain</td>'.
            '<td>(e.g. www.example.fr)</td>'.
            '<td>рекомендуемый</td>'.
            '</tr>'.
            '<tr class="rec">'.
            '<td>2</td>'.
            '<td>Subdomain</td>'.
            '<td>(e.g. www.fr.example.com)</td>'.
            '<td>рекомендуемый</td>'.
            '</tr>'.
            '<tr class="norm">'.
            '<td>3</td>'.
            '<td>Subdirectory</td>'.
            '<td>(e.g. www.example.com/fr/)</td>'.
            '<td>приемлемый</td>'.
            '</tr>'.
            '<tr class="not-rec">'.
            '<td>4</td>'.
            '<td>Request</td>'.
            '<td>www.example.com/?lang=fr</td>'.
            '<td>не рекомендуемый</td>'.
            '</tr>'.
            '</table>'.
            '</div>'.
            '<p>'.
            'С точки зрения seo, первый и второй способы будут рекомендуемые, '.
            'но более затратные с точки зрения регистрации и поддержки нескольких доменов. '.
            'Третий способ, Subdirectory, считается приемлемым. '.
            'Четвертый спобоб не рекомендуется, хотя он и рабочий с технической точки зрения, от него пришлось отказаться.'.
            '</p>'.
            '<p>'.
            'По ходу разработки выяснилось, какие именно настройки необходимо использовать при оптимизации в поддиректории. '.
            'Мультиязычный текст выносился в отдельные lang-файлы и виде /stdClass подключался к view. '.
            'Приложение разбирает Uri запроса, и определяет язык, например русский, английский, или язык по умолчанию. '.
            '<ul>'.
            '<li>Для загрузки языковых файлов из классов потребуется имя класса в таком регистре Ru, En (landNs)</li>'.
            '<li>Для постановки в массивы или запросы в базу данны - в нижнем регистре ru, en (landLw)</li>'.
            '<li>На экранах представлений для подстановки в ссылки: без ссылки (язык по умолчанию), /ru, /en (landSl)</li>'.
            '</ul>'.
            'Таким образом достигается независимость логики работы приложения от конкретного языка. '.
            '</p>'.
            '<p>'.
            'Для проверки наличия языковых фалов можно использовать langTest, он может показать наличие проблем.'.
            '</p>'.
            '</section>'.
            '<section>'.
            'Ссылки: '.
            '<ul>'.
            '<li><a href="https://www.weglot.com/guides/multilingual-seo-tips" title="weglot - multilingual-seo-tips">weglot - multilingual-seo-tips</a></li>'.
            '</ul>'.
            '</section>';
    }
}