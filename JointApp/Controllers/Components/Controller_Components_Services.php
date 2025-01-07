<?php


namespace JointApp\Controllers\Components;


use JointApp\Controllers\ModuleController;

class Controller_Components_Services extends ModuleController
{

    public string $moduleName = 'services';

    public string $processUri = '/siteman/services';

    public function loadBindComponents(): void
    {
        /*$this->bindComponents = array(
            "userstogroups" => array(
                "relationships" => array(
                    "user_id" => "user_id",
                ),
            ),
            "users" => [],
        );*/
    }

    public function loadLangController():string
    {
        parent::loadLangController();
        $name = 'LangFiles_'.$this->langNs.'_Controller_Components_Services';
        require_once $this->docRoot.'/JointApp/LangFiles/Controllers/Components/'.$name.'.php';
        return $name;
    }

    public function prepareEditFields(): void
    {
        $this->editFields = array(
            'card_id' => array(
                'pri' => true,
                'format' => 'int',
                'readonly' => true,
                'curVal' => '',
            ),
            'cardName_ru' => array(
                'format' => 'varchar',
                'curVal' => '',
            ),
            'cardName_en' => array(
                'format' => 'varchar',
                'curVal' => '',
            ),
            'cardAlias' => array(
                'format' => 'varchar',
                'curVal' => '',
            ),
            'shortDescr_ru' => array(
                'format' => 'text',
                'curVal' => '',
            ),
            'shortDescr_en' => array(
                'format' => 'text',
                'curVal' => '',
            ),
            'longDescr_ru' => array(
                'format' => 'text',
                'curVal' => '',
            ),
            'longDescr_en' => array(
                'format' => 'text',
                'curVal' => '',
            ),
            'cardImg' => array(
                'format' => 'varchar',
                'curVal' => '',
            ),
            'cardActive' => array(
                'format' => 'tinyint',
                'curVal' => '',
            ),
            'cardPrice_ru' => array(
                'format' => 'int',
                'curVal' => '',
            ),
            'cardPrice_en' => array(
                'format' => 'int',
                'curVal' => '',
            ),
            'cardCurr_ru' => array(
                'format' => 'varchar',
                'curVal' => '',
            ),
            'cardCurr_en' => array(
                'format' => 'varchar',
                'curVal' => '',
            ),
            'sortDate' => array(
                'format' => 'date',
                'curVal' => '',
            ),
            'unit_ru' => array(
                'format' => 'varchar',
                'curVal' => '',
            ),
            'unit_en' => array(
                'format' => 'varchar',
                'curVal' => '',
            ),
            'created_by' => array(
                'format' => 'varchar',
                'curVal' => '',
            ),
            'createdUser' => array(
                'format' => 'varchar',
                'curVal' => '',
            ),
        );
    }

    public function prepareSearchFields(): void
    {
        $this->searchFields = array(
            'card_id' => array(
                'format' => 'int',
                'search' => true,
                'sort' => true,
            ),
            'cardName_ru' => array(
                'format' => 'varchar',
                'search' => true,
                'sort' => true,
            ),
            'cardName_en' => array(
                'format' => 'varchar',
                'search' => true,
                'sort' => true,
            ),
            'cardAlias' => array(
                'format' => 'varchar',
                'search' => true,
                'sort' => true,
            ),
            'shortDescr_ru' => array(
                'format' => 'text',
                'search' => true,
                'sort' => true,
            ),
            'shortDescr_en' => array(
                'format' => 'text',
                'search' => true,
                'sort' => true,
            ),
            'longDescr_ru' => array(
                'format' => 'text',
                'search' => true,
                'sort' => true,
            ),
            'longDescr_en' => array(
                'format' => 'text',
                'search' => true,
                'sort' => true,
            ),
            'cardImg' => array(
                'format' => 'varchar',
                'search' => true,
                'sort' => true,
            ),
            'cardActive' => array(
                'format' => 'tinyint',
                'search' => true,
                'sort' => true,
            ),
            'cardPrice_ru' => array(
                'format' => 'int',
                'search' => true,
                'sort' => true,
            ),
            'cardPrice_en' => array(
                'format' => 'int',
                'search' => true,
                'sort' => true,
            ),
            'cardCurr_ru' => array(
                'format' => 'varchar',
                'search' => true,
                'sort' => true,
            ),
            'cardCurr_en' => array(
                'format' => 'varchar',
                'search' => true,
                'sort' => true,
            ),
            'sortDate' => array(
                'format' => 'date',
                'search' => true,
                'sort' => true,
            ),
            'unit_ru' => array(
                'format' => 'varchar',
                'search' => true,
                'sort' => true,
            ),
            'unit_en' => array(
                'format' => 'varchar',
                'search' => true,
                'sort' => true,
            ),
            'created_by' => array(
                'format' => 'varchar',
                'search' => true,
                'sort' => true,
            ),
            'createdUser' => array(
                'format' => 'varchar',
                'search' => true,
                'sort' => true,
            ),
        );
    }

    public function prepareListFields(): void
    {
        $this->listFields = array(
            'btnDetail' => array(
                'replaces' => ['card_id'],
                'format' => 'link',
                'url' => 'card_id=card_id',
            ),
            'btnEdit' => array(
                'replaces' => ['card_id'],
                'format' => 'link',
                'url' => 'card_id=card_id',
            ),
            'btnDelete' => array(
                'replaces' => ['card_id'],
                'format' => 'link',
                'url' => 'card_id=card_id',
            ),
            'card_id' => array(
                'format' => 'int',
            ),
            'cardName_ru' => array(
                'format' => 'varchar',
            ),
            'cardName_en' => array(
                'format' => 'varchar',
            ),
            'cardAlias' => array(
                'format' => 'varchar',
            ),
            'shortDescr_ru' => array(
                'format' => 'text',
                'max_length' => 10,
            ),
            'shortDescr_en' => array(
                'format' => 'text',
                'max_length' => 10,
            ),
            'longDescr_ru' => array(
                'format' => 'text',
                'max_length' => 10,
            ),
            'longDescr_en' => array(
                'format' => 'text',
                'max_length' => 10,
            ),
            'cardImg' => array(
                'format' => 'varchar',
            ),
            'cardActive' => array(
                'format' => 'tinyint',
            ),
            'cardPrice_ru' => array(
                'format' => 'int',
            ),
            'cardPrice_en' => array(
                'format' => 'int',
            ),
            'cardCurr_ru' => array(
                'format' => 'varchar',
            ),
            'cardCurr_en' => array(
                'format' => 'varchar',
            ),
            'sortDate' => array(
                'format' => 'date',
            ),
            'unit_ru' => array(
                'format' => 'varchar',
            ),
            'unit_en' => array(
                'format' => 'varchar',
            ),
            'created_by' => array(
                'format' => 'varchar',
            ),
        );
    }


}