<?php
include "application/views/products/view_jointpass.php";
class landing_view extends view_jointpass
{

    function __construct()
    {
        parent::__construct();

        $this->logo = "img/siteLogo/rightjoint-logo-400.png";
        $this->shortcut_icon = "img/siteLogo/favicon.png";

        $this->styles[] = "/lib/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css";
        $this->styles[] = "css/landing/title-block.css";
        $this->styles[] = "css/pop-services.css";
        $this->styles[] = "css/component.css";
        $this->styles[] = "css/landing/contacts-footer.css";

        $this->scripts[] = "/lib/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js";
        $this->scripts[] = "js/modernizr.custom.js";
        $this->scripts[] = "js/landing-basket.js";
        $this->scripts[] = "js/matrix-rain.js";
        $this->scripts[] = "js/landing/contacts.js";


        $this->lang_map["head"]["h1"] = array(
            "en" => "Developer Services",
            "rus" => "Услуги разработчика"
        );
        $this->lang_map["head"]["title"] = array(
            "en" => "Hired programmer",
            "rus" => "Наёмный программист"
        );
        $this->lang_map["head"]["description"] = array(
            "en" => "Hired programmer RightJoint: programming on php and c#. Creating and support software. ".
                "Free product jointPass - password organizer, download. ".
                "Pop services: php, c#, js, html, git, ",
            "rus" => "Наёмный программист RightJoint: программирование на php и c#. Создание нового и поддержка существующего софта. ".
                "Бесплатно продукт jointPass - органайзер паролей, скачать. ".
                "Популярные услуги: php, c#, js, html, git, ",
        );
        $this->lang_map["title-block"] = array(
            "invoke" => array(
                "en" => "Programming on php and c#",
                "rus" => "Программирование на php и c#"
            ),
            "invoke-cm" => array(
                "en" => "Developing new and maintenance existing software, business process automation",
                "rus" => "Создание нового и поддержка существующего софта, автоматизация бизнесс-процессов",
            ),
            "st-txt1" => array(
                "en" => "Analytical approach",
                "rus" => "Аналитический подход",
            ),
            "st-txt2" => array(
                "en" => "Responsible for the execution",
                "rus" => "Отвественный выполнение",
            ),
            "st-txt3" => array(
                "en" => "Solving complex problems",
                "rus" => "Решение сложных проблем",
            ),
            "thought" => array(
                "en" => "By entrusting your tasks to a specialist, you do not have to worry that everything ".
                    "will be done correctly and on time.",
                "rus" => "Доверив свои задачи специалисту, вам не придется волноваться, что все будет сделано ".
                    "правильно и вовремя.",
            ),
            "cb-txt" => array(
                "en" => "Call now",
                "rus" => "Позвонить",
            ),
            "advantages-list-1" => array(
                "en" => "More than 10 years of experience in the IT field",
                "rus" => "Более 10 опыта в it-сфере",
            ),
            "advantages-list-2" => array(
                "en" => "Good reputation",
                "rus" => "Хорошая репутация",
            ),
            "advantages-list-3" => array(
                "en" => "Work experience in the bank",
                "rus" => "Опыт работы в банке",
            ),
            "advantages-list-4" => array(
                "en" => "Without intermediaries",
                "rus" => "Без посредников",
            ),
            "advantages-list-5" => array(
                "en" => "Flexible pricing and discount system",
                "rus" => "Гибкие расценки и система скидок",
            ),
            "ask-q-1" => array(
                "en" => "Ask me your questions on",
                "rus" => "Задайте свои вопросы по",
            ),
            "ask-q-2" => array(
                "en" => "Telegram",
                "rus" => "Телеграм",
            ),
            "ask-q-3" => array(
                "en" => "or",
                "rus" => "или",
            ),
            "ask-q-4" => array(
                "en" => "leave a request",
                "rus" => "оставьте заявку",
            ),
            "ask-q-5" => array(
                "en" => "on this site",
                "rus" => "на сайте",
            ),
        );
        $this->lang_map["product-h2"] = array(
            "en" => "My products - freeware",
            "rus" => "Мои продукты - бесплатно",
        );
        $this->lang_map["pop-s"] = array(
            "h2" => array(
                "en" => "Pop services",
                "rus" => "Популярные услуги",
            ),
            "btn-buy" => array(
                "en" => "Buy",
                "rus" => "Купить",
            ),
            "more-txt" => array(
                "en" => "one more",
                "rus" => "ещё",
            )
        );
        $this->lang_map["contacts-block"] = array(
            "address-f" => array(
                "en" => "Address",
                "rus" => "Адрес",
            ),
            "address-v" => array(
                "en" => "Russia, Ivanovo, 8-Match st., b. 32, «Silver city» mall, public hall",
                "rus" => "г. Иваново, ул. 8 Марта, д. 32, ТРЦ «Серебряный город»",
            ),
            "Schedule-f" => array(
                "en" => "Schedule",
                "rus" => "Режим работы",
            ),
            "Schedule-v" => array(
                "en" => "mon. - fri. 9.00 am - 6.00pm +4 UTC, sat., sun. - days off",
                "rus" => "пнд. - птн. с 9.00 до 18.00, сбт., вск. - выходной",
            ),
            "phone-f" => array(
                "en" => "Phone",
                "rus" => "Телефон",
            ),
        );
    }


