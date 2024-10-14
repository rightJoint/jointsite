<?php

namespace JointSite\Views\Templates;

use JointSite\Views\Templates\RecordView;

class RecordListView extends RecordView
{
    public $process_url;
    public $logo = "/img/popimg/editRecords.png";
    public $listFields = null;
    public $listRecords = null;
    public $searchFields= null;
    public $curPage = 1;
    public $onPage = 10;
    public $listCount = 0;
    public $list_frame_id = null;
    public $newBtn_qry = null;
    public $hasAccessCreate = true;
    public $slave_req = null;
    public $onPage_list= array(
        10, 20, 50, 100
    );

    function __construct()
    {
        parent::__construct();
        $this->styles[] = "/css/records.css";

        $this->scripts[] = "/js/records.js";
    }

    function LoadLangViewCustom()
    {
        require_once JOINT_SITE_REQ_LANG."/Views/Templates\LangFiles_".JOINT_SITE_APP_LANG."_Views_Templates_RecordsList.php";
        return "LangFiles_".JOINT_SITE_APP_LANG."_Views_Templates_RecordsList";
    }

    function set_head_array()
    {
        parent::setHeadArray();
        $this->lang_map->set_head_array(array("h2" => $this->h2));
    }


    function printPageContent()
    {
        parent::printPageContent();
        echo $this->filterView();
        $this->listView();
    }

    function filterView()
    {
        $return_text = "<div class='contentBlock-frame'><div class='contentBlock-center'>".
            "<div class='contentBlock-wrap'>".
            "<div class='search_frame'>".
            "<form class='filterForm' method='post'>";
        foreach ($this->searchFields as $fieldName=>$fieldData){
            if(isset($fieldData["search"]) and $fieldData["search"] == true){
                $field_cur_val = null;
                if(isset($this->record[$fieldName]["curVal"])){
                    $field_cur_val = $this->record[$fieldName]["curVal"];
                }
                $return_text.= $this->getTnputType($fieldName, $fieldData, $field_cur_val)["html"];
            }

        }
        $return_text.= "<div class='apply-line'>";
        if($this->action_log){
            $return_text.= $this->action_log;
        }
        $return_text.= "<input type='button' class='applyFilterForm' ".
            "value='".$this->lang_map->list_table["btn_clear"]."' ".
            "onclick='clearSearchInputs()'>".
            "<input type='button' class='applyFilterForm' ".
            "value='".$this->lang_map->list_table["btn_apply"]."' ".
            "onclick='applyFilterForm()'>".
            "</div>".
            "<input type='hidden' name='applyFilterRec' value='1'>".
            "</form>".
            "</div>".
            "</div>".
            "</div>".
            "</div>";

        return $return_text;
    }

    function listView()
    {

        echo "<div class='contentBlock-frame'><div class='contentBlock-center'>".
            "<div class='contentBlock-wrap'>".
            "<div class='list_frame' id='".$this->list_frame_id."'>";
        if($this->h2){
            echo "<h2>".$this->h2."</h2>";
        }
        echo $this->ctrlLine().
            "<div class='list_table'>".
            $this->listViewTable().

            "</div>".
            $this->scriptListViewCrtlPannel().
            $this->scriptSortBlock().
            "</div>".
            "</div>".
            "</div>".
            "</div>";
    }

    function scriptSortBlock()
    {
        return "<script>$('#".$this->list_frame_id."').recordsSortBlock();</script>";
    }

    function scriptListViewCrtlPannel()
    {
        return "<script>$('#".$this->list_frame_id."').recordsPgBlock('".$this->process_url."', '".$this->slave_req."');</script>";
    }

    function listPgView()
    {
        return "<span class='found_label'>".$this->lang_map->list_table["found"].
            ": <span>".$this->listCount."</span></span>".
            $this->paginationPrint($this->listCount, $this->curPage, $this->onPage);
    }

