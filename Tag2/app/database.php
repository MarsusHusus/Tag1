<?php
namespace app;
use PDO;
class database {
    private $pdo;
    function __construct($methode, $parameter){
        echo "database - Klasse geladen";
        //lib/database
        $this->pdo = new PDO('mysql:host=localhost;dbname=m295', 'root', '');   

        if(method_exists($this, $methode)) {
            $this->$methode($parameter);
        } else {
            echo "Methode nicht gefunden";
            \lib\response::error(404);
        }
    }
 
    function getData($parameter) {
        try {
            // SQL-Abfrage vorbereiten und ausführen
            if ($parameter) {
                //CONTROLLER cars
                $sql = "SELECT * FROM cars WHERE id = :id";
                //Model cars oder parnt::execute Query
                $statement = $this->pdo->prepare($sql);
                $statement->execute([':id' => $parameter]);
            } else {
                $sql = "SELECT * FROM cars";
                $statement = $this->pdo->prepare($sql);
                $statement->execute();
            }
            // Ergebnisse holen
            // Model cars gibt dann an CONTROLLER CARS zurück
            $cars = $statement->fetchAll(PDO::FETCH_ASSOC);
            // Array ausgeben zur Kontrolle
            //CONTROLLER CARS -> ANZEIGE
            echo "<pre>";
            print_r($cars);
            echo "</pre>";
        } catch (\PDOException $e) {
            // Fehlerbehandlung, wenn eine PDOException auftritt
            echo "Datenbankfehler: " . $e->getMessage();
            die();
        } catch (\Exception $e) {
            // Fehlerbehandlung für andere mögliche Exceptions
            echo "Allgemeiner Fehler: " . $e->getMessage();
            die();
        }
    }

 
 
    function execute($sql, $parameters = [])
    {
        $statement = $this->pdo->prepare($sql);
        $statement->execute($parameters);
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
    function addData($name) {
        $sql = "INSERT INTO cars (name, price, kraftstoff, farbe, bauart, tank, jahrgang) VALUES
        ('$name', '54353', 'Diesel', '#00ffff', 'Limousine', 0, '2019-08-07')";
/*
        $sql = "INSERT INTO cars (name) VALUES (:name )";
        //$post = $_POST;
        $data = [ 'namee' => "Honda"];
 
        $this->pdo->prepare($sql);
        $this->pdo->execute($data);
*/
        $this->pdo->exec($sql);
 
        echo "Data added successfully";
        echo "e";
    }
 
    function deleteData($id) {
        try {
            // SQL-Abfrage vorbereiten
            $sql = "DELETE FROM cars WHERE id = :id";
            // Prepared Statement
            $statement = $this->pdo->prepare($sql);
            // Ausführen der SQL-Abfrage mit Parameterbindung
            $statement->execute([':id' => $id]);
            // Bestätigung der Löschung
            echo "Datensatz mit der ID $id wurde erfolgreich gelöscht.";
        } catch (\PDOException $e) {
            // Fehlerbehandlung, wenn eine PDOException auftritt
            echo "Datenbankfehler: " . $e->getMessage();
            die();
        } catch (\Exception $e) {
            // Fehlerbehandlung für andere mögliche Exceptions
            echo "Allgemeiner Fehler: " . $e->getMessage();
            die();
        }
    }

    function updateData($array)
    {
        $id = $array['id'];
        $name = $array['name'];
        $sql = "UPDATE cars 
                SET name = :name
                WHERE id = :id";
        $parameters = [
            ':name' => $name,
            ':id' => $id
        ];
 
        $this->execute($sql, $parameters);
        echo "Auto erfolgreich aktualisiert!";
    }

}