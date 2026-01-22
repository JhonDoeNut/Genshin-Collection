<?php
session_start();

use League\Plates\Engine;
use Controllers\Router\Router;

require_once 'Helpers/Psr4AutoloaderClass.php';
$loader = new Helpers\Psr4AutoloaderClass();
$loader->register();
$loader->addNamespace('\Helpers','/Helpers');
$loader->addNamespace('\League\Plates','/Vendor/plates-3.6.0/src');
$loader->addNamespace('\Controllers','/Controllers');
$loader->addNamespace('\Config','/Config');
$loader->addNamespace('\Models','/Models');
$loader->addNamespace('\Helpers','/Helpers');

$engine = new Engine(__DIR__ . '/Views');

try {
    $router = new Router($engine);
    $router->routing();
} catch (Exception $e) {
    echo $engine->render('error', [
        'message' => $e->getMessage()
    ]);
}