    function ctrlLine()
    {
        global $request;

        $req_uri = null;

        $routes = $request["routes"];

        foreach ($routes as $num => $path){
            $req_uri.=$path."/";
        }

        $return_ajax = "<div class='ctrl-line'>";
        if($this->action_log){
            $return_ajax.= $this->action_log;
        }
        $return_ajax.= "<div class='pagination'>";
        $return_ajax.= $this->listPgView();

        $return_ajax.= "</div>".
            "<div class='sort-block'>".
            "<span class='found_label'>".$this->lang_map->list_table["list_by"].": </span>".
            "<select name='onPage'>";
        foreach ($this->onPage_list as $onPage){
            $return_ajax.= "<option value='".$onPage."'";
            if($onPage == $this->onPage){
                $return_ajax.= " selected";
            }
            $return_ajax.= ">".$onPage."</option>";
        }


        $sortOrder_asc = "selected";
        $sortOrder_desc = null;
        $count_of = 0;
        $sortFields_options = null;
        foreach ($this->searchFields as $fieldName=>$fieldData){
            if(isset($fieldData["sort"]) and $fieldData["sort"] == true and $fieldData["format"] != "hidden"){
                $count_of++;
                if($count_of == 1){
                    if(isset($fieldData["sortOrder"]) and $fieldData["sortOrder"] == "DESC"){
                        $sortOrder_desc = "selected";
                        $sortOrder_asc = null;
                    }
                }

                if(isset($fieldData["fieldAliases"][JOINT_SITE_APP_LANG])){
                    $option_text = $fieldData["fieldAliases"][JOINT_SITE_APP_LANG];
                }else{
                    $option_text = $fieldName;
                }

                $sortFields_options.="<option value='".$fieldName."'>".$option_text."</option>";


            }
        }
        $return_ajax.= "</select>".
            "<span class='sortField'>".$this->lang_map->list_table["sort"].": </span>".
            "<select name='sortField'>".$sortFields_options."</select>".
            "<select name='sortOrder'><option value='ASC' ".$sortOrder_asc.">ASC</option><option value='DESC' ".$sortOrder_desc.">DESC</option></select>".
            "</div>".
            "<div class='new-block'>";
        if($this->hasAccessCreate){
            $return_ajax.="<a href='".$this->process_url."/newview".$this->format_slave_req().$this->newBtn_qry."' class='newRecLink'>".$this->lang_map->list_table["new"]."</a>";
        }

        $return_ajax.="</div>".
            "</div>";
        return $return_ajax;
    }

