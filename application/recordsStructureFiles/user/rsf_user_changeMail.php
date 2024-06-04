<?php
class rsf_user_changeMail extends recordStructureFields
{
    function __construct()
    {
        $this->record = array(
            "eMail" => array(
                "format" => "varchar",
            )
        );

        $this->editFields = array(
            "eMail" => array(
                "format" => "varchar",
            )
        );
    }
}