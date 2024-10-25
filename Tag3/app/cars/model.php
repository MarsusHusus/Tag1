<?php

namespace app\cars;
use lib\database;

class model extends database {
    public function __construct() 
    {
        parent::__construct();
    }

    public function getData($sql, $data)
    {
        $data = parent::executeQuery($sql, $data);
        return $data;
    }
}