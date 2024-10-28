<?php
namespace app\cars;

use Exception;
use lib\test;
use lib\Response;
use Valitron\Validator;

class cars
{
    // Method for testing where the test class instance exists
    private model $model;

    // Specify the type for responseArray as an associative array with specific key types and value types
    /** 
     * @var array{
     *     sql: string, 
     *     prepare: mixed, 
     *     success?: bool, 
     *     data?: mixed, 
     *     error?: bool
     * }
     */
    private array $responseArray;

    public function __construct(string $methode = "", mixed $parameters = "")
    {
        // Initialisierung von responseArray
        $this->responseArray = [
            'sql' => '',
            'prepare' => [],
            'success' => false,  // Standardmäßig false, da wir annehmen, dass der Prozess fehlschlagen könnte
            'data' => null,      // null bis wir echte Daten haben
            'error' => false     // Standardmäßig false, kein Fehler
        ];
        $this->model = new model();
        
        if (!empty($methode) && method_exists($this, $methode)) {
            try {
                $this->{$methode}($parameters);
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }

    public function init(): void
    {
        // Implementation can be added later
    }

    public function showData(mixed $data): void
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }

    public function getData(string $id = ""): void
    {
        if ($id === "" || $id === "0") {
            $sql = "SELECT * FROM cars";
            $data = [];
        } else {
            $sql = "SELECT * FROM cars WHERE id = :id";
            $data = ["id" => $id];
        }

        $this->responseArray['sql'] = $sql;
        $this->responseArray['prepare'] = $data;

        $data = $this->model->getData($sql, $data);

        if (count($data)) {
            $this->responseArray['success'] = true;
            $this->responseArray['data'] = $data;
        } else {
            $this->responseArray['error'] = true;
        }

        \lib\response::successJSON($this->responseArray);
    }

    public function insertData(string $parameter = ""): void
    {
        if (empty($_POST)) {
            echo "Fehler: Keine Post-Daten vorhanden";
            return;
        } else {
            $sql = "INSERT INTO cars (name, price, kraftstoff, farbe, bauart, tank, jahrgang, createDate, active) 
                VALUES (:name, :price, :kraftstoff, :farbe, :bauart, :tank, :jahrgang, :createDate, :active)";
            $data = $_POST;

            $v = new Validator($data);
            $v->rule('required', 'name')->message('Name is required');
            $v->rule('regex', 'name', '/^[a-zA-Z0-9\s]+$/')->message('Nur Buchstaben und Zahlen sind erlaubt');
            $v->rule('lengthMin', 'name', 3)->message('Name muss mindestens 3 Zeichen lang sein');
            $v->rule('lengthMax', 'name', 255)->message('Name muss maximal 255 Zeichen lang sein');

            // Validate data
            if (!$v->validate()) {
                echo "Fehler: <pre>";
                print_r($v->errors());
                echo "</pre>";
            } else {
                // Call the model's createData method to insert the data
                $this->model->createData($sql, $data);
                echo "Data inserted successfully!";
            }
        }
    }

    public function createData(): void
    {
        if (empty($_POST)) {
            echo "Fehler: Keine Post-Daten vorhanden";
            return;
        }
        $sql = "INSERT INTO cars (name, price, kraftstoff, farbe, bauart, tank, jahrgang, createDate, active) 
                VALUES (:name, :price, :kraftstoff, :farbe, :bauart, :tank, :jahrgang, :createDate, :active)";
        $data = $_POST;

        $this->model->createData($sql, $data);
        echo "Data inserted successfully!";
    }

    public function updateData(int $id, string $name, float $price, string $kraftstoff, string $farbe, string $bauart, int $tank, string $jahrgang, string $createDate, int $active): void
    {
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

    public function deleteData(int $id): void
    {
       if ($_SESSION['stuffe'] == 1) {
        $sql = "DELETE FROM cars WHERE id = :id";
        $data = ['id' => $id];
        $this->model->deleteData($sql, $data);
        echo "Data with ID $id deleted successfully!";
        } else {
            response::errorJSON(array: ["error" => "keine Berechtigung"]);
        }

    }

    public function removeAllData(): void
    {
        $sql = "DELETE FROM cars";
        $this->model->removeData($sql);
        echo "All data removed successfully!";
    }
}
