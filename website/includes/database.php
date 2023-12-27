<?php
class DataBaseHelper
{
    private $db;

    public function __construct($hostname, $username, $password, $dbname, $port)
    {
        $this->db = new mysqli($hostname, $username, $password, $dbname, $port);

        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }
};
