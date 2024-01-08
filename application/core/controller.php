<?php
class Controller {
    public $model;
    public $view;

    public $lang_map;

    function __construct()
    {
        $this->model = new Model();
        $this->view = new View();
    }

    function action_index()
    {
        $this->view->view_data = $this->model->get_data();
        $this->view->is_db_conn = $this->model->sql_connection["connRes"];
        $this->view->generate();
    }
}