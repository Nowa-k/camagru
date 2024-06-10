<?php

session_start();
require 'config.php';
require 'routes.php';

// Récupération du contrôleur et de l'action depuis l'URL
$controllerName = isset($_GET['controller']) ? $_GET['controller'] : 'feed';
$actionName = isset($_GET['action']) ? $_GET['action'] : 'index';

// Construction du nom du contrôleur et chargement
$controllerClassName = ucfirst($controllerName) . 'Controller';
require_once 'app/controllers/' . $controllerClassName . '.php';

$controller = new $controllerClassName();
$controller->$actionName();
?>
