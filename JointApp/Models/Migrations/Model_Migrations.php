<?php

namespace JointApp\Models\Migrations;

use JointApp\JointAppQueryBuilder;
use JointApp\Models\Records\RecordsModel;
use JointApp\Models\Migrations\Model_MigrationsLog;

class Model_Migrations extends RecordsModel
{
    public string $tableName = 'migrations';

    public $throw_err_no_conn = false;

    function getRecordStructure()
    {
        $this->record = Array
        (
            "migration_name" => Array
            (
                "pri" => 1,
                "format" => "varchar",
                'custom' => false,
            ),
            "status" => Array
            (
                "format" => "varchar",
                "curVal" => "new",
                'custom' => false,
            ),

            "try_date" => Array
            (
                "format" => "datetime",
                'custom' => false,
            ),

            "add_date" => Array
            (
                "format" => "datetime",
                'custom' => false,
            ),

            "migr_file" => Array
            (
                "format" => "tinyint",
                'custom' => false,
            ),
        );

        $this->record["add_date"]["curVal"] = date("Y-m-d H:i:s");
    }

    function glob_migration_files()
    {
        $files_list = null;
        $add_date = date('Y-m-d H:i:s');
        //$list_where = null;

        /*find all .sql -files in PATH_TO_MIGRATIONS
        and then put into migrations table if trey arent there
        */
        foreach (glob($this->docRoot.'/migrations/*.sql') as $mirgation_file) {
            $this->record['migration_name']['curVal'] = basename($mirgation_file);
            if(!$this->copyRecord()){
                $this->record['status']['curVal'] = 'new';
                $this->record['add_date']['curVal'] = $add_date;
                $this->record['migr_file']['curVal'] = 1;
                $this->insertRecord();
            }
            $files_list.='"'.basename($mirgation_file).'", ';
        }

        //$files_list - list all founded .sql -files

        //mark files they are in migrations table and has not found - was deleted
        $qBuilder = new JointAppQueryBuilder();
        if($files_list){
            $files_list =substr($files_list, 0, strlen($files_list)-2);
            $qBuilder->where('migration_name not in ('.$files_list.') and migr_file = true');
        }

        $list_migr = $this->listRecords($qBuilder);

        if($list_migr){
            foreach ($list_migr as $m_num => $m_data){
                $this->record['migration_name']['curVal'] = basename($m_data['migration_name']);
                $this->copyRecord();
                $this->record['migr_file']['curVal'] = false;
                $this->updateRecord();
            }
        }

    }

    function parse_sql_file($file_name):array
    {
        $acceptable_queries = array(
            'insert' => 'insert ',
            'update' => 'update ',
            'delete' => 'delete ',
            'replace' => 'replace ',
            'replace_upper' => 'REPLACE ',
            'create_table' => 'create table ',
        );

        $new_cmd_lines = array();

        if(file_exists($file_name)){
            $this->record['commands']['curVal'] = file_get_contents($file_name);
            $this->record['commands']['use_table_name'] = 'non-db';
            $this->record['commands']['custom'] = 1;

            $commands = $this->record['commands']['curVal'];
            //if(mb_substr($this->record['commands']['curVal'], -1) == ';'){
            //    $commands = substr($this->record['commands']['curVal'], 0, strlen($this->record['commands']['curVal'])-1);
            //}

            $cmd_lines = explode(';', $commands);

            $new_cmd_lines = array();

            $lines_cnt = count($cmd_lines);
            $lines_counter = 0;
            foreach ($cmd_lines as $cmd_line){
                $lines_counter++;
                $glue_flag= true;
                foreach ($acceptable_queries as $q_type => $q_tag){
                    if(strpos('-'.$cmd_line, $q_tag)){
                        $new_cmd_lines[$lines_counter]['type'] = $q_type;
                        $glue_flag = false;
                        break;
                    }
                }
                $new_lines_cnt = count($new_cmd_lines);

                if($glue_flag){
                    if($new_lines_cnt){
                        if($lines_counter < $lines_cnt){
                            //if(isset($new_cmd_lines[$new_lines_cnt-1]['query'])){
                            //    $new_cmd_lines[$new_lines_cnt-1]['query'] .= ';'.$cmd_line;
                            //}else{
                                $new_cmd_lines[$new_lines_cnt-1]['query'] = str_replace(array("\n"), '', $cmd_line);
                            //}
                        }
                    }
                }else {
                    $new_cmd_lines[$new_lines_cnt]['query'] = str_replace(array("\n"), '', $cmd_line);
                    //if ($lines_counter < $lines_cnt) {
                    //    $new_cmd_lines[$new_lines_cnt]['query'] .= ';';
                    //}
                }
            }
        }

        return $new_cmd_lines;
    }

