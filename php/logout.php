<?php

unset($_COOKIE['sessid']);
setcookie('sessid', null, -1, '/');

$url = "https://" . $_SERVER['HTTP_HOST'] . "/";

header("Location: $url");
