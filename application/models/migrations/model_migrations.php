<?php
require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
    "/application/core/RecordsModel.php";
class model_migrations extends RecordsModel
{
    public $tableName = "migrations";

    function getRecordStructure()
    {
        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
            "/application/recordsStructureFiles/migrations/rsf_migrations.php";
        $this->recordStructureFields = new  rsf_migrations();
    }

    function glob_migration_files()
    {
        $files_list = null;
        $add_date = date("Y-m-d H:i:s");
        $list_where = null;

        foreach (glob(PATH_TO_MIGRATIONS . "/*.sql") as $mirgation_file) {
            $this->recordStructureFields->record["migration_name"]["curVal"] = basename($mirgation_file);
            if(!parent::copyRecord()){
                $this->recordStructureFields->record["status"]["curVal"] = "new";
                $this->recordStructureFields->record["add_date"]["curVal"] = $add_date;
                $this->recordStructureFields->record["migr_file"]["curVal"] = 1;
                $this->insertRecord();
            }
            $files_list.="'".basename($mirgation_file)."', ";
        }

        if($files_list){
            $files_list =substr($files_list, 0, strlen($files_list)-2);

            $list_where = "where migration_name not in (".$files_list.")";

        }


        $list_migr = $this->listRecords($list_where);

        if($list_migr){
            foreach ($list_migr as $m_num => $m_data){
                $this->recordStructureFields->record["migration_name"]["curVal"] = basename($m_data["migration_name"]);
                parent::copyRecord();
                $this->recordStructureFields->record["migr_file"]["curVal"] = false;
                $this->updateRecord();
            }
        }
    }

    function parse_sql_file($file_name)
    {
        $acceptable_queries = array(
            "insert" => "insert ",
            "update" => "update ",
            "delete" => "delete ",
            "replace " => "replace ",
            "replace_upper " => "REPLACE ",
            "create_table " => "create table ",
        );

        $new_cmd_lines = null;

        if(file_exists($file_name)){
            $this->recordStructureFields->record["commands"]["curVal"] = file_get_contents($file_name);
            $this->recordStructureFields->record["commands"]["use_table_name"] = "non-db";

            $cmd_lines = explode(";",$this->recordStructureFields->record["commands"]["curVal"]);

            $new_cmd_lines = array();

            $lines_cnt = count($cmd_lines);
            $lines_counter = 0;
            foreach ($cmd_lines as $cmd_line){
                $lines_counter++;
                $glue_flag= true;
                foreach ($acceptable_queries as $q_type => $q_tag){
                    if(strpos("-".$cmd_line, $q_tag)){
                        $new_cmd_lines[$lines_counter]["type"] = $q_type;
                        $glue_flag = false;
                        break;
                    }
                }
                $new_lines_cnt = count($new_cmd_lines);
                if($glue_flag){
                    if($new_lines_cnt){
                        if($lines_counter < $lines_cnt){
                            $new_cmd_lines[$new_lines_cnt-1]["query"] .= ";".$cmd_line;
                        }
                    }
                }else {
                    $new_cmd_lines[$new_lines_cnt]["query"] = $cmd_line;
                    if ($lines_counter < $lines_cnt) {
                        $new_cmd_lines[$new_lines_cnt]["query"] .= ";";
                    }
                }
            }
        }

        return $new_cmd_lines;
    }

    function exec_migration($migr_file)
    {
        $return=array(
            "log" => null,
            "err" => 0,
        );
        $count_q = 0;
        $count_suss = 0;
        $count_fail = 0;
        if($this->recordStructureFields->record["status"]["curVal"] == "new"){
            if($commands = $this->parse_sql_file(PATH_TO_MIGRATIONS."/".$migr_file)){
                $return["log"][] = "Exec file ".$migr_file;
                $commands_count = count($commands);
                if($commands_count){
                    $return["log"][] = "count(".$commands_count.")";
                    foreach ($commands as $q_num => $q_info){
                        $return["log"][] = "exec No: ".$q_num.", type: ".$q_info["type"];
                        if($this->pdo_query($q_info["query"])){
                            $count_suss++;
                            $return["log"][] = "result: SUCCESS";
                        }else{
                            $return["log"][] = "result: FAIL: ";
                            foreach ($this->errorInfo() as $err_num => $err_info){
                                $return["log"][] = str_replace("'", "", $err_info);
                            }
                            $return["err"] = true;
                            $count_fail++;
                        }
                        $count_q++;
                    }

                    if($return["err"]){
                        $return["err"] = "cant exec all migrations";
                    }
                    $return["log"][] = "Results: total(".$count_q."), success(".$count_suss."), fail(".$count_fail.")";

                }else{
                    $return["err"] = "no queries in ".$migr_file;
                    $return["log"][] = "no queries in ".$migr_file;
                }
            }else{
                $return["err"] = "no sql file or no commands (empty migration sql file) ".$migr_file;
                $return["log"][] = "no sql file or no commands (empty migration sql file) ".$migr_file;
            }
        }else{
            $return["log"][] = "migration status is not new";
        }

        require_once $_SERVER["DOCUMENT_ROOT"].JOINT_SITE_EXEC_DIR.
            "/application/models/admin/model_migrations_log.php";

        $migration_log = new model_migrations_log();

        $migration_log->recordStructureFields->record["migration_name"]["curVal"] = $migr_file;
        $migration_log->recordStructureFields->record["add_date"]["curVal"] = date("Y-m-d H:i:s");
        $migration_log->recordStructureFields->record["migration_log"]["curVal"] = json_encode($return, true);
        $migration_log->insertRecord();

        if($return["err"]){
            $this->recordStructureFields->record["status"]["curVal"] = "fail";
        }elseif($count_suss){
            $this->recordStructureFields->record["status"]["curVal"] = "SUCCESS";
        }
        $this->recordStructureFields->record["try_date"]["curVal"] = date("Y-m-d H:i:s");

        parent::updateRecord();

        return $return["err"];

    }

