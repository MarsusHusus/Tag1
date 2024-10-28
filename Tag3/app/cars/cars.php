<?php
namespace app\cars;
use Exception;
use lib\test;
class cars 
{
    // Methode zum testen wo test klase insanz hat
     private test $test;
     private model $model;
 
     public function __construct(string $methode = "", ...$parameters) {
        $this->model = new model();
        if (!empty($methode) && method_exists($this, $methode)) {
            try {
                call_user_func_array([$this, $methode], $parameters); // Call the method with all parameters
            } catch(Exception $e) {
                echo "Error: " . $e->getMessage(); 
            }
        } else {
            $this->init();
        }
    }

 
 
     public function init(): void{
        $this->test = new test();
     }
 
     public function showData($data): void
     {
         echo "<pre>";
         print_r($data);
         echo "</pre>";
     }
     function getData($id = null) {
        if ($id !== null) {
            echo "hole aus der DB die id = $id<br>";
            $sql = "SELECT * FROM cars WHERE id = :id";
            $data = ["id" => $id];
        } else {
            echo "hole alle Datensätze aus der DB<br>";
            $sql = "SELECT * FROM cars";
            $data = [];
        }
        $data = $this->model->getData($sql, $data);
        $this->showData($data);
    }
    public function MeinTest($parameter): void{
        echo "MeinTest method called with parameter $parameter";
        $this->test = new test(methode: $parameter, parameter: 4);
    }
 
    // Method to create data
    public function createData(
        string $name,
        float $price,
        string $kraftstoff,
        string $farbe,
        string $bauart,
        int $tank,
        string $jahrgang,
        string $createDate,
        int $active
    ): void {
        
        // SQL statement with all fields
        $sql = "INSERT INTO cars (name, price, kraftstoff, farbe, bauart, tank, jahrgang, createDate, active) 
                VALUES (:name, :price, :kraftstoff, :farbe, :bauart, :tank, :jahrgang, :createDate, :active)";
        $data = [
            "name" => $name,
            "price" => $price,
            "kraftstoff" => $kraftstoff,
            "farbe" => $farbe,
            "bauart" => $bauart,
            "tank" => $tank,
            "jahrgang" => $jahrgang,
            "createDate" => $createDate,
            "active" => $active
        ];
        // Call the model's createData method to insert the data
        $this->model->createData($sql, $data);
        echo "Data inserted successfully!";
    }

 
        // Method to update data
        public function updateData(int $id, string $name, float $price, string $kraftstoff, string $farbe, string $bauart, int $tank, string $jahrgang, string $createDate, int $active): void {
            // SQL statement to update data
            $sql = "UPDATE cars SET name = :name, price = :price, kraftstoff = :kraftstoff, farbe = :farbe, 
                    bauart = :bauart, tank = :tank, jahrgang = :jahrgang, createDate = :createDate, active = :active 
                    WHERE id = :id";
            $data = [
                "id" => $id,
                "name" => $name,
                "price" => $price,
                "kraftstoff" => $kraftstoff,
                "farbe" => $farbe,
                "bauart" => $bauart,
                "tank" => $tank,
                "jahrgang" => $jahrgang,
                "createDate" => $createDate,
                "active" => $active
            ];
            $this->model->updateData($sql, $data);
            echo "Data with ID $id updated successfully!";
        }
 
        public function deleteData(int $id): void {
            // SQL statement to delete data
            $sql = "DELETE FROM cars WHERE id = :id";
            $data = ['id' => $id];
            // Call the model's deleteData method to delete the record
            $this->model->deleteData($sql, $data);
            echo "Data with ID $id deleted successfully!";
        }

        // Method to remove all data from the table
        public function removeAllData() {
            $sql = "DELETE FROM cars";
            $this->model->removeData($sql);
            echo "All data removed successfully!";
        }
}