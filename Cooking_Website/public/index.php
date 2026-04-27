<?php
require_once "../app/core/Database.php";
require_once '../app/core/init.php';
// require_once '../app/core/routes.php';
require_once "../app/models/Contact.php";
require_once '../app/controllers/MainController.php';
// require_once '../app/controllers/UserController.php';
// require_once "./assets/views/styles/homepage.css";

$env = parse_ini_file('../final.env');
require '../app/core/config.php';

// use app\core\Router;

require_once __DIR__ . '/helpers.php';

use app\controllers\MainController;

//to add a new route add to the app/core/routes.php array
//$router = new Router($routes);
// $router->serveRoute();

$uri = strtok($_SERVER["REQUEST_URI"], '?');

$uriArray = explode("/", $uri);

//views
if ($uri === '/' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $MainController = new MainController();
    $MainController->homepage();
}

if ($uri === '/browse' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $MainController = new MainController();
    $MainController->browse();
}

if ($uri === '/recipes' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $MainController = new MainController();
    $MainController->recipes();
}

if ($uri === '/favorites' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $MainController = new MainController();
    $MainController->favorites();
}

if ($uri === '/newRecipes' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $MainController = new MainController();
    $MainController->newRecipes();
}


if ($uri === '/contacts' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $MainController = new MainController();
    $MainController->contacts();
}


if ($uri === '/sharing' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $MainController = new MainController();
    $MainController->sharing();
}



if ($uri === '/ingredients' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $MainController = new MainController();
    $MainController->ingredients();
}

if ($uri === '/contacts' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $MainController = new MainController();
    $MainController->saveContact();
}
if ($uri === '/newRecipes' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $MainController = new MainController();
    $MainController->theNewRecipes();
}

/*
else{

    $MainController = new MainController();
    $MainController->notFound();
    
}
*/
?>






