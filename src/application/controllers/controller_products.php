<?php
class Controller_Products extends Controller
{
    function action_jointsite()
    {
        global $request;
        if(isset($request["routes"][3]) and $request["routes"][3] != null){
            if(!in_array($request["routes"][3], array_keys($this->view->branches))){
                jointSite::throwErr("notFound", "product not found");
            }
        }
        parent::action_index(); // TODO: Change the autogenerated stub
    }
}