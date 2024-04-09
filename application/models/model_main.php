<?php
class Model_Main extends Model
{
    function get_data()
    {
        return $this->getServiceList();
    }

    function getServiceList()
    {
        $popServices_qry = "select * from srvCards_dt WHERE cardActive is true order by sortDate DESC ";
        return $this->query($popServices_qry);
    }

    function throwErrNoConn()
    {
        return true;
    }

    function lBasketAdd()
    {
        $findProd_qry = "select * from srvCards_dt where cardAlias='".$_GET['lBasketAdd']."' and cardActive is true";
        $findProd_res = $this->query($findProd_qry);
        if($findProd_row = $findProd_res->fetch(PDO::FETCH_ASSOC)){
            $_SESSION['basket']['prod'][$findProd_row['cardAlias']] += 1;
            $_SESSION["basket"]["total"] += $findProd_row['cardPrice_'.$_SESSION["lang"]];
        }
    }
    function basketCalc(){
        $basket_prod = array();
        if($_SESSION['basket']['total']>=1) {
            $_SESSION["basket"]["total"] = 0;
            foreach ($_SESSION['basket']['prod'] as $key => $val) {
                $findProd_qry = "select * from srvCards_dt where cardAlias='" . $key . "'";
                $findProd_res = $this->query($findProd_qry);
                if($findProd_row = $findProd_res->fetch(PDO::FETCH_ASSOC)){
                    $basket_prod[] = $findProd_row;
                    $_SESSION["basket"]["total"] += $findProd_row["cardPrice_".$_SESSION["lang"]]*$val;
                }
            }
        }
        return $basket_prod;
    }

}