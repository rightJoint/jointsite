<?php
class view_products extends View
{

    function __construct()
    {
        $this->logo = 'img/popimg/dev-logo.png';
        $this->styles[] = "css/products/prod-main.css";

        $this->lang_map["head"]["h1"] = array(
            "en" => "My products",
            "rus" => "Мои продукты",
        );

        $this->lang_map["jointsite"] = array(
            "title" => array(
                "en" => "joint-site",
                "rus" => "Джойнт-сайт",
            ),
            "img" => "img/popimg/internet.png",
            "p1" => array(
                "en" => "adasdwdwdwed",
                "rus" => "Двуязычный сайт с меню в модальном окне. Технологии: php, js. Шаблон: MVC. ".
            "Структуру модели можно описать в виде массивов полей или получить автоматически из базы данных. ".
            "Модуль описыват связанные таблицы мастер - подчиненные для групповых операций поиска и удаления.",
            ),
            "p2" => array(
                "en" => "adasdwdwdwed",
                "rus" => "Для скачивания доступны тематические ветки<br>".
                    "mysql admin<br>".
                    "Music gallery<br>".
                    "и другие<br>",
            ),
        );
        $this->lang_map["jointpass"] = array(
            "title" => array(
                "en" => "joint-pass",
                "rus" => "Джойнт-пасс",
            ),
            "img" => "img/popimg/jointPass.png",
            "p1" => array(
                "en" => "adasdwdwdwed",
                "rus" => "Упорядоченное хранение паролей",
            ),
            "p2" => array(
                "en" => "adasdwdwdwed",
                "rus" => "Для скачивания доступны раздичные тема",
            ),
        );
    }

