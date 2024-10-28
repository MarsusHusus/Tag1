<?php
 
// model.php
namespace app\cars;
use lib\database;
 
class model extends database {
    public function __construct() {
        parent::__construct();
    }
 
    public function getData($sql, $data) {
        return parent::executeQuery($sql, $data);
    }
 
    public function createData($sql, $data) {
        return parent::executeQuery($sql, $data);
    }
 
    // Update data
    public function updateData($sql, $data) {
        return parent::executeQuery($sql, $data);
    }
 
    public function deleteData($sql, $data) {
        return parent::executeQuery($sql, $data);
    }    
 
    public function removeData($sql, $data = []) {
        return parent::executeQuery($sql, $data);
    }
}