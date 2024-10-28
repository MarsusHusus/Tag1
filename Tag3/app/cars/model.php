<?php
namespace app\cars;
 
use Exception;
use lib\database;
 
/**
* Klasse model für die Interaktion mit der Datenbank, die von der `database`-Klasse erbt.
*/
class model extends database
{
    /**
     * Konstruktor der Klasse model.
     */
    public function __construct()
    {
        parent::__construct();
    }
 
    /**
     * Führt eine SQL-Abfrage aus und gibt die Daten zurück.
     *
     * @param string $sql  Die SQL-Abfrage, die ausgeführt werden soll.
     * @param array<string, mixed> $data Die Daten, die in die SQL-Abfrage eingefügt werden sollen.
     * @return mixed       Die Ergebnismenge der Abfrage.
     */
    public function getData(string $sql, array $data): mixed
    {
        $result = parent::executeQuery($sql, $data);
        return $result;
    }
 
    /**
     * Führt eine SQL-Operation aus (Insert, Update, Delete).
     *
     * @param string $sql  Die SQL-Abfrage, die ausgeführt werden soll.
     * @param array<string, mixed> $data Die Daten, die in die SQL-Abfrage eingefügt werden sollen.
     * @return mixed       Das Ergebnis der Ausführung.
     */
    public function execute(string $sql, array $data): mixed
    {
        return parent::executeQuery($sql, $data);
    }
}