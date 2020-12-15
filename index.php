<?php

//autoload
require "./vendor/autoload.php";

use App\router\Router;

error_reporting(E_ALL);

const ROOT = __DIR__;

//routes
$router = new Router();
$router->route();

//Rendu du template
/*$loader = new \Twig\Loader\FilesystemLoader('/path/to/templates');
$twig = new \Twig\Environment($loader, [
    'cache' => '/path/to/compilation_cache',
]);*/