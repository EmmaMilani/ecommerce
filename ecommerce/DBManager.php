<?php

class DBManager
{
    private $host, $port, $username, $password;
    function __construct($host, $port, $username, $password)
    {
        $this->host = $host;
        $this->port = $port;
        $this->username = $username;
        $this->password = $password;
    }
    public function connect($dbname)
    {
        $dsn = "mysql:dbname={$dbname};host={$this->host}";

        try {
            $pdo = new PDO($dsn, $this->username, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Connessione al DB fallita: " . $e->getMessage());
        }
    }
}