    function exec_migration($sqlFile):array
    {

        $return=array(
            'log' => array(),
            'result' => false,
        );
        $count_q = 0;
        $count_suss = 0;
        $count_fail = 0;
        $commands_count = 0;

        $this->record['migration_name']['curVal'] = $sqlFile;
        if($this->copyRecord()){
            if($this->record['status']['curVal'] == 'new' or $this->record['status']['curVal'] == 'fail' ){
                if($commands = $this->parse_sql_file($this->docRoot.'/migrations/'.$sqlFile)){
                    $return['log'][] = 'Exec file '.$sqlFile;
                    $commands_count = count($commands);
                    if($commands_count){
                        $return['log'][] = 'count('.$commands_count.')';
                        foreach ($commands as $q_num => $q_info){
                            $return['log'][] = 'exec No: '.$q_num.', type: '.$q_info['type'];
                            if($this->pdoQuery($q_info['query'])){
                                $count_suss++;
                                $return['log'][] = 'result: SUCCESS';
                            }else{
                                $return['log'][] = 'result: FAIL';
                                foreach ($this->errorInfo() as $err_num => $err_info){
                                    //?????????????????//
                                    $err_info = str_replace(array('\r\n', '\r', '\n', '"', "'"), '',  $err_info);
                                    $return['log'][] = $err_info;
                                }
                                $count_fail++;
                            }
                            $count_q++;
                        }

                        //break here to stop exec commands if one command fail

                        $return['log'][] = 'Results: total('.$count_q.'), success('.$count_suss.'), fail('.$count_fail.')';

                    }else{
                        $return['log'][] = 'no queries in '.$sqlFile;
                    }
                }else{
                    $return['log'][] = 'no sql file or no commands (empty migration sql file) '.$sqlFile;
                }
                if($commands_count == $count_suss){
                    $return['result'] = true;
                    $this->record['status']['curVal'] = 'SUCCESS';
                }else{
                    $this->record['status']['curVal'] = 'fail';
                }

            }else{
                $return['log'][] = 'migration status is not new';
            }


            $this->record['try_date']['curVal'] = date('Y-m-d H:i:s');

            $this->updateRecord();



        }else{
            $return['log'][] = 'cant find migration in the migrations table';
        }

        $migration_log = new Model_MigrationsLog($this->docRoot, $this->configDir, [], $this->langLw);

        $migration_log->record['migration_name']['curVal'] = $sqlFile;
        $migration_log->record['add_date']['curVal'] = date('Y-m-d H:i:s');

        $migration_log->record['migration_log']['curVal'] = json_encode($return, true);

        if(!$migration_log->insertRecord()){

            echo $migration_log->log_message;
        }

        return $return;

    }

    function exec_new_migrations():array
    {
        $exec_new_result = array(
            'result' => false,
            'count_total' => 0,
            'count_success' => 0,
        );




        if($this->checkMigrationsTables()){
            $this->glob_migration_files();

            $qBuilder = new JointAppQueryBuilder();
            $qBuilder
                ->where('status in ("new", "fail")')
                ->order('migration_name');

            $list_migr = $this->listRecords($qBuilder);

            if($exec_new_result['count_total'] = count($list_migr)){
                foreach ($list_migr as $migr_num => $migr_data){
                    $this->record['migration_name']['curVal'] = $migr_data['migration_name'];
                    $migr_result = $this->exec_migration($migr_data['migration_name']);
                    $exec_new_result['result'] = $migr_result['result'];
                    if($migr_result['result']){
                        $exec_new_result['count_success']++;
                    }else{
                        break;
                    }
                }
            }else{
                //no new of fail migration
                $exec_new_result['result'] = true;
            }
        }

        return $exec_new_result;
    }

