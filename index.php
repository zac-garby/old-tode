<?php
require 'vendor/AltoRouter.php';

$router = new AltoRouter();

// Pages
$router->map('GET', '/', function () {
    require __DIR__ . '/php/pages/home.php';
});

$router->map('GET', '/login', function () {
    require __DIR__ . '/php/pages/login.php';
});

$router->map('GET', '/eq/[i:id]', function ($id) {
    require __DIR__ . "/php/pages/equation.php";
});

$router->map('GET', '/user/[*:name]', function ($name) {
    require __DIR__ . "/php/pages/user.php";
});

$router->map('GET', '/new', function () {
    require __DIR__ . "/php/pages/add.php";
});

// Non-page routes
$router->map('POST', '/newsession', function () {
    require __DIR__ . "/php/actions/newsession.php";
});

$router->map('POST', '/newuser', function () {
    require __DIR__ . '/php/actions/newuser.php';
});

$router->map('GET', '/logout', function () {
    require __DIR__ . "/php/actions/logout.php";
});

$match = $router->match();

if ($match && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    echo "404 Not Found";
}
