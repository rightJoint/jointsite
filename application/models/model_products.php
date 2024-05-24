<?php
class model_products extends Model_pdo
{
    function throwErrNoConn()
    {
        //jointSite::throwErr("connection", $this->log_message);
    }
}