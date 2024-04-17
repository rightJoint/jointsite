<?php
include "application/core/Records/RecordsModel.php";
class model_notes extends RecordsModel
{
    public $tableName = "notesList_dt";

    function getRecordStructure()
    {
        $this->record = array(
            "note_id" => array(
                "indexes" => 1,
                "format" => "varchar",
            ),
            "noteContent" => array(
                "format" => "text",
            ),
            "created_date" => array(
                "format" => "date",
            ),
            "created_by" => array(
                "format" => "varchar",
            ),
        );
        $this->editFields = array(
            "note_id" => array(
                "indexes" => 1,
                "format" => "varchar",
            ),
            "noteContent" => array(
                "format" => "text",
            ),
            "created_date" => array(
                "format" => "date",
            ),
            "created_by" => array(
                "format" => "varchar",
            ),
        );
        $this->listFields = array(
            "btnDetail" => array(
                "replaces" => array("note_id"),
                "format" => "link",
                "url" => "note_id=note_id",
            ),
            "btnEdit" => array(
                "replaces" => array("note_id"),
                "format" => "link",
                "url" => "note_id=note_id",
            ),
            "btnDelete" => array(
                "replaces" => array("note_id"),
                "format" => "link",
                "url" => "note_id=note_id",
            ),
            "note_id" => array(
                "format" => "varchar",
            ),
            "noteContent" => array(
                "format" => "text",
                "maxLength" => 20,
            ),
            "created_date" => array(
                "format" => "date",
            ),
            "created_by" => array(
                "format" => "varchar",
                "maxLength" => 20,
            ),
        );
        $this->searchFields = array(
            "note_id" => array(
                "indexes" => 1,
                "format" => "varchar",
                "sort" => 1,
                "search" => 1,
            ),
            "noteContent" => array(
                "format" => "text",
                "sort" => 1,
                "search" => 1,
            ),
            "created_date" => array(
                "format" => "date",
                "sort" => 1,
                "search" => 1,
            ),
            "created_by" => array(
                "format" => "varchar",
                "sort" => 1,
                "search" => 1,
            ),
        );
        $this->viewFields = array(
            "note_id" => array(
                "indexes" => 1,
                "format" => "varchar",
                "readonly" => 1,
            ),
            "noteContent" => array(
                "format" => "text",
                "readonly" => 1,
            ),
            "created_date" => array(
                "format" => "date",
                "readonly" => 1,
            ),
            "created_by" => array(
                "format" => "varchar",
                "readonly" => 1,
            ),
        );
    }

    function get_pre_note()
    {
        if($this->record["created_date"]["curVal"]){
            $use_date = $this->record["created_date"]["curVal"];
        }else{
            $use_date = date("Y-m-d H:i:s");
        }
        $find_qry = "select note_id from ".$this->tableName." ".
            "where created_date < '".$use_date."'  order by created_date desc limit 1";
        $find_res = $this->query($find_qry);
        if($find_res->rowCount()){
            $find_row = $find_res->fetch(PDO::FETCH_ASSOC);
            return $find_row["note_id"];
        }
        return null;
    }
    function get_next_note()
    {
        if($this->record["created_date"]["curVal"]){
            $use_date = $this->record["created_date"]["curVal"];
        }else{
            $use_date = date("Y-m-d H:i:s");
        }
        $find_qry = "select note_id from ".$this->tableName." ".
            "where created_date > '".$use_date."'  order by created_date asc limit 1";
        $find_res = $this->query($find_qry);
        if($find_res->rowCount()){
            $find_row = $find_res->fetch(PDO::FETCH_ASSOC);
            return $find_row["note_id"];
        }
        return null;
    }
}