    function listViewTable()
    {
        global $request;
        $routes = $request["routes"];
        $req_uri = null;

        foreach ($routes as $num => $path){
            $req_uri.=$path."/";
        }

        $return_text = null;

        if($this->listRecords){
            $return_text .= "<table>".
                "<tr class='fCaption'>";
            foreach ($this->listFields as $fieldName => $fieldInfo){

                $return_text.= "<td";
                if($fieldInfo["format"] == "hidden"){
                    $return_text.= " style='display:none;'";
                }
                $return_text.=">";
                if ($fieldName == "btnEdit"){
                    $return_text.= $this->lang_map->list_table["cell_edit"];
                }elseif ($fieldName == "btnDelete"){
                    $return_text.= $this->lang_map->list_table["cell_del"];
                }elseif ($fieldName == "btnDetail"){
                    $return_text.= $this->lang_map->list_table["cell_view"];
                }elseif(isset($fieldInfo["fieldAliases"][JOINT_SITE_APP_LANG])){
                    $return_text.= $fieldInfo["fieldAliases"][JOINT_SITE_APP_LANG];
                }else{
                    $return_text.= $fieldName;
                }
                $return_text.= "</td>";
            }
            $return_text.= "</tr>";


            foreach($this->listRecords as $row_num => $row){
                $return_text.= "<tr>";
                foreach ($this->listFields as $fieldName => $fieldInfo){
                    $name_print = null;
                    if(isset($fieldInfo["useName"])){
                        $name_print = " name='".$row[$fieldInfo["useName"]]."' ";
                    }

                    $return_text.= "<td";
                    if($fieldInfo["format"] == "hidden"){
                        $return_text.= " style='display:none;'";
                    }
                    $return_text.= ">";

                    if ($fieldInfo["format"] == "file"){
                        if($row[$fieldName]){
                            if($fieldInfo["file_options"]["file_type"] == "img"){
                                $imgLink = null;
                                if($fieldInfo["file_options"]["load_dir"]){

                                    if(isset($fieldInfo["replaces"])){
                                        $imgLink = $fieldInfo["file_options"]["load_dir"];
                                        if($fieldInfo["replaces"]){
                                            foreach ($fieldInfo["replaces"] as $replace){
                                                $imgLink = str_replace($replace, $row[$replace], $imgLink);
                                            }
                                        }
                                    }else{
                                        $imgLink = $fieldInfo["file_options"]["load_dir"]."/".$row[$fieldName];
                                    }
                                }

                                if($imgLink){
                                    $return_text.="<img class='cell-img' src='".$imgLink."'>";
                                }else{
                                    $return_text.= "file:".$fieldInfo["file_options"]["file_type"].":".$fieldInfo["file_options"]["load_dir"]."=".
                                        $row[$fieldName];
                                }
                            }else{
                                $return_text.= "file:".$fieldInfo["file_options"]["file_type"].":".$fieldInfo["file_options"]["load_dir"]."=".
                                    $row[$fieldName];
                            }
                        }
                    }elseif($fieldInfo["format"] == "link"){
                        if(in_array($fieldName, array("btnDetail", "btnEdit", "btnDelete"))){
                            $urlLink = null;
                            if($fieldInfo["replaces"]){
                                $urlLink = $fieldInfo["url"];
                                foreach ($fieldInfo["replaces"] as $replace){
                                    $repl_pos = strpos($urlLink, $replace);
                                    $urlLink_1 = substr($urlLink, 0, $repl_pos+strlen($replace)+1);
                                    $urlLink_2 = substr($urlLink, $repl_pos+strlen($replace)+1, strlen($urlLink));
                                    $urlLink_3 = str_replace($replace, $row[$replace], $urlLink_2);
                                    $urlLink = $urlLink_1.$urlLink_3;
                                }
                            }
                            $urlLink .="&".$this->slave_req;
                            if ($fieldName == "btnDetail"){
                                $return_text.= "<a href='".$this->process_url."/detailview?".
                                    $urlLink."' class='list-btn'>".
                                    "<img src='/img/popimg/eye-icon.png'></a>";
                            }elseif ($fieldName == "btnEdit"){
                                if(!isset($row["btnEdit"]) or $row["btnEdit"]!="disabled"){
                                    $return_text.= "<a href='".$this->process_url."/editview?".
                                        $urlLink."' class='list-btn'>".
                                        "<img src='/img/popimg/edit-icon.png'></a>";
                                }
                            }elseif ($fieldName == "btnDelete"){
                                if(!isset($row["btnDelete"]) or $row["btnDelete"]!="disabled"){
                                    $return_text.= "<a href='".$this->process_url."/deleteview?".
                                        $urlLink."' class='list-btn'>".
                                        "<img src='/img/popimg/drop-icon.png'></a>";
                                }
                            }
                        }else{
                            $urlLink = null;
                            if($fieldInfo["replaces"]){
                                $urlLink = $fieldInfo["url"];
                                foreach ($fieldInfo["replaces"] as $replace){
                                    $repl_pos = strpos($urlLink, $replace);
                                    $urlLink_1 = substr($urlLink, 0, $repl_pos+strlen($replace)+1);
                                    $urlLink_2 = substr($urlLink, $repl_pos+strlen($replace)+1, strlen($urlLink));
                                    $urlLink_3 = str_replace($replace, $row[$replace], $urlLink_2);
                                    $urlLink = $urlLink_1.$urlLink_3;
                                }
                            }
                            $return_text.= "<a href='".$urlLink."' title='edit'>".$row[$fieldName]."</a>";
                        }
                    }elseif($fieldInfo["format"] == "ref"){
                        $urlLink = null;
                        if($fieldInfo["replaces"]){
                            $urlLink = $fieldInfo["url"];
                            foreach ($fieldInfo["replaces"] as $replace){
                                $urlLink = str_replace($replace, $row[$replace], $urlLink);
                            }
                        }
                        $return_text.= "<a href='".$this->process_url."/".$urlLink."' title='edit'>".$row[$fieldName]."</a>";

                    }elseif (($fieldInfo["format"] == "varchar") or ($fieldInfo["format"] =="text")){
                        if(isset($fieldInfo["maxLength"]) and isset($row[$fieldName]) and  $fieldInfo["maxLength"] < strlen($row[$fieldName]) ){
                            $return_text.= mb_substr($row[$fieldName], 0, $fieldInfo["maxLength"])." ...";
                        }else {
                            $return_text.=  $row[$fieldName];
                        }
                    }elseif (($fieldInfo["format"] == "int") or ($fieldInfo["format"] =="float")
                        or ($fieldInfo["format"] =="datetime")or ($fieldInfo["format"] =="date")){
                        $return_text.=  $row[$fieldName];
                    }elseif (($fieldInfo["format"] == "tinyint") or ($fieldInfo["format"] == "checkbox")){
                        $return_text.= "<input type='checkbox' ".$name_print;
                        if($row[$fieldName]){
                            $return_text.= "checked";
                        }
                        $return_text.=">";
                    }elseif ($fieldInfo["format"] == "select"){
                        $return_text.= $fieldInfo["filling"][$row[$fieldName]];
                    }
                    else{
                        $custom_type = $this->getCustomListType($fieldName, $row[$fieldName]);
                        if($custom_type != null){
                            $return_text.=$custom_type;
                        }else{
                            $return_text.= "<span>[format=".$fieldInfo["format"]."]:</span>".$row[$fieldName]."";
                        }
                    }
                    $return_text.= "</td>";
                }
                $return_text.= "</tr>";
            }
            $return_text.= "</table>";
        }
        return $return_text;
    }

