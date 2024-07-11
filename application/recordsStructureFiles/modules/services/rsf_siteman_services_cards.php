<?php
class rsf_siteman_services_cards extends recordStructureFields
{
    function __construct()
    {
        $this->record = array(
            "card_id" => array(
                "format" => "int",
                "indexes" => true,
                "auto_increment" => true,

            ),

            "cardName_rus" => array(
                "format" => "varchar",
            ),
            "cardName_en" => array(
                "format" => "varchar",
            ),
            "cardAlias" => array(
                "format" => "varchar",
            ),
            "shortDescr_rus" => array(
                "format" => "varchar",
            ),
            "shortDescr_en" => array(
                "format" => "varchar",
            ),
            "longDescr_rus" => array(
                "format" => "TEXT",
            ),
            "longDescr_en" => array(
                "format" => "TEXT",
            ),
            "cardImg" => array(
                "format" => "varchar",
            ),
            "cardActive" => array(
                "format" => "tinyint",
            ),
            "cardPrice_rus" => array(
                "format" => "int",
            ),
            "cardPrice_en" => array(
                "format" => "int",
            ),
            "cardCurr_rus" => array(
                "format" => "varchar",
            ),
            "cardCurr_en" => array(
                "format" => "varchar",
            ),
            "sortDate" => array(
                "format" => "date",
            ),
            "unit_rus" => array(
                "format" => "varchar",
            ),
            "unit_en" => array(
                "format" => "varchar",
            ),
            /*
                        "add_date" => array(
                            "format" => "datetime",
                            "curVal" => date("Y-m-d H:i:s"),
                        ),
                        "template_params" => array(
                            "format" => "varchar",
                        ),
                        "send_params" => array(
                            "format" => "varchar",
                        ),
                        "send_date" => array(
                            "format" => "datetime",
                        ),
                        "created_by" => array(
                            "format" => "varchar",
                            "curVal" => $_SESSION["site_user"]["user_id"],
                        ),
                        "createdLogin" => array(
                            "format" => "varchar",
                            "use_table_name" => "udtcreated",
                            "curVal" => $_SESSION["site_user"]["accAlias"],
                        ),
                        "tName" => array(
                            "format" => "varchar",
                            "use_table_name" => "ntfTemplates_dt",
                        ),
                        "uName" => array(
                            "format" => "varchar",
                            "use_table_name" => "unionId",
                        ),
                        "send_res" => array(
                            "format" => "tinyint",
                        ),
                        "send_log" => array(
                            "format" => "varchar",
                        ),
            */
        );

        $this->listFields = array(
            "card_id" => array(
                "replaces" => array("card_id"),
                "format" => "hidden",
                /*"url" => "card_id=card_id",*/
            ),
            "btnDetail" => array(
                "format" => "link",
                "replaces" => array("card_id"),
                "url" => "card_id=card_id",
                "fieldAliases" => array(
                    "en" => "cardAlias",
                    "rus" => "cardAlias"
                ),
            ),
            "btnEdit" => array(
                "replaces" => array("card_id"),
                "format" => "link",
                "url" => "card_id=card_id",
            ),
            "btnDelete" => array(
                "replaces" => array("card_id"),
                "format" => "link",
                "url" => "card_id=card_id",
            ),
            "cardAlias" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "cardAlias",
                    "rus" => "cardAlias"
                ),
            ),
            "cardName_rus" => array(
                "format" => "varchar",
                "maxLength" => 20,
                "fieldAliases" => array(
                    "en" => "cardName_rus",
                    "rus" => "cardName_rus"
                ),
            ),
            "cardName_en" => array(
                "format" => "varchar",
                "maxLength" => 20,
                "fieldAliases" => array(
                    "en" => "cardName_rus",
                    "rus" => "cardName_rus"
                ),
            ),
            "cardImg" => array(
                "format" => "file",
                "file_options" => array(
                    "load_dir" => SERVICE_CARDS_IMG."/card_id/cardImg",
                    "file_type" => "img",
                ),
                "replaces" => array("card_id", "cardImg"),
                "fieldAliases" => array(
                    "en" => "cardImg",
                    "rus" => "cardImg",
                ),
            ),