    function print_page_content()
    {
        $this->printTitleBlock();
        echo"<div class='contentBlock-frame dark'><div class='contentBlock-center'>".
            "<div class='contentBlock-wrap'>";
        $this->print_jointPass();
        echo "</div></div></div>";
        $this->printServiceBlock();
        $this->printContactsBlock();
    }

    function matrixRain()
    {
        echo "<canvas id='rain-canvas'>".
            "</canvas>";
    }

    function printTitleBlock()
    {
        echo "<div class='contentBlock-frame bg-top'>".
            "<div class='contentBlock-center'><div class='contentBlock-wrap'>".
            "<div class='services-title-wrap'>".
            "<div class='langing-invoke'>".$this->lang_map["title-block"]["invoke"][$_SESSION["lang"]].
            "</div>".
            "<div class='langing-comment'>".$this->lang_map["title-block"]["invoke-cm"][$_SESSION["lang"]]."</div>".
            "<div class='services-title-left'>".

            "<div class='stl-line'><span class='st-txt1'>".$this->lang_map["title-block"]["st-txt1"][$_SESSION["lang"]]."</span></div>".
            "<div class='stl-line'><span class='st-txt2'>".$this->lang_map["title-block"]["st-txt2"][$_SESSION["lang"]]."</span></div>".
            "<div class='stl-line'><span class='st-txt3'>".$this->lang_map["title-block"]["st-txt3"][$_SESSION["lang"]]."</span></div>".
            "</div>".
            "<div class='service-title-photo'>";
        $this->matrixRain();
        echo "</div>".
            "<div class='services-title-right thought'>".$this->lang_map["title-block"]["thought"][$_SESSION["lang"]].
            "</div></div>".
            "<div class='call-btn'><a href='tel:+7(903)8887772' title='".$this->lang_map["title-block"]["cb-txt"][$_SESSION["lang"]]."'>".
            "<div class='cb-content-wrap'>".
            "<span class='cb-num'>+7 (903) 888-7772</span>".
            "<span class='cb-txt'>".$this->lang_map["title-block"]["cb-txt"][$_SESSION["lang"]]."</span></div>".
            "<div class='cb-img'>".
            "<img src='/img/landing/phone-free.png'></div>".
            "</a></div>".
            "<div class='advantages-list'>".
            "<div class='advantages-line'>".
            "<div class='advantages-line-img'><img src='/img/landing/experience.png'></div><div class='advantages-line-txt'>".
            $this->lang_map["title-block"]["advantages-list-1"][$_SESSION["lang"]]."</div>".
            "</div>".
            "<div class='advantages-line'>".
            "<div class='advantages-line-img'><img src='/img/landing/trust.png'></div><div class='advantages-line-txt'>".
            $this->lang_map["title-block"]["advantages-list-2"][$_SESSION["lang"]]."</div>".
            "</div>".
            "<div class='advantages-line'>".
            "<div class='advantages-line-img'><img src='/img/landing/bank-flat.png'></div><div class='advantages-line-txt'>".
            $this->lang_map["title-block"]["advantages-list-3"][$_SESSION["lang"]]."</div>".
            "</div>".
            "<div class='advantages-line'>".
            "<div class='advantages-line-img'><img src='/img/landing/handsshake.png'></div><div class='advantages-line-txt'>".
            $this->lang_map["title-block"]["advantages-list-4"][$_SESSION["lang"]]."</div>".
            "</div>".
            "<div class='advantages-line'>".
            "<div class='advantages-line-img'><img src='/img/landing/flexible.png'></div><div class='advantages-line-txt'>".
            $this->lang_map["title-block"]["advantages-list-5"][$_SESSION["lang"]]."</div>".
            "</div>".
            "</div>".
            "<div class='ask-questions-line'>".$this->lang_map["title-block"]["ask-q-1"][$_SESSION["lang"]].
            " <a href='https://t.me/rightjoint' title='".$this->lang_map["title-block"]["ask-q-2"][$_SESSION["lang"]]."'>".
            "<img src='/img/Services/telegram.png'>Telegram</a> ".
            $this->lang_map["title-block"]["ask-q-3"][$_SESSION["lang"]].
            " <span class='feedback-title'><img src='/img/Services/application-logo.png'>".
            $this->lang_map["title-block"]["ask-q-4"][$_SESSION["lang"]].
            "</span> ".$this->lang_map["title-block"]["ask-q-5"][$_SESSION["lang"]]."</div>".
            "</div></div></div>";
    }

