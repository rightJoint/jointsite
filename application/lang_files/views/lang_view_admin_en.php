<?php
class lang_view_admin_en extends lang_view_en
{
    function __construct()
    {
        $this->head["description"] = "With admin tool you can connect to database, " .
            "load to DB entire tables, execute sql queries, " .
            "find and edit records in tables. " .
            "It is completed project, may use for deploy another modules to make " .
            "needed migrations, might be helpful who dont know another simple way for that";
        $this->head["title"] = "MySql Admin";
        $this->head["h1"] = "MySql Admin";
        $this->admin_h2 = "Use menu for beginning";
    }
}
