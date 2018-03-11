<?php
require 'vendor/AltoRouter.php';

$router = new AltoRouter();

// Pages
$router->map('GET', '/', function () {
    require __DIR__ . '/php/index.php';
});

$router->map('GET', '/login', function () {
    require __DIR__ . '/php/login.php';
});

$router->map('GET', '/eq/[i:id]', function ($id) {
    require __DIR__ . "/php/equation.php";
});

// Non-page routes
$router->map('POST', '/newsession', function () {
    require __DIR__ . "/php/newsession.php";
});

$router->map('POST', '/newuser', function () {
    require __DIR__ . '/php/newuser.php';
});

$router->map('GET', '/logout', function () {
    require __DIR__ . "/php/logout.php";
});

$match = $router->match();

if ($match && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    echo "404 Not Found";
}
