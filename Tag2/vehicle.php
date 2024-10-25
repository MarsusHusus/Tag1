<?php 
    abstract class vehicle {
        public $wheels;
        public $engine;
        public $doors;
        public function move() {
            echo "Wheels move";
        }
    }

    class bike extends vehicle{
        public function moveWheels() {
            echo "Wheels move";
        }
    }

    class boat extends vehicle{

    }
?>