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
        $this->lang_map["product-deploy"]["install"]["checkout-branch"] = array(
            "en" => "Record",
            "rus" => "Record",
        );
        $this->lang_map["product-deploy"]["install"]["example-text"] = array(
            "en" => "",
            "rus" => "клонирование репозитория и переключение на ветку <span class='ex-conf'>Record</span>",
        );
        $this->lang_map["product-info"]["h2_common"] = array(
            "en" => "",
            "rus" => "Общая информация",
        );
        $this->lang_map["prod_info_custom"]["p1"] = array(
            "en" => "",
            "rus" => "Это родительская ветка сайта, от нее наследуются остальные. В модели реальзованы основные операции работы записями в таблиц БД",
        );
    }

    function prod_info_custom()
    {
        echo "<p>".
            $this->lang_map["prod_info_custom"]["p1"][$_SESSION["lang"]].
            "</p>";
    }

    function prod_deploy_migrations()
    {
        echo "<h3>".$this->lang_map["product-migration"]["h3"][$_SESSION["lang"]]."</h3>".
            "<p>Миграций не требуется</p>";
    }
}