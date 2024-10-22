<?php

class DataBaseModel
{
    private $host = "localhost";
    private $port = "3310";
    private $username = "root";
    private $password = "";
    private $dbName = "tdw_project_model";

    public function connect()
    {
        try {

            $connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbName . ";charset=utf8;port=" . $this->port, $this->username, $this->password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $connection;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function disconnect(&$connection)
    {
        $connection = null;
    }

    public function request($db, $query)
    {
        return $db->query($query);
    }
}
















?>