<?php
require_once "application/models/siteman/sitemap/recordsitemapModel.php";
class recordupdateModel extends recordsitemapModel
{

    public $module_name = "sitemap";
    public $root_url = "https://rightjoint.ru";

    function update_sitemap()
    {
        $list_res = $this->listRecords(" where ".$this->filterWhere($_POST)["where"], " order by ".$this->tableName.".maploc ", null);
        if($list_res->rowCount()){
            $map_text = "<?xml version='1.0' encoding='UTF-8'?>\n".
                "<urlset xmlns='http://www.sitemaps.org/schemas/sitemap/0.9'>\n";
            while ($list_row = $list_res->fetch(PDO::FETCH_ASSOC)){
                $map_text.="<url>".
                    "<loc>".$this->root_url.$list_row["maploc"]."</loc>".
                    "<lastmod>".$list_row["lastmod"]."</lastmod>".
                    "<changefreq>".$list_row["changefreq"]."</changefreq>".
                    "<priority>0.".$list_row["priority"]."</priority>".
                    "</url>\n";
            }
            $map_text .= "</urlset>";
            file_put_contents($_SERVER["DOCUMENT_ROOT"]."/sitemap.xml", $map_text);

            return $list_res->rowCount();
        }

        return false;
    }

    function filterWhere($REQ_ARR)
    {
        $filter_where = parent::filterWhere($REQ_ARR);

        $use_cond = "siteMap_dt.use_flag is true ";
        if($filter_where["where"]){
            $filter_where["where"] .=" and ".$use_cond;
        }else{
            $filter_where["where"] = $use_cond;
        }
        return $filter_where;
    }
}