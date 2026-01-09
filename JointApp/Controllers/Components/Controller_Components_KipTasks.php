<?php


namespace JointApp\Controllers\Components;


use JointApp\Controllers\ModuleController;

class Controller_Components_KipTasks extends ModuleController
{

    public string $moduleName = 'kiptasks';

    public string $processUri = '/siteman/kiptasks';

    public function loadBindComponents(): void
    {
        $this->bindComponents = array(
            'kipnotes' => array(
                'relationships' => array(
                    'id' => 'taskid',
                ),
                'model' => 'JointApp\Models\Components\Model_Components_KipNotes',
                'controller' => 'JointApp\Controllers\Components\Controller_Components_KipNotes'
            ),
            'kipplan'=>[],
            'kipreport'=>[],
        );
    }

    public function loadLangController():string
    {
        parent::loadLangController();
        $name = 'LangFiles_'.$this->langNs.'_Controller_Components_KipTasks';
        require_once $this->docRoot.'/JointApp/LangFiles/Controllers/Components/'.$name.'.php';
        return $name;
    }

    public function prepareSearchFields(): void
    {
        $this->searchFields = array(
            'created_date' => array(
                'format' => 'varchar',
                'search' => 0,
                'sort' => 1,
                'sortOrder' => 'DESC',
            ),
            'object' => array(
                'format' => 'select',
                'filling' => $this->fillKipObjects(),
                'search' => 1,
                'sort' => 1,
            ),
            'system' => array(
                'format' => 'select',
                'filling' => $this->fillKipSystem(),
                'search' => 1,
                'sort' => 1,
            ),
            'subsystem' => array(
                'format' => 'hidden',
                'search' => 1,
                'sort' => 1,
            ),
            'tasktype' => array(
                'format' => 'select',
                'filling' => $this->fillKipTaskTypes(),
                'search' => 1,
                'sort' => 1,
            ),
            'priority' => array(
                'format' => 'select',
                'filling' => $this->fillKipPriority(),
                'search' => 1,
                'sort' => 1,
            ),
            'status' => array(
                'format' => 'select',
                'filling' => $this->fillKipTaskStatus(),
                'search' => 1,
                'sort' => 1,
            ),
        );

    }

    public function prepareEditFields(): void
    {
        $this->editFields = array(
            'id' => array(
                'pri' => 1,
                'format' => 'hidden',
                'curVal' => '',
            ),
            'title' => array(
                'format' => 'varchar',
                'curVal' => '',
                'style' => array(
                    'class' => 'wd100',
                ),
            ),
            'descr' => array(
                'format' => 'tinymce',
                'id' => 'descr',
                'curVal' => '',
                'style' => array(
                    'class' => 'wd100',
                ),
            ),
            'created_date' => array(
                'format' => 'varchar',
                'curVal' => '',
            ),
            'created_by' => array(
                'format' => 'hidden',
                'curVal' => '',
            ),
            'priority' => array(
                'format' => 'select',
                'filling' => $this->fillKipPriority(),
            ),
            'status' => array(
                'format' => 'select',
                'filling' => $this->fillKipTaskStatus(),
            ),
            'progress' => array(
                'format' => 'int',
                'curVal' => '',
            ),
            'object' => array(
                'format' => 'select',
                'filling' => $this->fillKipObjects(),
            ),
            'system' => array(
                'format' => 'select',
                'filling' => $this->fillKipSystem(),
            ),
            'subsystem' => array(
                'format' => 'hidden',
                'curVal' => '',
            ),
            'tasktype' => array(
                'format' => 'select',
                'filling' => $this->fillKipTaskTypes(),
            ),
            'created_name' => array(
                'format' => 'varchar',
                'curVal' => '',
                'readonly' => 1,
            ),
        );
    }

    public function prepareListFields(): void
    {
        $this->listFields = array(
            'btnDetail' => array(
                'replaces' => ['id'],
                'format' => 'link',
                'url' => 'id=id',
            ),
            'btnEdit' => array(
                'replaces' => ['id'],
                'format' => 'link',
                'url' => 'id=id',
            ),
            'btnDelete' => array(
                'replaces' => ['id'],
                'format' => 'link',
                'url' => 'id=id',
            ),
            'id' => array(
                'format' => 'hidden',
            ),
            'tasktype' => array(
                'format' => 'select',
                'filling' => $this->fillKipTaskTypes(),
            ),
            'title' => array(
                'format' => 'varchar',
            ),
            'object' => array(
                'format' => 'select',
                'filling' => $this->fillKipObjects(),
            ),
            'system' => array(
                'format' => 'select',
                'filling' => $this->fillKipSystem(),
            ),
            'subsystem' => array(
                'format' => 'hidden',
            ),
            'priority' => array(
                'format' => 'select',
                'filling' => $this->fillKipPriority(),
            ),
            'status' => array(
                'format' => 'select',
                'filling' => $this->fillKipTaskStatus(),
            ),
            'progress' => array(
                'format' => 'int',
            ),
            'created_date' => array(
                'format' => 'date',
            ),
            'created_by' => array(
                'format' => 'hidden',
            ),
            'created_name' => array(
                'format' => 'varchar',
            ),
            'descr' => array(
                'format' => 'hidden',
                'max_length' => 10,
            ),
        );
    }

