<?php
class model_landing extends Model_pdo
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
        if(!isset($_SESSION[JS_SAIK]["basket"]["total"])){
            $_SESSION[JS_SAIK]["basket"]["total"] = 0;
        }
        if($findProd_row = $findProd_res->fetch(PDO::FETCH_ASSOC)){
            if(isset($_SESSION[JS_SAIK]['basket']['prod'][$findProd_row['cardAlias']])){
                $_SESSION[JS_SAIK]['basket']['prod'][$findProd_row['cardAlias']] += 1;
            }else{
                $_SESSION[JS_SAIK]['basket']['prod'][$findProd_row['cardAlias']] = 1;
            }

            $_SESSION[JS_SAIK]["basket"]["total"] += $findProd_row['cardPrice_'.$_SESSION[JS_SAIK]["lang"]];
        }
    }
    function basketCalc(){
        $basket_prod = array();
        if(isset($_SESSION[JS_SAIK]['basket']['total']) and $_SESSION[JS_SAIK]['basket']['total']>=1) {
            $_SESSION[JS_SAIK]["basket"]["total"] = 0;
            foreach ($_SESSION[JS_SAIK]['basket']['prod'] as $key => $val) {
                $findProd_qry = "select * from srvCards_dt where cardAlias='" . $key . "'";
                $findProd_res = $this->query($findProd_qry);
                if($findProd_row = $findProd_res->fetch(PDO::FETCH_ASSOC)){
                    $basket_prod[] = $findProd_row;
                    $_SESSION[JS_SAIK]["basket"]["total"] += $findProd_row["cardPrice_".$_SESSION[JS_SAIK]["lang"]]*$val;
                }
            }
        }
        return $basket_prod;
    }

}