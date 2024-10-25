<?php
namespace lib;
class cars
{
    var $price;
    var $speed;
    var $fuel;
    var $mileage;
    var $tax;

    function __construct()
    {
        echo "car created";
    }
    

    public function describe()
    {
        return "Price: " . $this->price . " Speed: " . $this->speed . " Fuel: " . $this->fuel . " Mileage: " . $this->mileage . " Tax: " . $this->tax;
    }

    function __destruct()
    {
        echo "Car destroyed" . $this->price;
    }

    public function makeNoise()
    {
        echo "Vroooom";
    }
}

