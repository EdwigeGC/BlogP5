<?php

//autoload
require "./vendor/autoload.php";

use App\router\Router;

error_reporting(E_ALL);

const ROOT = __DIR__;

$router = new Router();
$router->route();