    public function prepareViewFields(): void
    {
        $this->viewFields = array(
            'id' => array(
                'pri' => true,
                'format' => 'hidden',
                'readonly' => 1,
            ),
            'title' => array(
                'format' => 'detailvarchar',
                'readonly' => 1,
                'style' => array(
                    'class' => 'wd100 title',
                ),
            ),
            'descr' => array(
                'format' => 'mcedetailframe',
                'id' => 'descr',
                'curVal' => '',
                'style' => array(
                    'class' => 'wd100',
                ),
                'readonly' => 1,
            ),
            'created_date' => array(
                'format' => 'detailvarchar',
                'readonly' => 1,
            ),
            'created_by' => array(
                'format' => 'hidden',
                'readonly' => 1,
            ),
            'priority' => array(
                'format' => 'detailselect',
                'filling' => $this->fillKipPriority(),
                'readonly' => 1,
            ),
            'status' => array(
                'format' => 'detailselect',
                'filling' => $this->fillKipTaskStatus(),
                'readonly' => 1,
            ),
            'progress' => array(
                'format' => 'detailvarchar',
                'readonly' => 1,
            ),
            'object' => array(
                'format' => 'detailselect',
                'filling' => $this->fillKipObjects(),
                'readonly' => 1,
            ),
            'system' => array(
                'format' => 'detailselect',
                'filling' => $this->fillKipSystem(),
                'readonly' => 1,
            ),
            'tasktype' => array(
                'format' => 'detailselect',
                'filling' => $this->fillKipTaskTypes(),
                'readonly' => 1,
            ),
            'created_name' => array(
                'format' => 'detailvarchar',
                'readonly' => 1,
            ),
        );
    }

    public static function fillKipObjects():array
    {
        $return = array(
            'onvs-1' => 'ОНВС-1',
            'onvs-2' => 'ОНВС-2',
            'gts' => 'ГТС (Плотина)',
            'strokino' => 'Строкино',
            'penki' => 'Пеньки',
            'all' => 'Все объекты',
            '' => 'Любой объект',
        );

        return $return;

    }

    public static function fillKipTaskTypes():array
    {
        $return = array(
            'kip' => 'КИП',
            'privod' => 'Электропривод',
            'video' => 'Видеонаблюдение',
            'lso' => 'ЛСО',
            'skud' => 'СКУД',
            'ops' => 'ОПС',
            'ventolation' => 'Вентиляция',
            'other' => 'другой',
            '' => 'Любой тип',
        );

        return $return;

    }

    public static function fillKipTaskStatus():array
    {
        $return = array(
            'new' => 'Новая',
            'control' => 'На контроле',
            'Completed' => 'Завершено',
            'in progress' => 'В работе',
            'postpone' => 'Отложено',
            '' => 'Любой статус',
        );
        return $return;

    }

    public static function fillKipPriority():array
    {
        $return = array(
            'normal' => 'Нормальный',
            'high' => 'Высокий',
            'very high' => 'Срочно',
            'low' => 'Низкий',
            'very low' => 'Очень низкая',
            '' => 'Любая важность',
        );
        return $return;

    }

    public static function fillKipSystem():array
    {
        $return = array(
            'onvs-1-1thHPS' => '1й подъем',
            'onvs-1-2thHPS-old' => '2й подъем страрый',
            'onvs-1-2thHPS-new' => '2й подъем новый',
            'onvs-1-abk-1' => 'АБК-1',
            'onvs-1-abk-2' => 'АБК-2',
            'onvs-1-filters-1b' => 'Фильтра 1й блок',
            'onvs-1-filters-new' => 'Фильтра 2й блок',
            'onvs-1-guards' => 'Проходная',
            'onvs-2-heater' => 'Котельная',
            'onvs-2-labor' => 'Лаборатория',
            'gts' => 'ГТС (Плотина)',
            'strokino' => 'Строкино',
            'penki' => 'Пеньки',
            'all' => 'Все системы',
            '' => 'Любая система',
        );
        return $return;

    }

    public function updateEditFieldsFromRecord():bool
    {
        parent::updateEditFieldsFromRecord();

        if(empty($this->editFields['created_date']['curVal'])){
            $this->editFields['created_date']['curVal'] = date('Y-m-d H:i:s');
        }

        return 1;
    }
}