    function copyCustomFields():bool
    {
        if($this->record['migration_name']['curVal'] ){
            if(file_exists($this->docRoot.'/migrations/'.
                $this->record['migration_name']['curVal'])){
                $commands = $this->parse_sql_file($this->docRoot.'/migrations/'.
                    $this->record['migration_name']['curVal']);
                foreach ($commands as $c_num => $c_data){

                    $cmd_field_name = 'cmd_'.$c_num.'_'.$c_data['type'];
                    $fieldAliases = array(
                        'en' => 'command No: '.$c_num.', type: '.$c_data['type'],
                        'rus' => 'комманда No: '.$c_num.', Тип: '.$c_data['type'],
                    );

                    $this->record[$cmd_field_name] = array(
                        'curVal' => $c_data['query'],
                        'custom' => true,
                        'use_table_name' => 'non-db',
                        'format' => 'text',
                        'fieldAliases' => $fieldAliases,
                    );

                }
            }
        }

        return true;
    }

    function updateMigration($req_arr):bool
    {
        $commands = $this->getCommandsText($req_arr);
        file_put_contents($this->docRoot.'/migrations/'.$this->record['migration_name']['curVal'].'.sql', $commands);
        return $this->updateRecord();
    }

    function insertMigration($req_arr): bool
    {
        $commands = $this->getCommandsText($req_arr);
        file_put_contents($this->docRoot.'/migrations/'.$this->record['migration_name']['curVal'].'.sql', $commands);
        return $this->insertRecord(); // TODO: Change the autogenerated stub
    }

    function getCommandsText($req_arr):string
    {
        $commands = '';
        foreach ($req_arr as $key => $val){
            if(strpos(" ".$key, 'cmd_')){
                if($val){
                    //?????????????????????
                    //$commands.=$val.'\n';
                    $commands.=$val;
                }
            }
        }
        return $commands;
    }

    function checkMigrationsTables():bool
    {
        $result = false;
        if($this->connect_database_status){
            $mirg_commands = $this->parse_sql_file($this->docRoot.'/migrations/2024-05-20-migrations_tables.sql');
            if($this->pdoQuery('SHOW TABLES LIKE "migrations"')->fetch(\PDO::FETCH_ASSOC)){
                $result = true;
            }elseif($this->pdoQuery($mirg_commands[1]['query'])){
                $result = true;
            }
            if($result){
                if($this->pdoQuery('SHOW TABLES LIKE "migrations_log"')->fetch(\PDO::FETCH_ASSOC)){
                    $result = true;
                }elseif(!$this->pdoQuery($mirg_commands[2]['query'])){
                    $result = false;
                }
            }
        }
        return $result;
    }

    function checkDatabase():bool
    {
        if($this->connect_server_status){
            if($this->connect_database_status){
                return true;
            }elseif($this->query('CREATE DATABASE '.$this->conn_db.' CHARACTER SET utf8 COLLATE utf8_general_ci')) {
                $this->connect_database_status = true;
                return true;
            }
        }
        return false;
    }

    function updateCustomFields():bool
    {
        $commands = "";

        foreach ($this->record as $key => $val){
            if(strpos(" ".$key, 'cmd_')){

                if(!empty($this->record[$key]['curVal'])){
                    //$curVal = str_replace(array("\n"), '', $this->record[$key]['curVal']);
                    //$commands.=$curVal."\n";
                    $commands.=$this->record[$key]['curVal'].';'."\n";
                }
            }
        }

        //$commands = substr($commands, 0, strlen($commands)-1);
        if((isset($this->record['commands']['curVal']) and
                $this->record['commands']['curVal'] != $commands)
            or !isset($this->record['commands']['curVal'])){
            file_put_contents($this->docRoot.'/migrations/'.$this->record['migration_name']['curVal'], $commands);
            $this->log_message .=$this->langMap->updateRecord['success'].' migration file ';
        }

        return true;
    }

    public function insertCustomFields()
    {
        if(!file_exists($this->docRoot.'/migrations/'.$this->record['migration_name']['curVal'])){
            return $this->updateCustomFields();
        }else{
            return true;
        }

    }
}