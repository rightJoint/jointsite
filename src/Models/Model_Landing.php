<?php

namespace Src\Models;

use JointApp\Models\Model_Pdo;

class Model_Landing extends Model_Pdo
{
    function getServiceList():array
    {
        return $this->fetchToArray('select * from srvCards_dt WHERE cardActive is true order by sortDate DESC');
    }

    function lBasketAdd($cardAlias):void
    {
        $findProd_qry = 'select * from srvCards_dt where cardAlias="'.$cardAlias.'" and cardActive is true';
        $findProd_res = $this->query($findProd_qry);
        if(!isset($_SESSION['basket']['total'])){
            $_SESSION['basket']['total'] = 0;
        }
        if($findProd_row = $findProd_res->fetch(\PDO::FETCH_ASSOC)){
            if(isset($_SESSION['basket']['prod'][$findProd_row['cardAlias']])){
                $_SESSION['basket']['prod'][$findProd_row['cardAlias']] += 1;
            }else{
                $_SESSION['basket']['prod'][$findProd_row['cardAlias']] = 1;
            }

            $_SESSION['basket']['total'] +=
                $findProd_row['cardPrice_'.$this->langLw];
        }
    }
    function basketCalc():array
    {
        $basket_prod = array();
        if(isset($_SESSION['basket']['total']) and $_SESSION['basket']['total']>=1) {
            $_SESSION["basket"]["total"] = 0;
            foreach ($_SESSION['basket']['prod'] as $key => $val) {
                $findProd_qry = "select * from srvCards_dt where cardAlias='" . $key . "'";
                $findProd_res = $this->query($findProd_qry);
                if($findProd_row = $findProd_res->fetch(\PDO::FETCH_ASSOC)){
                    $basket_prod[] = $findProd_row;
                    $_SESSION['basket']['total'] +=
                        $findProd_row['cardPrice_'.$this->langLw]*$val;
                }
            }
        }
        return $basket_prod;
    }

}