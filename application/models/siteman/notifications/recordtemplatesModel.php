<?php
class recordtemplatesModel extends ModuleRecordsModel
{
    public $tableName = "ntfTemplates_dt";
    public $modelAliases = array(
        "en" => "eMail templates",
        "rus" => "Шаблоны уведомлений",
    );

    public function getRecordStructure()
    {
        $this->record = array(
            "template_id" => array(
                "indexes" => 1,
                "format" => "varchar",
            ),
            "tName" => array(
                "format" => "varchar",
            ),
            "tHeader_en" => array(
                "format" => "varchar",
            ),
            "tHeader_rus" => array(
                "format" => "varchar",
            ),
            "tBody_en" => array(
                "format" => "text",
            ),
            "tBody_rus" => array(
                "format" => "text",
            ),
            "date_created" => array(
                "format" => "datetime",
                "curVal" => date("Y-m-d H:i:s"),
            ),
            "created_by" => array(
                "format" => "varchar",
                "curVal" => $_SESSION["site_user"]["user_id"],
            ),
            "createdLogin" => array(
                "format" => "varchar",
                "use_table_name" => "udtcreated",
                "curVal" => $_SESSION["site_user"]["accLogin"],
            ),
        );
        $this->editFields = array(
            "template_id" => array(
                "indexes" => 1,
                "format" => "hidden",
                "fieldAliases" => array(
                    "en" => "template id",
                    "rus" => "id шаблона",
                ),
            ),
            "tName" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "template name",
                    "rus" => "Назв. шаблона",
                ),
            ),
            "tHeader_en" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "subject-en",
                    "rus" => "Тема-en",
                ),
            ),
            "tHeader_rus" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "subject-rus",
                    "rus" => "Тема-rus",
                ),
            ),
            "tBody_en" => array(
                "format" => "tinymce",
                "fieldAliases" => array(
                    "en" => "body-en",
                    "rus" => "Тело-en",
                ),
                "id" => "tBody_en",
                "style" => array(
                    "class" => "wd100",
                ),
            ),
            "tBody_rus" => array(
                "format" => "tinymce",
                "fieldAliases" => array(
                    "en" => "body-rus1",
                    "rus" => "Тело-rus",
                ),
                "id" => "tBody_rus",
                "style" => array(
                    "class" => "wd100",
                ),
            ),
            "date_created" => array(
                "format" => "varchar",
                "readonly" => true,
                "fieldAliases" => array(
                    "en" => "created",
                    "rus" => "Создано",
                ),
            ),
            "created_by" => array(
                "format" => "hidden",
                "readonly" => true,
                "fieldAliases" => array(
                    "en" => "Created by",
                    "rus" => "Создал(а)",
                ),
            ),
            "createdLogin" => array(
                "format" => "varchar",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "Owner",
                    "rus" => "Владелец",
                ),
            ),
        );


        $this->listFields = array (
            "btnDetail" => array(
                "replaces" => array("template_id"),
                "format" => "link",
                "url" => "template_id=template_id",
            ),
            "btnEdit" => array(
                "replaces" => array("template_id"),
                "format" => "link",
                "url" => "template_id=template_id",
            ),
            "btnDelete" => array(
                "replaces" => array("template_id"),
                "format" => "link",
                "url" => "template_id=template_id",
            ),
            "template_id" => array(
                "indexes" => 1,
                "format" => "hidden",
                "maxLength" => 20,
            ),
            "tName" => array(
                "format" => "varchar",
                "maxLength" => 20,
                "fieldAliases" => array(
                    "en" => "template name",
                    "rus" => "Назв. шаблона",
                ),
            ),
            "tHeader_en" => array(
                "format" => "varchar",
                "maxLength" => 20,
                "fieldAliases" => array(
                    "en" => "subject-en",
                    "rus" => "Тема-en",
                ),
            ),
            "tHeader_rus" => array(
                "format" => "varchar",
                "maxLength" => 20,
                "fieldAliases" => array(
                    "en" => "subject-rus",
                    "rus" => "Тема-rus",
                ),
            ),
            "date_created" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "created",
                    "rus" => "Создано",
                ),
            ),
            "createdLogin" => array(
                "format" => "varchar",
                "fieldAliases" => array(
                    "en" => "Owner",
                    "rus" => "Владелец",
                ),
            ),
        );

        $this->searchFields = array(
            "date_created" => array(
                "format" => "hidden",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "Dt created",
                    "rus" => "Создано",
                ),
            ),
            "tName" => array(
                "format" => "varchar",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "template name",
                    "rus" => "Назв. шаблона",
                ),
            ),
            "tHeader_en" => array(
                "format" => "varchar",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "subject-en",
                    "rus" => "Тема-en",
                ),
            ),
            "tHeader_rus" => array(
                "format" => "varchar",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "subject-rus",
                    "rus" => "Тема-rus",
                ),
            ),
            "createdLogin" => array(
                "format" => "varchar",
                "sort" => 1,
                "search" => 1,
                "fieldAliases" => array(
                    "en" => "Owner",
                    "rus" => "Владелец",
                ),
                "use_table_name" => "udtcreated",
                "use_field_name" => "accLogin",
            ),
        );
        $this->viewFields = array(
            "tName" => array(
                "format" => "varchar",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "template name",
                    "rus" => "Назв. шаблона",
                ),
            ),
            "tHeader_en" => array(
                "format" => "varchar",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "subject-en",
                    "rus" => "Тема-en",
                ),
            ),
            "tHeader_rus" => array(
                "format" => "varchar",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "subject-rus",
                    "rus" => "Тема-rus",
                ),
            ),
            "tBody_en" => array(
                "format" => "text-block",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "body-en",
                    "rus" => "Тело-en",
                ),
                "id" => "tBody_en",
                "style" => array(
                    "class" => "wd100",
                ),

            ),
            "tBody_rus" => array(
                "format" => "text-block",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "body-rus",
                    "rus" => "Тело-rus",
                ),
                "id" => "tBody_rus",
                "style" => array(
                    "class" => "wd100",
                ),
            ),
            "date_created" => array(
                "format" => "varchar",
                "readonly" => true,
                "fieldAliases" => array(
                    "en" => "created",
                    "rus" => "Создано",
                ),
            ),
            "created_by" => array(
                "format" => "hidden",
                "readonly" => true,
                "fieldAliases" => array(
                    "en" => "Created by",
                    "rus" => "Создал(а)",
                ),
            ),
            "createdLogin" => array(
                "format" => "varchar",
                "readonly" => 1,
                "fieldAliases" => array(
                    "en" => "Owner",
                    "rus" => "Владелец",
                ),
            ),
        );
    }

    function countRecords($where = null)
    {
        $countList_qry = "select count(".
            $this->tableName.".template_id) as cnt ".
            "from ".$this->tableName." ".
            "left join users_dt udtcreated on ".$this->tableName.".created_by = udtcreated.user_id";
        return $this->query($countList_qry." ".$where)->fetch(PDO::FETCH_ASSOC)["cnt"];
    }


    public function listRecords($where = null, $order = null, $limit = null)
    {
        $findList_qry = "select ".
            $this->tableName.".template_id, ".
            $this->tableName.".tName, ".
            $this->tableName.".tHeader_en, ".
            $this->tableName.".tHeader_rus, ".
            $this->tableName.".tBody_en, ".
            $this->tableName.".tBody_rus, ".
            $this->tableName.".date_created, ".
            $this->tableName.".created_by, ".
            "udtcreated.accLogin as createdLogin ".
            "from ".$this->tableName." ".
            "left join users_dt udtcreated on ".$this->tableName.".created_by = udtcreated.user_id ".
            $where.$order.$limit;

        return $this->fetchToArray($findList_qry);
    }

    public function copyRecord()
    {
        if(parent::copyRecord()){
            $createdLogin_qry = "select accLogin from users_dt where user_id='".$this->record["created_by"]["curVal"]."'";
            $createdLogin_res = $this->query($createdLogin_qry);
            if($createdLogin_res->rowCount()===1){
                $createdLogin_row = $createdLogin_res->fetch(PDO::FETCH_ASSOC);
                $this->record["createdLogin"]["curVal"] = $createdLogin_row["accLogin"];
                return true;
            }
            return true;
        }else{
            return false;
        }
    }
}