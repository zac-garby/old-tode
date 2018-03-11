<?php

require "db.php";

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// Check if a user already exists with the same email or username
$query = $link->prepare("SELECT admin FROM users
WHERE username = ?");
$query->bind_param("s", $username);
$query->execute();
$result = $query->get_result();

if ($row = $result->fetch_assoc()) {
    echo '{"error": "username"}';
    sleep(0.1);
    return;
}

$query = $link->prepare("SELECT admin FROM users
WHERE email = ?");
$query->bind_param("s", $email);
$query->execute();
$result = $query->get_result();

if ($row = $result->fetch_assoc()) {
    echo '{"error": "email"}';
    sleep(0.1);
    return;
}

// Generate salt
$characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
$charlength = strlen($characters);
$salt = "";

for ($i = 0; $i < 8; $i++) {
    $salt .= $characters[rand(0, $charlength - 1)];
}

// Create user in the database
$hash = hash("sha256", $password . $salt);

$query = $link->prepare("INSERT INTO users (
    username,
    password_hash,
    salt,
    email,
    admin
) VALUES (
    ?, ?, ?, ?, ?
)");

$is_admin = false;

$query->bind_param("ssssi", $username, $hash, $salt, $email, $is_admin);
$query->execute();

if ($link->errno) {
    echo '{"error": "database"}';
    sleep(0.1);
    return;
}

echo '{"error": null}';
