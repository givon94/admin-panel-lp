<?php

session_start();

$_POST = json_decode(file_get_contents('php://input'), true);

$password = $_POST['password'];
$passwordDefault = 'qwerty';

if ($password) {
    if ($password == $passwordDefault) {
        $_SESSION['auth'] = true;

        echo json_encode(['auth' => true]);
    } else {
        echo json_encode(['auth' => false]);
    }
} else {
    header('HTTP/1.0 400 Bad Request');
}
