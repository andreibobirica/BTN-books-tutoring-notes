<?php
class Database
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "btn";
    //database modificato con credenziali di tecweb server

    private $conn = null;

    public function __construct()
    {
        $this->connect();
    }

    public function __destruct()
    {
        $this->disconnect();
    }

    public function connect()
    {
        // Create connection
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function disconnect()
    {
        if (isset($this->conn) && !is_null($this->conn))
            $this->conn->close();
    }

    public function query($str)
    {
        if (isset($str) && !empty($str)) {
            $result = $this->conn->query($str);
            return $result;
        }
    }

    public function getConn()
    {
        return $this->conn;
    }
}