<?php 
namespace lib;
use PDO;
 
class database {
    private PDO $pdo;
    private $stmt;
    function __construct() {
      $host = 'localhost';
      $db = 'm295';
      $user = 'root';
      $pass = '';
      $charset = 'utf8mb4';
      $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
      try {
        $this->pdo = new PDO($dsn, $user, $pass);
      } catch (\PDOException $e) {
        echo "Datenbank verbindung $e";
      }
    }
 
    public function executeQuerry($sql, $data) {
        try {
            $this->stmt = $this->pdo->prepare($sql);
            $this->stmt->execute($data);
            $result = $this->stmt->fetchALL(\PDO::FETCH_ASSOC);
            return $result;
        } catch(\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
 
 
    function executeQuery($sql, $data)
    {
        try {
            $this->stmt = $this->pdo->prepare($sql);
        $this->stmt->execute($data);
        return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            echo "Error executing Query: " . $e->getMessage();
        }
    }
}