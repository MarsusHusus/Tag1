<?php
 
// Alle variabelkn deklarieren bevor sie verwendet werden
declare(strict_types=1);
 
// composer soll dependencies von autoload.php laden
require __DIR__ . '/../vendor/autoload.php';
 
// Use this namespace
use Steampixel\Route;
 
// Add the first route
Route::add('/info', function () {
    phpinfo();
}, 'get');
 
Route::add('/', function () {
    echo "hi";
}, 'get');
 
// Add the first route
Route::add('/([a-zA-Z0-9]*)', function ($class) {
    echo "Hello von ROUTE::ADD nur Klasse:  $class<br>";
    $appclass = "app\\$class\\$class";
 
    // Check if the class exists
    if (class_exists($appclass)) {
        $app = new $appclass();
    } else {
        // Redirect to 404 page
        include __DIR__ . '/../error/404.php';
    }
}, 'get');
 
 
// '/([a-zA-Z0-9]*)/([a-zA-Z0-9]*)',
//'/([a-zA-Z0-9]/[a-zA-Z0-9]*)',
 
// Add the first route
Route::add('/([a-zA-Z0-9]*)/([a-zA-Z0-9]*)', function ($class, $methode) {
    echo "Hello von ROUTE::ADD  Klasse und Methode: $class<br>";
    $appclass = "app\\$class\\$class";
 
    // Check if the class exists
    if (class_exists($appclass)) {
        $app = new $appclass($methode);
    } else {
        echo "Class $class not found";
    }
}, 'get');
 
Route::add('/([a-zA-Z0-9]*)/([a-zA-Z0-9]*)/([a-zA-Z0-9]*)', function ($class, $methode, $parameter) {
    echo "Hello von ROUTE::ADD  Klasse und Methode: $class<br>";
    $appclass = "app\\$class\\$class";
 
    // Check if the class exists
    if (class_exists($appclass)) {
        $app = new $appclass($methode, $parameter);
    } else {
        echo "Class $class not found";
    }
}, 'get');
 
Route::add('/cars/createData', function () {
    // Get the JSON body
    $data = json_decode(file_get_contents("php://input"), true);
    // Check if the required fields are present
    if (isset($data['name'], $data['price'], $data['kraftstoff'], $data['farbe'], 
               $data['bauart'], $data['tank'], $data['jahrgang'], $data['createDate'], $data['active'])) {
        $app = new app\cars\cars(); // Create an instance of the cars class
        $app->createData( // Call the createData method
            $data['name'],
            (float)$data['price'], // Ensure this is a float
            $data['kraftstoff'],
            $data['farbe'],
            $data['bauart'],
            (int)$data['tank'], // Ensure this is an int
            $data['jahrgang'],
            $data['createDate'],
            (int)$data['active'] // Ensure this is an int
        );
    } else {
        echo json_encode(["error" => "All fields are required."]);
    }
}, 'post');
 
// Add the route for updating data
Route::add('/cars/updateData', function () {
    $data = json_decode(file_get_contents("php://input"), true);
    // Check if the required fields are present
    if (isset($data['id'], $data['name'], $data['price'], $data['kraftstoff'], $data['farbe'], 
               $data['bauart'], $data['tank'], $data['jahrgang'], $data['createDate'], $data['active'])) {
        $app = new app\cars\cars(); // Create an instance of the cars class
        $app->updateData(
            $data['id'],
            $data['name'],
            (float)$data['price'], // Ensure this is a float
            $data['kraftstoff'],
            $data['farbe'],
            $data['bauart'],
            (int)$data['tank'], // Ensure this is an int
            $data['jahrgang'],
            $data['createDate'],
            (int)$data['active'] // Ensure this is an int
        );
    } else {
        echo json_encode(["error" => "All fields are required."]);
    }
}, 'patch'); // Change 'post' to 'patch'
 
 
Route::pathNotFound(function() {
    echo "Error 404 <br>";
});
 
// Run the router
Route::run('/');