    function getCustomListType($fieldName, $fieldVal)
    {

    }

    function paginationPrint($recordsCount, $curPage, $onPage, $length=2, $pag_length=2)
    {
        //$length = 2;        //optional: count cells in table row
        //$pag_length = 2;    //optional:
        if(round($recordsCount/$onPage) - $recordsCount/$onPage < 0){
            $page_count = round($recordsCount/$onPage) + 1;
        }else{
            $page_count =  round($recordsCount/$onPage);
        }

        $p_add_num_start = 0;

        if($curPage - $pag_length < 1){
            $p_add_num_start = $pag_length - $curPage +1;
        }

        $end_p_num = $curPage + $pag_length + $p_add_num_start;
        if($end_p_num > $page_count){
            $end_p_num = $page_count;
        }

        $start_p_num = $curPage - $pag_length + $p_add_num_start;
        if($end_p_num - $pag_length*2  < $start_p_num){
            $start_p_num = $end_p_num - $pag_length*2;
        }
        if($start_p_num < 1){
            $start_p_num = 1;
        }
        $page_list = null;
        for ($i = $start_p_num; $i <= $end_p_num; $i++){
            if ($curPage == $i){
                $page_list .= "<span class = 'p_num active'>".$i."</span>";
            }else{
                if($i == 1){
                    $page_list .= "<span class = 'p_num' page='".$i."' ".
                        ">".$i."</span>";
                }else{
                    $page_list .= "<span class = 'p_num' page='".$i."' ".
                        ">".$i."</span>";
                }
            }
        }

        if($curPage < $page_count){
            $btn_nex = "<span class='p_btn next' page='".($curPage+1)."' ".
                ">след.</span>";
        }else {
            $btn_nex = "<span class='p_btn next active'>след.</span>";
        }

        if ($curPage > 1){
            $btn_pre = "<span class='p_btn prev' page='".($curPage-1)."' ".
                ">пред.</span>";
        }else {
            $btn_pre = "<span class='p_btn prev active'>пред.</span>";
        }

        return $btn_pre.$page_list.$btn_nex;
    }

}