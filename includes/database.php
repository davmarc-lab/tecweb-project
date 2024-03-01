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

    public function getDataBaseController()
    {
        return $this->db;
    }

    public function execQuery($query, $retType = MYSQLI_BOTH)
    {
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res == FALSE ? "" : $res->fetch_all($retType);
    }
};

$dbh = new DataBaseHelper("localhost", "root", "", "noteforall", 3307);
