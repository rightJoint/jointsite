<?php
class RecordsListView extends RecordsView
{
    public $logo = "/img/admin/editRecords.png";
    public $listFields = null;
    public $listRecords = null;
    public $searchFields= null;
    public $curPage = 1;
    public $onPage = 10;
    public $listCount = 0;
    public $list_frame_id = null;
    public $newBtn_qry = null;
    public $hasAccessCreate = true;

    function __construct()
    {
        $this->styles[] = "/css/records.css";
        $this->styles[] = "/lib/js/Elegant-Loading-Indicator-jQuery-Preloader/src/css/preloader.css";

        $this->scripts[] = "/lib/js/Elegant-Loading-Indicator-jQuery-Preloader/src/js/jquery.preloader.min.js";
        $this->scripts[] = "/js/records.js";

        $this->lang_map["list_table"] = array(
            "found" => array(
                "en" => "Found",
                "rus" => "Найдено",
            ),
            "list_by" => array(
                "en" => "display by",
                "rus" => "Показывать по",
            ),
            "sort" => array(
                "en" => "sort field",
                "rus" => "Сортировка",
            ),
            "new" => array(
                "en" => "New one",
                "rus" => "Создать запись"
            ),
            "btn_apply" => array(
                "en" => "applyFilterForm",
                "rus" => "Применить фильтр"
            ),
            "cell_view" => array(
                "en" => "View",
                "rus" => "Смотр.",
            ),
            "cell_del" => array(
                "en" => "Del",
                "rus" => "Удал.",
            ),
            "cell_edit" => array(
                "en" => "Edit",
                "rus" => "Редакт."
            ),
            "btn_clear" => array(
                "en" => "Clear",
                "rus" => "Очистить"
            )
        );


    }

    function set_head_array()
    {
        $this->lang_map["head"]["description"] = array(
            "en" => "Records list, find records in table",
            "rus" => "Список записей, найти запиь в таблице",
        );
        $this->lang_map["head"]["title"] = array(
            "en" => "Records list - ".$this->h2,
            "rus" => "Список записей - ".$this->h2,
        );
        $this->lang_map["head"]["h1"] = array(
            "en" => "Records list in ".$this->h2,
            "rus" => "Список записей в ".$this->h2
        );
    }


