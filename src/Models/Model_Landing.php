<?php

namespace Src\Models;

use JointApp\JointAppQueryBuilder;
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
        $_SESSION["basket"]["total"] = 0;
        if(isset($_SESSION['basket']['prod'])){
            foreach ($_SESSION['basket']['prod'] as $key => $val) {
                $qBuilder = new JointAppQueryBuilder();
                $qBuilder->select(
                    'card_id, '.
                    'cardName_'.$this->langLw.' as cardName, '.
                    'cardAlias,'.
                    'shortDescr_'.$this->langLw.' as shortDescr, '.
                    'cardImg, '.
                    'cardActive, '.
                    'cardPrice_'.$this->langLw.' as cardPrice, '.
                    'cardCurr_'.$this->langLw.' as cardCurr, '.
                    'unit_'.$this->langLw.' as unit'
                )
                    ->from('srvCards_dt')
                    ->where('cardAlias="' . $key . '"');
                $findProd_res = $this->query($qBuilder->buildQuery());
                if($findProd_row = $findProd_res->fetch(\PDO::FETCH_ASSOC)){
                    $basket_prod[] = $findProd_row;
                    $_SESSION['basket']['total'] +=
                        $findProd_row['cardPrice']*$val;
                }
            }
        }
        return $basket_prod;
    }

    public function getBlogArts():array
    {
        $qBuilder = new JointAppQueryBuilder();
        $qBuilder
            ->select(
                'art_id, '.
                'artCat, '.
                'artRef, '.
                'artName_'.$this->langLw.' as artName, '.
                'artMeta_'.$this->langLw.' as artMeta, '.
                'artImg, '.
                'activeFlag, '.
                'indexFlag, '.
                'pubDate, '.
                'refreshDate, '.
                'created_by '
            )
            ->from('blogArts')
            ->where(
                'activeFlag is true and cat_id="6C20AC2A-7817-4440-A67D-5A3D40471275"'
            )
            ->order(
                'pubDate desc'
            );

        return $this->fetchToArray($qBuilder->buildQuery());

    }

    public function getBlogTags(JointAppQueryBuilder $qBuilder):array
    {
        $return = [];
        $qBuilder->select(
            'blogArts.art_id, '.
            'blogAtrTags.tag_id, '.
            'blogTags.tag_'.$this->langLw.' as tagName'
        )
            ->from('blogArts')
            ->join(
                'left join blogAtrTags on blogAtrTags.art_id = blogArts.art_id '.
                'left join blogTags on blogAtrTags.tag_id = blogTags.tag_id '
            )
            ->order(
                'blogAtrTags.art_id'
            );

        $res = $this->pdoQuery($qBuilder->buildQuery());

        if(!empty($res)){
            if($res->rowCount()){
                while ($row = $res->fetch(\PDO::FETCH_ASSOC)){
                    $return[$row['art_id']][] = array(
                        'tag_id' => $row['tag_id'],
                        'tagName' => $row['tagName'],
                    );

                }
            }
        }

        return $return;

    }

    public function getPopArts():array
    {
        $return = [];
        $qBuilder = new JointAppQueryBuilder();
        $qBuilder
            ->select(
                'art_id, '.
                'artCat, '.
                'artRef, '.
                'artName_'.$this->langLw.' as artName, '.
                'artMeta_'.$this->langLw.' as artMeta, '.
                'activeFlag, '.
                'indexFlag, '.
                'pubDate, '.
                'refreshDate, '.
                'created_by '
            )
            ->from('blogArts')
            ->where(
                'activeFlag is true '.
                'and '.
                'popFlag is true '
            )
            ->order(
                'pubDate desc'
            );

        $res = $this->pdoQuery($qBuilder->buildQuery());

        if(!empty($res)){
            if($res->rowCount()){
                while ($row = $res->fetch(\PDO::FETCH_ASSOC)){
                    $return[$row['artRef']] = array(
                        'refText' => $row['artName'],
                        'refTitle' => $row['artMeta'],
                        'usage' => true,
                    );

                }
            }
        }
        return $return;
    }
}