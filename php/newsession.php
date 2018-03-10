<?php

require "db.php";

$username = $_POST['username'];
$password = $_POST['password'];

$query = $link->prepare("SELECT id, password_hash, salt FROM users WHERE username = ?");
$query->bind_param("s", $username);
$query->execute();
$result = $query->get_result();

$row = $result->fetch_assoc();

if (!$row) {
    http_response_code(403);
    echo "user doesn't exist";
    return;
}

$userid = $row['id'];
$salt = $row['salt'];
$remote_hash = $row['password_hash'];
$calculated_hash = hash("sha256", $password . $salt);

if ($remote_hash != $calculated_hash) {
    http_response_code(403);
    echo "wrong password";
    return;
}
// else: the login was successful

// Generate a session ID
$characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
$charlength = strlen($characters);
$sessid = "";

for ($i = 0; $i < $charlength; $i++) {
    $sessid .= $characters[rand(0, $charlength - 1)];
}

$query = $link->prepare("INSERT INTO sessions (sessid, userid) VALUES (?, ?)");
$query->bind_param("si", $sessid, $userid);
$query->execute();

if ($link->errno) {
    http_response_code(500);
    echo $link->error;
    return;
}

setcookie("sessid", $sessid);