    function print_page_content()
    {
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
            if($fieldData["search"]){
                $return_text.= $this->getTnputType($fieldName, $fieldData, $this->record[$fieldName]["curVal"])["html"];
            }

        }
        $return_text.= "<div class='apply-line'>";
        if($this->action_log){
            $return_text.= $this->action_log;
        }
        $return_text.= "<input type='button' class='applyFilterForm' ".
            "value='".$this->lang_map["list_table"]["btn_clear"][$_SESSION["lang"]]."' ".
            "onclick='clearSearchInputs()'>".
            "<input type='button' class='applyFilterForm' ".
            "value='".$this->lang_map["list_table"]["btn_apply"][$_SESSION["lang"]]."' ".
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
            "</div>".
            "</div>".
            "</div>".
            "</div>";
    }

    function scriptListViewCrtlPannel($slave_req = "")
    {
        return "<script>$('#".$this->list_frame_id."').mvcListViewCrtlPannel('/".$this->process_url."', '".$slave_req."');</script>";
    }

    function listPgView()
    {
        return "<span class='found_label'>".$this->lang_map["list_table"]["found"][$_SESSION["lang"]]
            .": <span>".$this->listCount."</span></span>".
            $this->pagination_print($this->listCount, $this->curPage, $this->onPage);
    }

    function ctrlLine()
    {
        global $routes;

        $req_uri = null;

        foreach ($routes as $num => $path){
            $req_uri.=$path."/";
        }

        $this->onPage_list = array(
            10, 20, 50, 100
        );

        $return_ajax = "<div class='ctrl-line'>";
        if($this->action_log){
            $return_ajax.= $this->action_log;
        }
        $return_ajax.= "<div class='pagination'>";
        $return_ajax.= $this->listPgView();

        $return_ajax.= "</div>".
            "<div class='sort-block'>".
            "<span class='found_label'>".$this->lang_map["list_table"]["list_by"][$_SESSION["lang"]].": </span>".
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
        foreach ($this->searchFields as $fieldName=>$fieldData){
            if($fieldData["sort"]){
                $count_of++;
                if($count_of == 1){
                    if($fieldData["sortOrder"] == "DESC"){
                        $sortOrder_desc = "selected";
                        $sortOrder_asc = null;
                    }
                }

                if($fieldData["fieldAliases"][$_SESSION["lang"]]){
                    $option_text = $fieldData["fieldAliases"][$_SESSION["lang"]];
                }else{
                    $option_text = $fieldName;
                }

                $sortFields_options.="<option value='".$fieldName."'>".$option_text."</option>";


            }
        }
        $return_ajax.= "</select>".
            "<span class='sortField'>".$this->lang_map["list_table"]["sort"][$_SESSION["lang"]].": </span>".
            "<select name='sortField'>".$sortFields_options."</select>".
            "<select name='sortOrder'><option value='ASC' ".$sortOrder_asc.">ASC</option><option value='DESC' ".$sortOrder_desc.">DESC</option></select>".
            "</div>".
            "<div class='new-block'>";
        if($this->hasAccessCreate){
            $return_ajax.="<a href='/".$this->process_url."/new".$this->newBtn_qry."' class='newRecLink'>".$this->lang_map["list_table"]["new"][$_SESSION["lang"]]."</a>";
        }

        $return_ajax.="</div>".
            "</div>";
        return $return_ajax;
    }

    function listViewTable()
    {
        global $routes;

        $req_uri = null;

        foreach ($routes as $num => $path){
            $req_uri.=$path."/";
        }

        if($this->listRecords){
            $return_ajax = "<table>".
                "<tr class='fCaption'>";
            foreach ($this->listFields as $fieldName => $fieldInfo){

                $return_ajax.= "<td";
                if($fieldInfo["format"] == "hidden"){
                    $return_ajax.= " style='display:none;'";
                }
                $return_ajax.=">";
                if ($fieldName == "btnEdit"){
                    $return_ajax.= $this->lang_map["list_table"]["cell_edit"][$_SESSION["lang"]];
                }elseif ($fieldName == "btnDelete"){
                    $return_ajax.= $this->lang_map["list_table"]["cell_del"][$_SESSION["lang"]];
                }elseif ($fieldName == "btnDetail"){
                    $return_ajax.= $this->lang_map["list_table"]["cell_view"][$_SESSION["lang"]];
                }elseif($fieldInfo["fieldAliases"][$_SESSION["lang"]]){
                    $return_ajax.= $fieldInfo["fieldAliases"][$_SESSION["lang"]];
                }else{
                    $return_ajax.= $fieldName;
                }
                $return_ajax.= "</td>";
            }
            $return_ajax.= "</tr>";


            foreach($this->listRecords as $row_num => $row){
                $return_ajax.= "<tr>";
                foreach ($this->listFields as $fieldName => $fieldInfo){
                    $name_print = null;
                    if($fieldInfo["useName"]){
                        $name_print = " name='".$row[$fieldInfo["useName"]]."' ";
                    }

                    $return_ajax.= "<td";
                    if($fieldInfo["format"] == "hidden"){
                        $return_ajax.= " style='display:none;'";
                    }
                    $return_ajax.= ">";

                    if ($fieldInfo["format"] == "file"){
                        if($row[$fieldName]){
                            if($fieldInfo["file_options"]["file_type"] == "img"){
                                $imgLink = null;
                                if($fieldInfo["file_options"]["load_dir"]){

                                    if($fieldInfo["replaces"]){
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
                                    $return_ajax.="<img class='cell-img' src='".$imgLink."'>";
                                }else{
                                    $return_ajax.= "file:".$fieldInfo["file_options"]["file_type"].":".$fieldInfo["file_options"]["load_dir"]."=".
                                        $row[$fieldName];
                                }
                            }else{
                                $return_ajax.= "file:".$fieldInfo["file_options"]["file_type"].":".$fieldInfo["file_options"]["load_dir"]."=".
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
                            if ($fieldName == "btnDetail"){
                                $return_ajax.= "<a href='/".$this->process_url."/detail?".
                                    $urlLink."' class='list-btn'>".
                                    "<img src='/img/popimg/eye-icon.png'></a>";
                            }elseif ($fieldName == "btnEdit"){
                                if($row["btnEdit"]!="disabled"){
                                    $return_ajax.= "<a href='/".$this->process_url."/edit?".
                                        $urlLink."' class='list-btn'>".
                                        "<img src='/img/popimg/edit-icon.png'></a>";
                                }
                            }elseif ($fieldName == "btnDelete"){
                                if($row["btnDelete"]!="disabled"){
                                    $return_ajax.= "<a href='/".$this->process_url."/delete?".
                                        $urlLink."' class='list-btn'>".
                                        "<img src='/img/popimg/drop-icon.png'></a>";
                                }
                            }
                        }else{
                            $urlLink = null;
                            if($fieldInfo["replaces"]){
                                $urlLink = $fieldInfo["url"];
                                foreach ($fieldInfo["replaces"] as $replace){
                                    $urlLink = str_replace($replace, $row[$replace], $urlLink);
                                }
                            }
                            $return_ajax.= "<a href='".$urlLink."' title='edit'>".$row[$fieldName]."</a>";
                        }
                    }elseif (($fieldInfo["format"] == "varchar") or ($fieldInfo["format"] =="text")){
                        if(isset($fieldInfo["maxLength"]) and  $fieldInfo["maxLength"] < strlen($row[$fieldName]) ){
                            $return_ajax.= mb_substr($row[$fieldName], 0, $fieldInfo["maxLength"])." ...";
                        }else {
                            $return_ajax.=  $row[$fieldName];
                        }
                    }elseif (($fieldInfo["format"] == "int") or ($fieldInfo["format"] =="float")
                        or ($fieldInfo["format"] =="datetime")or ($fieldInfo["format"] =="date")){
                        $return_ajax.=  $row[$fieldName];
                    }elseif (($fieldInfo["format"] == "tinyint") or ($fieldInfo["format"] == "checkbox")){
                        $return_ajax.= "<input type='checkbox' ".$name_print;
                        if($row[$fieldName]){
                            $return_ajax.= "checked";
                        }
                        $return_ajax.=">";
                    }elseif ($fieldInfo["format"] == "select"){
                        $return_ajax.= $fieldInfo["filling"][$row[$fieldName]];
                    }
                    else{
                        $return_ajax.= "<span>[format=".$fieldInfo["format"]."]:</span>".$row[$fieldName]."";

                    }
                    $return_ajax.= "</td>";
                }
                $return_ajax.= "</tr>";
            }
            $return_ajax.= "</table>";
        }
        return $return_ajax;
    }

    function pagination_print($recordsCount, $curPage, $onPage, $length=2, $pag_length=2)
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