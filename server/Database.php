<?php

class Database
{
    private $db;

    function __construct()
    {
        $this->connect_database();
    }

    public function getInstance()
    {
        return $this->db;
    }

    private function connect_database()
    {
        $dbuser = 'root';
        $dbpass = '';

        try {
            $connection_string = 'mysql:host=localhost;dbname=wprg_projekt';
            $connection_array = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            );

            $this->db = new PDO($connection_string, $dbuser, $dbpass, $connection_array);
        } catch (PDOException $e) {
            $this->db = null;
        }
    }
}