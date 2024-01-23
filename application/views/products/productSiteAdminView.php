<?php
include "application/views/products/productSiteView.php";
class productSiteAdminView extends productSiteView
{
    public $logo="/img/popimg/admin-logo.png";

    function __construct()
    {
        parent::__construct();
        $this->lang_map["head"]["title"] = array(
            "en" => "jointSite - branch Admin",
            "rus" => "джойнтСайт - ветка Админ",
        );
        $this->lang_map["head"]["h1"] = array(
            "en" => "Web Site - branch Admin",
            "rus" => "Web site - ветка Админ",
        );
        $this->lang_map["prod_about"] = $this->lang_map["branches"]["list"]["admin"]["descr"];
    }

    function prod_info(){
        foreach ($this->branches as $b_name=>$b_info){
            $this->branches[$b_name]["href"] = "/products/jointsite/".$b_name;
        }
        echo "<div class='contentBlock-frame'><div class='contentBlock-center'>".
            "<div class='contentBlock-wrap'>".
            "<section>".
            "<h2 id='product-info'>Общая информация</h2>".
            "<div class='branches-block'>".
            "<p>Ветка админ наследуется от ветки Record для работы с записями в таблицах, ".
            "дополнена моделями и представления загрузки/выгрузки таблиц, выполнения SQL запросов и других целей</p>".

            "</section>".
            "</div></div></div>";
    }

}