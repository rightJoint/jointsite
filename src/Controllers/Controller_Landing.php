<?php
namespace Src\Controllers;

use JointApp\Controllers\Controller;
use JointApp\JointAppQueryBuilder;

class Controller_Landing extends Controller
{
    public $artList = [];

    function actionIndex()
    {
        $this->view->serviceList = $this->model->getServiceList();
        $this->artList = $this->model->getBlogArts();
        $qBuilder = $this->blogTagsQBuilderWhere();

        $this->view->artTags = $this->model->getBlogTags($qBuilder);
        $this->view->artList = $this->artList;
    }

    private function blogTagsQBuilderWhere():JointAppQueryBuilder
    {
        $where_in = '';
        foreach ($this->artList as $num=>$artInfo){
            $where_in.='"'.$artInfo['art_id'].'", ';
        }

        $where_in = substr($where_in, 0, strlen($where_in)-2);
        $qBulder = new JointAppQueryBuilder();
        $qBulder->where('art_id in ('.$where_in.')');
        return $qBulder;
    }
}