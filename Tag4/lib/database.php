<?php 
namespace lib;
use PDO;
use PDOException;
use Exception;

class database {
    private PDO $pdo;
    private $stmt;

    public function __construct()
    {
        $host = 'localhost';
        $db = 'm295';
        $user = 'root';
        $pass = '';
        $charset = 'utf8mb4';
        $dsn = "mysql:host=$host;charset=$charset";
 
        try {
            // Verbindung zum MySQL-Server ohne Auswahl einer Datenbank herstellen
            $this->pdo = new PDO($dsn, $user, $pass);
 
            // Prüfen, ob die Datenbank `m295` existiert
            $query = $this->pdo->query("SHOW DATABASES LIKE '$db'");
            if ($query->rowCount() === 0) {
                // Wenn die Datenbank nicht existiert, das SQL-File ausführen
                $this->executeSqlFile(__DIR__ . '/./../database/database.sql');  // Aktualisierter Pfad zur SQL-Datei
            }
 
            // Jetzt die Verbindung zur spezifischen Datenbank herstellen
            $this->pdo->exec("USE $db");
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int) $e->getCode());
        }
    }
 
    private function executeSqlFile(string $filePath): void
    {
        if (!file_exists($filePath)) {
            throw new Exception("SQL file not found: $filePath");
        }
 
        // SQL-Datei einlesen
        $sql = file_get_contents($filePath);
 
        if ($sql === false) {
            throw new Exception("Failed to read SQL file: $filePath");
        }
 
        // Mehrfachabfragen im SQL-File ausführen
        $this->pdo->exec($sql);
    }

    public function executeQuerry($sql, $data) {
        try {
            $this->stmt = $this->pdo->prepare($sql);
            $this->stmt->execute($data);
            $result = $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch(PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
    
    public function executeQuery($sql, $data) {
        try {
            $this->stmt = $this->pdo->prepare($sql);
            $this->stmt->execute($data);
            return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error executing Query: " . $e->getMessage();
        }
    }
}
