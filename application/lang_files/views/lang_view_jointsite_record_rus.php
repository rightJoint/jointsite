<?php
class lang_view_jointsite_record_rus extends lang_view_products_jointsite_rus
{
    function __construct()
    {
        parent::__construct();

        $this->head["description"] = $this->head["h1"].". ".$this->head["title"];

        $this->product_custom["p1"] = "Record содержит контроллер, модель и представления для работы с записями ".
            "в таблицах базы данных. Все core-ветки, как и Record будут вливаться в ветку main.";
        $this->product_deploy["install"]["checkout-branch"] = "main";
        $this->product_deploy["install"]["example-text"] = "клонирование репозитория и переключение на ветку ".
            "(<strong>".$this->product_deploy["install"]["checkout-branch"]."</strong>)";

        $this->product_config = array(
            "h3" => "Конфигурирование",
            "p1" => "Все основные настройки приложения по умолчанию находятся в каталоге  <span class='ex-conf'>__config</span>. ",
            "p2" => "В этой ветке никаких дополнительных настроек не требуется.",
            "p3" => "В этой ветке никаких дополнительных настроек не требуется.",
        );
        $this->prod_test = array(
            "p1" => "Проверить работу приложения можно на <a href='".JOINT_SITE_EXEC_DIR."/test/main' ".
                "title='Как работает на тесте'>Проверить приложение</a>, но в этой ветке только шаблоны, которые не интересно проверять.",

        );
    }


}