<?php
class Controller_Products extends Controller
{
    function action_jointsite()
    {
        global $request;
        if(isset($request["routes"][$request["exec_dir_cnt"]+2]) and $request["routes"][$request["exec_dir_cnt"]+2] != null){
            if(!in_array($request["routes"][$request["exec_dir_cnt"]+2], array_keys($this->view->branches))){
                jointSite::throwErr("notFound", "product not found");
            }
        }
        parent::action_index(); // TODO: Change the autogenerated stub
    }
}