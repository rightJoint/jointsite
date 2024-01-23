<?php
class controller_products extends Controller
{
    function action_index()
    {
        include "application/views/products/view_products.php";
        $this->view = new view_products();
        $this->view->generate();
    }

    function action_jointsite()
    {
        global $routes;
        if(!$routes["3"]){
            include "application/views/products/productSiteView.php";
            $this->view = new productSiteView();
            $this->view->generate();
        }elseif ($routes["3"] == "music"){
            include "application/views/products/productSiteMusicView.php";
            $this->view = new productSiteMusicView();
            $this->view->generate();
        }elseif ($routes["3"] == "module"){
            include "application/views/products/productSiteModuleView.php";
            $this->view = new productSiteModuleView();
            $this->view->generate();
        }elseif ($routes["3"] == "admin"){
            include "application/views/products/productSiteAdminView.php";
            $this->view = new productSiteAdminView();
            $this->view->generate();
        }elseif ($routes["3"] == "record"){
            include "application/views/products/productSiteRecordView.php";
            $this->view = new productSiteRecordView();
            $this->view->generate();
        }else{
            throwErr("request", "product not exist in controller product");
        }


    }
}