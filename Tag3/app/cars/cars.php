<?php
namespace app\cars;
use Exception;
use lib\test;
class cars 
{
    // Methode zum testen wo test klase insanz hat
     private test $test;
     private model $model;

     public function __construct(string $methode = "", string $parameter = "") {
        $this->model = new model();
        if(!empty($methode) && method_exists(object_or_class: $this, method: $methode)) {
            try{
                $this->$methode($parameter);
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
     function getData($id){
        echo "hole aus der DB die id = $id<br>";
        if ($id != null) {
        $sql = "SELECT * FROM cars WHERE id = :id";
        $data[] = [ "id" => $id ];
        } else {
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
}