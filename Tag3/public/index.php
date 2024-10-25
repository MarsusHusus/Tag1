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

Route::pathNotFound(function() {
    echo "Error 404 <br>";
});

// Run the router
Route::run('/');