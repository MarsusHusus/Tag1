<?php
declare (strict_types=1);

namespace lib;

class test 
{
    public function __construct($methode = "", $parameter = "")
    {
        echo " Hello TEST Klasse <br>";
        // Call the method
        if($methode != "") {
            $this->$methode($parameter);
        }
    }

    function jaaaa(){
        echo "jaaaaaa<br>";
    }

    function getData($id){
        echo "hole aus der DB die id = $id<br>";
    }
}