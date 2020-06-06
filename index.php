<?php
require_once __DIR__ . "/Router.php";
require_once __DIR__ . "/Request.php";
require_once __DIR__ . "/controllers/HomeController.php";
require_once __DIR__ . "/controllers/EditController.php";

$router = new Router(new Request());

$router->get('/', [HomeController::class, 'Home']);

$router->post("/", [HomeController::class, 'postHome']);

$router->post("/Editor", [EditController::class, 'editor']);

$router->get('/About', [HomeController::class, 'about']);

$router->get('/Demo', [HomeController::class, 'demo']);