    function print_page_content()
    {
        echo"<div class='contentBlock-frame'><div class='contentBlock-center dark'>".
            "<div class='contentBlock-wrap'>";



        $promoteBlock_txt = "<div class='promote-block'>".
            "<div class='promote-block-title'>".
            "<div class='pbt-header'>".$this->lang_map["jointsite"]['title'][$_SESSION["lang"]]."</div>".
            "<div class='pbt-numbers'><span class='active' onclick='promoteBlock(1)'>php</span><span  onclick='promoteBlock(2)'>js</span><span onclick='promoteBlock(3)'>mvc</span></div>".
            "</div>".
            "<div class='promote-block-content'>".
            "<div class='pbc-line f-left'>".
            "<img src='".$this->lang_map["jointsite"]["img"]."'>".
            "<p>".
            $this->lang_map["jointsite"]["p1"][$_SESSION["lang"]].
            "</p>".
            "</div>".
            "<div class='pbc-line f-right'>".
            "<img src='".$this->lang_map["jointpass"]["img"]."'>".
            "<p>".
            $this->lang_map["jointsite"]["p2"][$_SESSION["lang"]].
            "</p>".
            "</div>".

            "</div>".
            "<div class='promote-block-order'>".
            "<div class='pbo-ctrl'><a href='/products/jointsite' class='pbo-ctrl-feedback'><img src='/site/landing/img/money.png'>Смотреть <b>15 000</b> руб</a></div>".
            "<div class='pbo-txt'><div class='pbc-arrow'></div>Узнать больше</div>".
            "</div>".
            "</div>";



        echo $promoteBlock_txt;

        $promoteBlock_txt = "<div class='promote-block'>".
            "<div class='promote-block-title'>".
            "<div class='pbt-header'>".$this->lang_map["jointpass"]['title'][$_SESSION["lang"]]."</div>".
            "<div class='pbt-numbers'><span class='active' onclick='promoteBlock(1)'>c#</span><span  onclick='promoteBlock(2)'>wpf</span></div>".


            "</div>".
            "<div class='promote-block-content'>".


            "<div class='pbc-line f-left'>".
            "<img src='".$this->lang_map["jointsite"]["img"]."'>".
            "<p>".
            $this->lang_map["jointsite"]["p1"][$_SESSION["lang"]].
            "</p>".
            "</div>".
            "<div class='pbc-line f-right'>".
            "<img src='".$this->lang_map["jointpass"]["img"]."'>".
            "<p>".
            $this->lang_map["jointpass"]["p1"][$_SESSION["lang"]].
            "</p>".
            "</div>".
            "</div>".
            "<div class='promote-block-order'>".
            "<div class='pbo-ctrl'><span onclick='promBuy(this)' class='pbo-ctrl-feedback'><img src='/site/landing/img/money.png'>Визитка от <b>15 000</b> руб</span></div>".
            "<div class='pbo-txt'><div class='pbc-arrow'></div>Закажите простой сайт</div>".
            "</div>".
            "</div>";
        echo $promoteBlock_txt;


        echo "</div></div></div>";
        return true;


        $promoteBlock['chapter'] = 1;
        if(!$promoteBlock['chapter'] or $promoteBlock['chapter']==1){
            $promoteBlock['title'] = "Начните с визитки";
            $promoteBlock['content'] = "<div class='pbc-line f-left'>".
                "<img src='/site/landing/img/design.png'><p>Посмотрите сайты со схожей тематикой, возьмите лучшее у них, скопируйте и слегка измените.</p>".
                "<p>Подумайте, чем ваш сайт будет выгодно отличаться от конкурентов, разработайте уникальное торговое предложение и логотип.</p>".
                "</div>"/*.
                "<div class='pbc-line f-right'>".
                "<img src='/site/landing/img/internet.png'>".
                "<p>Создайте простой, в несколько страниц сайт, разместите на нем 2-3 самые популярные товара ".
                "или услуги с подробным описанием, информацию о вас и контакты.</p>
<p>Простой сайт может стоить недорого если есть готовые макеты и тексты. Закажите верстку и установку у специалиста.</p>".

                "</div>"*/;
            $promoteBlock['invoice'] = "<div class='pbo-ctrl'><span onclick='promBuy(this)' class='pbo-ctrl-feedback'><img src='/site/landing/img/money.png'>Визитка от <b>15 000</b> руб</span></div>".
                "<div class='pbo-txt'><div class='pbc-arrow'></div>Закажите простой сайт</div>".
                "</div>";
        }elseif ($promoteBlock['chapter']==2){
            $promoteBlock['title'] = "Запустите рекламу";
            $promoteBlock['content'] = "<div class='pbc-line f-right'>".
                "<img src='/site/landing/img/analytics.png'>".
                "<p>Подключите аналитику и другие инструменты для продвижения сайтов, узнайте кто ваши посетители и их интересы.</p>".
                "<p>Подготовьте ваш сайт к показам, проверьте удобства использования на мобильных устройствах.</p>".
                "</div>".

                "<div class='pbc-line f-left'>".
                "<img src='/site/landing/img/adv.png'>".
                "<p>Зарегистрируйте ваш бизнес в Google и Yandex, так пользователи смогут находить вашу фирму в интернет. Настройте ключевые фразы и размеры ставок.</p>".
                "<p>Запустите рекламную кампанию, получите заказы с сайта, оцените конверсию и результаты.</p>".
                "</div>";
            $promoteBlock['invoice'] = "<div class='pbo-ctrl'><span class='pbo-ctrl-feedback' id='test_id'><img src='/site/siteHeader/img/Email-Logo-color.png'>Обратная связь</span></div>".
                "<div class='pbo-txt'><div class='pbc-arrow'></div>узнайте стоимоть рекламы</div>".
                "</div>";
        }elseif ($promoteBlock['chapter']==3){
            $promoteBlock['title'] = "Развивайте сайт";
            $promoteBlock['content'] = "<div class='pbc-line f-left'>".
                "<img src='/site/landing/img/seo.png'>".
                "<p>Сделайте ваш бизнес в интернет прибыльным, всегда думайте об интересах и удобстве для ваших клиентов.</p>".
                "<p>Регулярно обновляйте сайт, привлекайте дополнительных посетителей через блог, подключите оформление заказа и прием оплаты.</p>".
                "</div>".
                "<div class='pbc-line f-right'>".
                "<img src='/site/landing/img/develop.png'>".
                "<p>В настоящее время очень сложно выделиться в интернет при серьезной конкуренции. Для решения сложных задач вам потребуется помощь специалиста.</p>".
                "<p>Мои сильные стороны - это профессионализм, креативное мышление и клиентоориентированность.</p>".
                "</div>";
            $promoteBlock['invoice'] = "<div class='pbo-ctrl'>".
                "<a class='pbo-ctrl-feedback' href='tel:+7(903)8887772' title='Спросить по телефону'>".
                "<img src='/site/siteHeader/img/phone-free.png'>Позвонить</a></div>".
                "<div class='pbo-txt'><div class='pbc-arrow'></div>задайте вопрос по развитию</div>".
                "</div>";
        }

        $promoteBlock_txt = "<div class='promote-block'>".
            "<div class='promote-block-title'>".
            "<div class='pbt-header'>".$promoteBlock['title']."</div>".
            "<div class='pbt-numbers'><span class='active' onclick='promoteBlock(1)'>php</span><span  onclick='promoteBlock(2)'>js</span><span onclick='promoteBlock(3)'>mvc</span></div>".
            "</div>".
            "<div class='promote-block-content'>".$promoteBlock['content']."</div>".
            "<div class='promote-block-order'>".$promoteBlock['invoice']."</div>";

        echo $promoteBlock_txt;
        echo $promoteBlock_txt;
        echo "</div></div></div>";
     //   parent::print_page_content(); // TODO: Change the autogenerated stub
    }
}