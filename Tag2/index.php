<?php
spl_autoload_register(function ($class) {
    include  $class . '.php';
});
$class = $_GET['class'] ?? '\lib\cars';
$methode = $_GET['methode'] ?? '';
$parameter = $_GET['parameter'] ?? '';
$params = $_GET['params'] ?? '';
$parameter = $params ? json_decode($params, true) : $parameter;
try {
    $app = new $class($methode, $parameter);
} catch(Exception $e) {
    echo $e->getMessage();
}

//index.php?class=\lib\cars
//index.php?class=\lib\books
//index.php?class=\lib\users
//index.php?class=\app\databases
//index.php?class=\app\database&methode=getData

//http://localhost/Tag2/index.php?class=\app\database&methode=getData&parameter=hallo

//http://localhost/Tag2/index.php?class=\app\database&methode=addData&parameter=Auto

//http://localhost/Tag2/index.php?class=\app\database&method=updateData&parameter={"id":14,"name":"Honda Accord"}

/*
if(isset($_GET['class'])) {
    $class = $_GET['class'];
} else {
    $class = '\lib\cars';
}
echo $class . "<br>";

$app = new $class();
*/

/*
include ('cars1.php');
include ('cars2.php');
$speed = 100;
$fuel = 'petrol';
$mileage = 10;
$tax = 0.1;
$car = new guguseli\cars(1000, $speed, $fuel, $mileage, $tax);
$car = new miau\cars(1000, $speed, $fuel, $mileage, $tax);

$car = new cars(1000, $speed, $fuel, $mileage, $tax);


echo $car->describe() . "<br>" . $car->describe();

unset($car);




abstract class cars
{
    public static function ja()
    {
        echo "ja";
    }
}

cars::ja();


class Faecher
{
    public $Name;
    public function __construct($name)
    {
        $this->Name = $name;
    }
}

class Mathe extends Faecher
{
    public function __construct()
    {
        parent::__construct('mathe');
        echo parent::$Name;
        cars::ja();
    }
}
$bluna = new Mathe();
*/