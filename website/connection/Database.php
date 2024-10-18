<?php

class Database {
    private static $instance = null;
    private $host = 'localhost';
    private $db = 'my_shop';
    private $user = 'root';
    private $pass = '';
    private $charset = 'utf8mb4';
    private $pdo;
    private $error;

    // Constructorul privat pentru a preveni instanțierea din afara
    private function __construct() {
        $dsn = "mysql:host=$this->host;port=3307;dbname=$this->db;charset=$this->charset"; 
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $this->pdo = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    // Metoda pentru a obține instanța unică a clasei Database
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function query($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public function getLastInsertId() {
        return $this->pdo->lastInsertId();
    }

    public function beginTransaction() {
        $this->pdo->beginTransaction();
    }

    public function commit() {
        $this->pdo->commit();
    }

    public function rollBack() {
        $this->pdo->rollBack();
    }

    public function prepare($query) {
        return $this->pdo->prepare($query);
    }
}