    function copyCustomFields()
    {
        if($this->recordStructureFields->record["migration_name"]["curVal"] ){
            if(file_exists(PATH_TO_MIGRATIONS . "/".
                $this->recordStructureFields->record["migration_name"]["curVal"])){
                $commands = $this->parse_sql_file(PATH_TO_MIGRATIONS . "/".
                    $this->recordStructureFields->record["migration_name"]["curVal"]);
                foreach ($commands as $c_num => $c_data){

                    $cmd_field_name = "cmd_".$c_num."_".$c_data["type"];
                    $fieldAliases = array(
                        "en" => "command No: ".$c_num.", type: ".$c_data["type"],
                        "rus" => "комманда No: ".$c_num.", Тип: ".$c_data["type"],
                    );

                    $this->recordStructureFields->record[$cmd_field_name] = array(
                        "curVal" => $c_data["query"],
                        "use_table_name" => "non-db",
                        "format" => "text",
                        "fieldAliases" => $fieldAliases,
                    );

                    $this->recordStructureFields->viewFields[$cmd_field_name] = array(
                        "format" => "text",
                        "readonly" => true,
                        'style'=> array(
                            "class" => "wd100",
                        ),
                        "fieldAliases" => $fieldAliases,
                    );

                    $this->recordStructureFields->editFields[$cmd_field_name] = array(
                        "format" => "text",
                        'style'=> array(
                            "class" => "wd100",
                        ),
                        "fieldAliases" => $fieldAliases,
                    );
                }
            }
        }


        //add command line to edit commands

        if(isset($commands)){
            $c_num = count($commands)+1;
        }else{
            $c_num = 1;
        }


        $cmd_field_name = "cmd_".$c_num."_new";
        $fieldAliases = array(
            "en" => "command No: ".$c_num.", type: new",
            "rus" => "комманда No: ".$c_num.", Тип: новая",
        );

        $this->recordStructureFields->editFields[$cmd_field_name] = array(
            "format" => "text",
            'style'=> array(
                "class" => "wd100",
            ),
            "fieldAliases" => $fieldAliases,
        );

        return true;
    }

    function updateRecord()
    {
        $commands = "";

        foreach ($_POST as $key => $val){
            if(strpos(" ".$key, "cmd_")){
                unset($this->recordStructureFields->record[$key]);
                unset($this->recordStructureFields->editFields[$key]);
                if($val){
                    $commands.=$val."\n";
                }
            }
        }
        foreach ($this->recordStructureFields->record as $key => $val){
            if(strpos(" ".$key, "cmd_")){
                unset($this->recordStructureFields->record[$key]);
                unset($this->recordStructureFields->editFields[$key]);
            }
        }
        $commands = substr($commands, 0, strlen($commands)-1);
        if($this->recordStructureFields->record["commands"]["curVal"] != $commands){
            file_put_contents(PATH_TO_MIGRATIONS."/".$this->recordStructureFields->record["migration_name"]["curVal"], $commands);
            $this->log_message .=$this->lang_map->updateRecord["success"]." migration file ";
        }
        return parent::updateRecord();
    }

    function deleteRecord()
    {
        $delete_log_qry = "delete from ".$this->tableName."_log ".
            "where migration_name='".$this->recordStructureFields->record["migration_name"]["curVal"]."'";
        $this->query($delete_log_qry);
        return parent::deleteRecord(); // TODO: Change the autogenerated stub
    }

}