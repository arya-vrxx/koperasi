<?php

class Database
{
    private $host = "localhost";
    private $db_name = "inikoperasi";
    private $username = "root";
    private $password = "";
    private $pdo;

    public function __construct()
    {
        $dsn = "mysql:host=$this->host;dbname=$this->db_name;charset=utf8mb4";
        $this->pdo = new PDO($dsn, $this->username, $this->password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    public function getConnection()
    {
        return $this->pdo;
    }
}