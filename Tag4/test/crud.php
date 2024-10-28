<?php

//include "./../lib/database.php";
//include "./../app/cars/model.php";
//include "./../app/cars/cars.php";
include "./../vendor/autoload.php";
//include "./../vendor/vlucas/valitron/src/Valitron/Validator.php";

$green = "\033[32m";
$red = "\033[31m";
$yellow = "\033[33m";
$reset = "\033[0m";

echo "$yellow Testing CRUD operations\n";
// instanz von cars erstellen
$cars = new app\cars\cars();

//insert

$_POST = [
    "name" => "aaa",
    "price" => 43,
    "kraftstoff" => "Benzin",
    "farbe" => "Schwarz",
    "bauart" => "we",
    "tank" => 0,
    "jahrgang" => "etr4",
    "createDate" => "34543",
    "active" => 1
];

ob_start();
$cars->getData();
$ausgabe = ob_get_clean();
echo $ausgabe;

echo (string) $reset;
