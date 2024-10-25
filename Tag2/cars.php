<?php
class cars
{
    var $price;
    var $speed;
    var $fuel;
    var $mileage;
    var $tax;

    function __construct(int $price, int $speed, string $fuel, $mileage, $tax)
    {
        $this->price = $price;
        $this->speed = $speed;
        $this->fuel = $fuel;
        $this->mileage = $mileage;
        $this->tax = $tax;
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

