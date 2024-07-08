<?php
//include "application/views/products/view_jointpass.php";
class landing_view extends SiteView
{

    function __construct()
    {
        parent::__construct();

        //require_once "application/lang_files/views/landing/lang_view_landing_".$_SESSION["lang"].".php";

        //$lang_class ="lang_view_landing_".$_SESSION["lang"];

        //$this->lang_map = new $lang_class;

        $this->logo = JOINT_SITE_EXEC_DIR."/img/siteLogo/rightjoint-logo-400.png";
        $this->shortcut_icon = JOINT_SITE_EXEC_DIR."/img/siteLogo/favicon.png";

        $this->styles[] = JOINT_SITE_EXEC_DIR."/css/products/prod-main.css";
        $this->styles[] = JOINT_SITE_EXEC_DIR."/lib/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css";
        $this->styles[] = JOINT_SITE_EXEC_DIR."/css/landing/title-block.css";
        $this->styles[] = JOINT_SITE_EXEC_DIR."/css/pop-services.css";
        $this->styles[] = JOINT_SITE_EXEC_DIR."/css/component.css";
        $this->styles[] = JOINT_SITE_EXEC_DIR."/css/landing/contacts-footer.css";

        $this->scripts[] = JOINT_SITE_EXEC_DIR."/lib/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js";
        $this->scripts[] = JOINT_SITE_EXEC_DIR."/js/modernizr.custom.js";
        $this->scripts[] = JOINT_SITE_EXEC_DIR."/js/landing-basket.js";
        $this->scripts[] = JOINT_SITE_EXEC_DIR."/js/matrix-rain.js";
        $this->scripts[] = JOINT_SITE_EXEC_DIR."/js/landing/contacts.js";
    }

    function LoadViewLang_custom()
    {
        parent::LoadViewLang_custom(); // TODO: Change the autogenerated stub

        require_once $_SERVER["DOCUMENT_ROOT"] . JOINT_SITE_EXEC_DIR . "/application/lang_files".
            "/views/landing/lang_view_landing_".$_SESSION[JS_SAIK]["lang"].".php";
        return "lang_view_landing_".$_SESSION[JS_SAIK]["lang"];
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
            "<div class='langing-invoke'>".$this->lang_map->titleblock["invoke"].
            "</div>".
            "<div class='langing-comment'>".$this->lang_map->titleblock["invoke-cm"]."</div>".
            "<div class='services-title-left'>".

            "<div class='stl-line'><span class='st-txt1'>".$this->lang_map->titleblock["st-txt1"]."</span></div>".
            "<div class='stl-line'><span class='st-txt2'>".$this->lang_map->titleblock["st-txt2"]."</span></div>".
            "<div class='stl-line'><span class='st-txt3'>".$this->lang_map->titleblock["st-txt3"]."</span></div>".
            "</div>".
            "<div class='service-title-photo'>";
        $this->matrixRain();
        echo "</div>".
            "<div class='services-title-right thought'>".$this->lang_map->titleblock["thought"].
            "</div></div>".
            "<div class='call-btn'><a href='tel:+7(903)8887772' title='".$this->lang_map->titleblock["cb-txt"]."'>".
            "<div class='cb-content-wrap'>".
            "<span class='cb-num'>+7 (903) 888-7772</span>".
            "<span class='cb-txt'>".$this->lang_map->titleblock["cb-txt"]."</span></div>".
            "<div class='cb-img'>".
            "<img src='/img/landing/phone-free.png'></div>".
            "</a></div>".
            "<div class='advantages-list'>".
            "<div class='advantages-line'>".
            "<div class='advantages-line-img'><img src='/img/landing/experience.png'></div><div class='advantages-line-txt'>".
            $this->lang_map->titleblock["advantages-list-1"]."</div>".
            "</div>".
            "<div class='advantages-line'>".
            "<div class='advantages-line-img'><img src='/img/landing/trust.png'></div><div class='advantages-line-txt'>".
            $this->lang_map->titleblock["advantages-list-2"]."</div>".
            "</div>".
            "<div class='advantages-line'>".
            "<div class='advantages-line-img'><img src='/img/landing/bank-flat.png'></div><div class='advantages-line-txt'>".
            $this->lang_map->titleblock["advantages-list-3"]."</div>".
            "</div>".
            "<div class='advantages-line'>".
            "<div class='advantages-line-img'><img src='/img/landing/handsshake.png'></div><div class='advantages-line-txt'>".
            $this->lang_map->titleblock["advantages-list-4"]."</div>".
            "</div>".
            "<div class='advantages-line'>".
            "<div class='advantages-line-img'><img src='/img/landing/flexible.png'></div><div class='advantages-line-txt'>".
            $this->lang_map->titleblock["advantages-list-5"]."</div>".
            "</div>".
            "</div>".
            "<div class='ask-questions-line'>".$this->lang_map->titleblock["ask-q-1"].
            " <a href='https://t.me/rightjoint' title='".$this->lang_map->titleblock["ask-q-2"]."'>".
            "<img src='/img/Services/telegram.png'>Telegram</a> ".
            $this->lang_map->titleblock["ask-q-3"].
            " <span class='feedback-title'><img src='/img/Services/application-logo.png'>".
            $this->lang_map->titleblock["ask-q-4"].
            "</span> ".$this->lang_map->titleblock["ask-q-5"]."</div>".
            "</div></div></div>";
    }

