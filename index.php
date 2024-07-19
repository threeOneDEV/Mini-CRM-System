<?php
error_reporting(E_ALL);
ini_set('display_error',1);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once('config.php');
require_once('autoload.php');

$checkAuth = new \controllers\auth\AuthController;
$checkAuth->checkAuth();
$router = new app\Router();
$router->run();
$migration = new models\Migration();
$migration->migrate();