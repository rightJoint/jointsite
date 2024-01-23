<?php
include "application/views/products/productSiteView.php";
class productSiteRecordView extends productSiteView
{
    public $logo="/img/popimg/record.png";

    function __construct()
    {
        parent::__construct();
        $this->lang_map["head"]["title"] = array(
            "en" => "jointSite - branch Record",
            "rus" => "джойнтСайт - ветка Запись",
        );
        $this->lang_map["head"]["h1"] = array(
            "en" => "Web Site - branch Record",
            "rus" => "Web site - ветка Запись",
        );
        $this->lang_map["prod_about"] = $this->lang_map["branches"]["list"]["record"]["descr"];
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
            "<p>Это родительская ветка сайта, от нее наследуются остальные. В модели реальзованы основные операции работы записями в таблиц БД</p>".
            "</section>".
            "</div></div></div>";
    }
}