            "cardActive" => array(
                "format" => "tinyint",
                "fieldAliases" => array(
                    "en" => "cardActive",
                    "rus" => "cardActive"
                ),
            ),
            "cardPrice_rus" => array(
                "format" => "int",
                "fieldAliases" => array(
                    "en" => "cardPrice_rus",
                    "rus" => "cardPrice_rus"
                ),
            ),
            "cardPrice_en" => array(
                "format" => "int",
                "fieldAliases" => array(
                    "en" => "cardPrice_en",
                    "rus" => "cardPrice_en"
                ),
            ),
            "cardCurr_rus" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "cardCurr_rus",
                    "rus" => "cardCurr_rus"
                ),
            ),
            "cardCurr_en" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "cardCurr_en",
                    "rus" => "cardCurr_en"
                ),
            ),
            "sortDate" => array(
                "format" => "date",
                "fieldAliases" => array(
                    "en" => "sortDate",
                    "rus" => "sortDate"
                ),
            ),
            "unit_rus" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "unit_rus",
                    "rus" => "unit_rus"
                ),
            ),
            "unit_en" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "unit_en",
                    "rus" => "unit_en"
                ),
            ),
        );

        $this->searchFields = array(
            "cardName_rus" => array(
                "format" => "varchar",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "cardName_rus",
                    "rus" => "cardName_rus"
                ),
            ),
            "cardName_en" => array(
                "format" => "varchar",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "cardName_rus",
                    "rus" => "cardName_rus"
                ),
            ),
        );

        $this->editFields = array(
            "card_id" => array(
                "format" => "hidden",
            ),
            "cardName_rus" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "cardName_rus",
                    "rus" => "cardName_rus"
                ),
            ),
            "cardName_en" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "cardName_en",
                    "rus" => "cardName_en"
                ),
            ),
            "cardAlias" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "cardAlias",
                    "rus" => "cardAlias"
                ),
            ),
            "shortDescr_rus" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "shortDescr_rus",
                    "rus" => "shortDescr_rus"
                ),
            ),
            "shortDescr_en" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "shortDescr_en",
                    "rus" => "shortDescr_en"
                ),
            ),
            "longDescr_rus" => array(
                "format" => "tinymce",
                "fieldAliases" => array(
                    "en" => "longDescr_rus",
                    "rus" => "longDescr_rus"
                ),
                "style" => array(
                    "class" => "wd100",
                ),
            ),
            "longDescr_en" => array(
                "format" => "tinymce",
                "fieldAliases" => array(
                    "en" => "longDescr_en",
                    "rus" => "longDescr_en"
                ),
                "style" => array(
                    "class" => "wd100",
                ),
            ),

            "cardImg" => array(
                "format" => "file",
                "file_options" => array(
                    "load_dir" => SERVICE_CARDS_IMG."/card_id/cardImg",
                    "file_type" => "img",
                    "accept" => ".jpg, .png",
                    "use_file_name" => 1,
                ),
                "replaces" => array("card_id", "cardImg"),
                "fieldAliases" => array(
                    "en" => "cardImg",
                    "rus" => "cardImg",
                ),
            ),
            "cardActive" => array(
                "format" => "tinyint",
                "fieldAliases" => array(
                    "en" => "cardActive",
                    "rus" => "cardActive",
                ),
            ),
            "cardPrice_rus" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "cardPrice_rus",
                    "rus" => "cardPrice_rus"
                ),
            ),
            "cardPrice_en" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "cardPrice_en",
                    "rus" => "cardPrice_en"
                ),
            ),
            "cardCurr_rus" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "cardCurr_rus",
                    "rus" => "cardCurr_rus"
                ),
            ),
            "cardCurr_en" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "cardCurr_en",
                    "rus" => "cardCurr_en"
                ),
            ),
            "sortDate" => array(
                "format" => "date",
                "fieldAliases" => array(
                    "en" => "sortDate",
                    "rus" => "sortDate"
                ),
            ),
            "unit_rus" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "unit_rus",
                    "rus" => "unit_rus"
                ),
            ),
            "unit_en" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "unit_en",
                    "rus" => "unit_en"
                ),
            ),
        );
        $this->viewFields = array(
            "card_id" => array(
                "format" => "hidden",
                "readonly" => true,
            ),
            "cardName_rus" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "cardName_rus",
                    "rus" => "cardName_rus"
                ),
                "readonly" => true,
            ),
            "cardName_en" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "cardName_en",
                    "rus" => "cardName_en"
                ),
                "readonly" => true,
            ),
            "cardAlias" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "cardAlias",
                    "rus" => "cardAlias"
                ),
                "readonly" => true,
            ),
            "shortDescr_rus" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "shortDescr_rus",
                    "rus" => "shortDescr_rus"
                ),
                "readonly" => true,
            ),
            "shortDescr_en" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "shortDescr_en",
                    "rus" => "shortDescr_en"
                ),
                "readonly" => true,
            ),
            "longDescr_rus" => array(
                "format" => "tinymce",
                "fieldAliases" => array(
                    "en" => "longDescr_rus",
                    "rus" => "longDescr_rus"
                ),
                "style" => array(
                    "class" => "wd100",
                ),
                "readonly" => true,
            ),
            "longDescr_en" => array(
                "format" => "tinymce",
                "fieldAliases" => array(
                    "en" => "longDescr_en",
                    "rus" => "longDescr_en"
                ),
                "style" => array(
                    "class" => "wd100",
                ),
                "readonly" => true,
            ),

            "cardImg" => array(
                "format" => "file",
                "file_options" => array(
                    "load_dir" => SERVICE_CARDS_IMG."/card_id/cardImg",
                    "file_type" => "img",
                    "accept" => ".jpg, .png",
                    "use_file_name" => 1,
                ),
                "replaces" => array("card_id", "cardImg"),
                "fieldAliases" => array(
                    "en" => "cardImg",
                    "rus" => "cardImg",
                ),
                "readonly" => true,
            ),
            "cardActive" => array(
                "format" => "tinyint",
                "fieldAliases" => array(
                    "en" => "cardActive",
                    "rus" => "cardActive",
                ),
                "readonly" => true,
            ),
            "cardPrice_rus" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "cardPrice_rus",
                    "rus" => "cardPrice_rus"
                ),
                "readonly" => true,
            ),
            "cardPrice_en" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "cardPrice_en",
                    "rus" => "cardPrice_en"
                ),
                "readonly" => true,
            ),
            "cardCurr_rus" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "cardCurr_rus",
                    "rus" => "cardCurr_rus"
                ),
                "readonly" => true,
            ),
            "cardCurr_en" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "cardCurr_en",
                    "rus" => "cardCurr_en"
                ),
                "readonly" => true,
            ),
            "sortDate" => array(
                "format" => "date",
                "fieldAliases" => array(
                    "en" => "sortDate",
                    "rus" => "sortDate"
                ),
                "readonly" => true,
            ),
            "unit_rus" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "unit_rus",
                    "rus" => "unit_rus"
                ),
                "readonly" => true,
            ),
            "unit_en" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "unit_en",
                    "rus" => "unit_en"
                ),
                "readonly" => true,
            ),
        );
    }
}
