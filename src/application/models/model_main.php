<?php
class Model_main extends Model_pdo
{
    function throwErrNoConn():bool
    {
        //jointSite::throwErr("connection", $this->log_message);
    }
}