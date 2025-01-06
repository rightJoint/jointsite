<?php

namespace Src\Models;

use JointApp\Models\Model_Pdo;

class Model_Landing extends Model_Pdo
{
    function getServiceList()
    {
        return $this->fetchToArray("select * from srvCards_dt WHERE cardActive is true order by sortDate DESC");
    }

    function lBasketAdd()
    {
        $findProd_qry = "select * from srvCards_dt where cardAlias='".$_GET['lBasketAdd']."' and cardActive is true";
        $findProd_res = $this->query($findProd_qry);
        if(!isset($_SESSION[$this->langLw]["basket"]["total"])){
            $_SESSION[$this->langLw]["basket"]["total"] = 0;
        }
        if($findProd_row = $findProd_res->fetch(PDO::FETCH_ASSOC)){
            if(isset($_SESSION[$this->langLw]['basket']['prod'][$findProd_row['cardAlias']])){
                $_SESSION[$this->langLw]['basket']['prod'][$findProd_row['cardAlias']] += 1;
            }else{
                $_SESSION[$this->langLw]['basket']['prod'][$findProd_row['cardAlias']] = 1;
            }

            $_SESSION[$this->langLw]["basket"]["total"] +=
                $findProd_row['cardPrice_'.$_SESSION[$this->langLw]["lang"]];
        }
    }
    function basketCalc(){
        $basket_prod = array();
        if(isset($_SESSION[$this->langLw]['basket']['total']) and $_SESSION[$this->langLw]['basket']['total']>=1) {
            $_SESSION[$this->langLw]["basket"]["total"] = 0;
            foreach ($_SESSION[$this->langLw]['basket']['prod'] as $key => $val) {
                $findProd_qry = "select * from srvCards_dt where cardAlias='" . $key . "'";
                $findProd_res = $this->query($findProd_qry);
                if($findProd_row = $findProd_res->fetch(PDO::FETCH_ASSOC)){
                    $basket_prod[] = $findProd_row;
                    $_SESSION[$this->langLw]['basket']['total'] +=
                        $findProd_row['cardPrice_'.$_SESSION[$this->langLw]['lang']]*$val;
                }
            }
        }
        return $basket_prod;
    }

}