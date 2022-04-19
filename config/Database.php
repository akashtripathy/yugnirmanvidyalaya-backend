<?php
class Database
{
    // Db param
    private $host = "localhost";
    private $db_name = "u984052071_yug_nirman_vid";
    private $username = "u984052071_Yugnirman145";
    private $password = "Yugnirman@8339013251";
    private $conn;

    // DB Connect
    public function connect()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }

        return $this->conn;
    }
}
