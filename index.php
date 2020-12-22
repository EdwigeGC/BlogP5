<?php

//autoload
require "./vendor/autoload.php";

use App\router\Router;

error_reporting(E_ALL);

const ROOT = __DIR__;

//routes
$router = new Router();
$router->route();

//Twig
/*
require_once '/path/to/vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('App/views/templates');
$twig = new \Twig\Environment($loader, [
    'cache' => false
]);
*/