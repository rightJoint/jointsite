<?php

class DbConnector
{
    private string $loc = 'localhost';
    private string $pw = 'example';
    private string $user = 'root';
    private string $db = 'js_db';

    public function __construct($loc = 'localhost', $db = 'xweb', $user = 'root', $pw = 'example')
    {
        $this->loc = $loc;
        $this->pw = $pw;
        $this->user = $user;
        $this->db = $db;
    }

    public function getLoc()
    {
        return $this->loc;
    }

    public function getPw()
    {
        return $this->pw;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getDb()
    {
        return $this->db;
    }
}