    function printServiceBlock()
    {
        echo "<div class='contentBlock-frame'>".
            "<div class='contentBlock-center'><div class='contentBlock-wrap pop-services'>".
            "<h2>".$this->lang_map["pop-s"]["h2"][$_SESSION["lang"]]."</h2>".'<div class="container">'.
            "<div class='main'>".
            "<ul id='og-grid' class='og-grid'>";

        while ($popServices_row = $this->view_data->fetch(PDO::FETCH_ASSOC)){
            echo "<li>".
                "<span>".$popServices_row['cardName_'.$_SESSION["lang"]]."</span>".
                "<a href='#' id='pop-".$popServices_row['cardAlias']."'
						data-largesrc='/img/Services/services/".$popServices_row['card_id']."/".$popServices_row['cardImg']."' 
						data-title='".$popServices_row['shortDescr_'.$_SESSION["lang"]]."' 
						data-description='".$popServices_row['longDescr_'.$_SESSION["lang"]]."' 
						data-buy='".$popServices_row['cardAlias']."' 
						data-lang='".$_SESSION["lang"]."' 
						data-bought='<div>".$this->lang_map["pop-s"]["btn-buy"][$_SESSION["lang"]]." ";
            if($_SESSION['basket']['prod'][$popServices_row['cardAlias']]){
                echo $this->lang_map["pop-s"]["more-txt"][$_SESSION["lang"]];
            }
            echo "</div><label>".$popServices_row['cardPrice_'.$_SESSION["lang"]]."</label> ".$popServices_row["cardCurr_".$_SESSION["lang"]]."/".
                $popServices_row["unit_".$_SESSION["lang"]]."'>".
                "<img src='/img/Services/images/thumbs/".$popServices_row['cardAlias'].".jpg' alt='pop-srv-icon'/>".
                "</a>".
                "</li>";
        }
        echo "</ul></div></div>".
            "<script src='/js/grid.js'></script>".
            "<script>$(function() {
    Grid.init();
});</script>";
        echo "</div></div></div>";
    }

    function printContactsBlock()
    {
        //<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A2d466e2d4f1632789b9df6fd6d34e6e4f660b8caa1bed15db7a0dd231e4c7a31&amp;width=1200&amp;height=300&amp;lang=ru_RU&amp;scroll=true"></script>
        echo "<div class='contentBlock-frame dark'><div class='contentBlock-center'><div class='contentBlock-wrap contacts'>".
            "<div class='contacts-block'>".
            "<div class='cb-img-wrap active'><div>".
            '<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A2d466e2d4f1632789b9df6fd6d34e6e4f660b8caa1bed15db7a0dd231e4c7a31&amp;width=1200&amp;height=300&amp;lang=ru_RU&amp;scroll=true"></script>'.
            "</div></div>".
            "<div class='cb-img-wrap '>".
            "<img src='/img/landing/contacts/sg-1.jpg'>".
            "</div>".
            "<div class='cb-img-wrap'>".
            "<img src='/img/landing/contacts/sg-2.jpg'></div>".
            "</div>".
            "<div class='descr-frame'>".
            "<div class='descr-line'><img src='/img/siteLogo/rightjoint-logo-150.png'><span class='fmNm'>Right Joint</span></div>".
            "<div class='descr-line'><span>".$this->lang_map["contacts-block"]["address-f"][$_SESSION["lang"]].":</span> ".
            $this->lang_map["contacts-block"]["address-v"][$_SESSION["lang"]]."</div>".
            "<div class='descr-line'><span>".$this->lang_map["contacts-block"]["Schedule-f"][$_SESSION["lang"]].":</span> ".
            $this->lang_map["contacts-block"]["Schedule-v"][$_SESSION["lang"]]."</div>".
            "<div class='descr-line'><span>E-Mail:</span> rightjoint@yandex.ru</div>".
            "<div class='descr-line'><span>".$this->lang_map["contacts-block"]["phone-f"][$_SESSION["lang"]].":</span>".
            "<a href='tel:+7(903)8887772'> +7 (903) 888-7772</a></div>".
            "<div class='locPr-block'>".
            "<img src='/img/landing/contacts/small-img-yMap.png' class='active' onclick='changeContImg(0)'>".
            "<img src='/img/landing/contacts/sg-1-small.jpg' onclick='changeContImg(1)'>".
            "<img src='/img/landing/contacts/sg-2-small.jpg' onclick='changeContImg(2)'>".
            "</div>".
            "</div></div></div>";
    }

}