    function printServiceBlock()
    {
        echo "<div class='contentBlock-frame'>".
            "<div class='contentBlock-center'><div class='contentBlock-wrap pop-services'>".
            "<h2>".$this->lang_map->pops["h2"]."</h2>".'<div class="container">'.
            "<div class='main'>".
            "<ul id='og-grid' class='og-grid'>";

        while ($popServices_row = $this->view_data->fetch(PDO::FETCH_ASSOC)){
            echo "<li>".
                "<span>".$popServices_row['cardName_'.$_SESSION[JS_SAIK]["lang"]]."</span>".
                "<a href='#' id='pop-".$popServices_row['cardAlias']."'
						data-largesrc='/img/Services/services/".$popServices_row['card_id']."/".$popServices_row['cardImg']."' 
						data-title='".$popServices_row['shortDescr_'.$_SESSION[JS_SAIK]["lang"]]."' 
						data-description='".$popServices_row['longDescr_'.$_SESSION[JS_SAIK]["lang"]]."' 
						data-buy='".$popServices_row['cardAlias']."' 
						data-lang='".$_SESSION[JS_SAIK]["lang"]."' 
						data-bought='<div>".$this->lang_map->pops["btn-buy"]." ";
            if(isset($_SESSION[JS_SAIK]['basket']['prod'][$popServices_row['cardAlias']])){
                echo $this->lang_map->pops["more-txt"];
            }
            echo "</div><label>".$popServices_row['cardPrice_'.$_SESSION[JS_SAIK]["lang"]]."</label> ".$popServices_row["cardCurr_".$_SESSION[JS_SAIK]["lang"]]."/".
                $popServices_row["unit_".$_SESSION[JS_SAIK]["lang"]]."'>".
                "<img src='/img/Services/images/thumbs/".$popServices_row['cardAlias'].".png' alt='pop-srv-icon'/>".
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
            "<div class='descr-line'><span>".$this->lang_map->contactsblock["address-f"].":</span> ".
            $this->lang_map->contactsblock["address-v"]."</div>".
            "<div class='descr-line'><span>".$this->lang_map->contactsblock["Schedule-f"].":</span> ".
            $this->lang_map->contactsblock["Schedule-v"]."</div>".
            "<div class='descr-line'><span>E-Mail:</span> rightjoint@yandex.ru</div>".
            "<div class='descr-line'><span>".$this->lang_map->contactsblock["phone-f"].":</span>".
            "<a href='tel:+7(903)8887772'> +7 (903) 888-7772</a></div>".
            "<div class='locPr-block'>".
            "<img src='/img/landing/contacts/small-img-yMap.png' class='active' onclick='changeContImg(0)'>".
            "<img src='/img/landing/contacts/sg-1-small.jpg' onclick='changeContImg(1)'>".
            "<img src='/img/landing/contacts/sg-2-small.jpg' onclick='changeContImg(2)'>".
            "</div>".
            "</div></div></div>";
    }

    function print_jointPass()
    {
        $promoteBlock_txt = "<h2 style='color: silver; margin-top: 1em'>".$this->lang_map->jointpass["h2"]."</h2>".
            "<div class='promote-block'>".
            "<div class='promote-block-title'>".
            "<div class='pbt-header'>".$this->lang_map->jointpass['title']."</div>".
            "<div class='pbt-numbers'><span>c#</span><span>wpf</span></div>".
            "</div>".
            "<div class='promote-block-content'>".
            "<div class='pbc-line f-left'>".
            "<img src='img/popimg/jointPass.png'>".
            "<p>".
            $this->lang_map->jointpass["p1"].
            "</p>".
            "<p>".
            $this->lang_map->jointpass["p2"].
            "</p>".
            "</div>".
            "<div class='pbc-line f-right'>".
            "<img src='img/Products/encrypt-img.png'>".
            "<p>".
            $this->lang_map->jointpass["p3"].
            "</p>".
            "<p>".
            $this->lang_map->jointpass["p4"].
            "</p>".
            "</div>".

            "</div>".
            "<div class='promote-block-order'>".
            "<div class='pbo-ctrl'><a href='/products/jointpass' class='pbo-ctrl-feedback' ".
            "title='".$this->lang_map->jointpass["a_title"]."'><img src='/img/Products/get-jp-icon.png'>".
            $this->lang_map->jointpass["a_text"]."</a></div>".
            "<div class='pbo-txt'><div class='pbc-arrow'></div>".$this->lang_map->jointpass["arrow"]."</div>".
            "</div>".
            "</div>";
        echo $promoteBlock_txt;
    }
}