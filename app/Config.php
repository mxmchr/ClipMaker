<?php
namespace Clipmaker;

use PDO;
class Config {
    private $host = "localhost";
    private $dbname = "Clipmaker";
    private $username = "root";
    private $password = "root";
    private $charset = "utf8mb4";
    private $conn;

    public function connect() {
        $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset={$this->charset}";

        try {
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }
}

