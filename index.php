<?php
require 'vendor/AltoRouter.php';

$router = new AltoRouter();
$router->setBasePath('/tode/');

$router->map('GET', '', function() {
    require __DIR__ . '/views/index.php';
});

$match = $router->match();

if ($match && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    echo "404 Not Found";
}
