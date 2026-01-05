<?php


namespace JointApp\Controllers\Components;


use JointApp\Controllers\ModuleController;
use JointApp\Models\Components\Model_Components_KipTasks;
use JointApp\Views\Records\RecordListView;

class Controller_Components_KipTasks extends ModuleController
{

    public string $moduleName = 'kiptasks';

    public string $processUri = '/siteman/kiptasks';

    public function loadBindComponents(): void
    {
        $this->bindComponents = array(
            "kipnotes" => array(
                "relationships" => array(
                    "id" => "taskid",
                ),
                'model' => 'JointApp\Models\Components\Model_Components_KipNotes',
                'controller' => 'JointApp\Controllers\Components\Controller_Components_KipNotes'
            ),
        );
    }

    public function prepareSearchFields(): void
    {
        $this->searchFields = array(
            'object' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
            ),
            'system' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
            ),
            'subsystem' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
            ),
            'tasktype' => array(
                'format' => 'varchar',
                'search' => 1,
                'sort' => 1,
            ),
            'created_date' => array(
                'format' => 'varchar',
                'search' => 0,
                'sort' => 1,
            ),
        );

    }

    public function prepareEditFields(): void
    {
        $this->editFields = array(
            'id' => array(
                'pri' => 1,
                'format' => 'varchar',
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
                'curVal' => '121212-212wqweqwe',
            ),
            'created_by' => array(
                'format' => 'varchar',
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
                'format' => 'varchar',
                'curVal' => '',
            ),
            'subsystem' => array(
                'format' => 'varchar',
                'curVal' => '',
            ),
            'tasktype' => array(
                'format' => 'select',
                'filling' => $this->fillKipTaskTypes(),
            ),
        );
    }

    public function fillKipObjects():array
    {
        $return = array(
            'onvs-1' => 'ОНВС-1',
            'onvs-2' => 'ОНВС-2',
            'gts' => 'ГТС (Плотина)',
            'strokino' => 'Строкино',
            'penki' => 'Пеньки',
            'all' => 'Все объекты',
        );

        return $return;

    }

    public function fillKipTaskTypes():array
    {
        $return = array(
            'kip' => 'КИП',
            'privod' => 'Электропривод',
            'video' => 'Видеонаблюдение',
            'lso' => 'ЛСО',
            'skud' => 'СКУД',
            'ops' => 'ОПС',
            'ventolation' => 'Вентиляция',
            'others' => 'Прочее',
        );

        return $return;

    }

    public function fillKipTaskStatus():array
    {
        $return = array(
            'new' => 'Новая',
            'control' => 'На контроле',
            'Completed' => 'Завершено',
            'in progress' => 'В работе',
            'postpone' => 'Отложено',
        );
        return $return;

    }

    public function fillKipPriority():array
    {
        $return = array(
            'normal' => 'Нормальный',
            'high' => 'Высокий',
            'very high' => 'Срочно',
            'low' => 'Низкий',
            'very low' => 'Очень низкая',
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