<?php

session_start();

$_POST = json_decode(file_get_contents('php://input'), true);

$emailDefault = 'admin@pragma.by';
$passwordDefault = 'qwerty';

$password = $_POST['user']['password'];
$email = $_POST['user']['email'];

if ($password) {
    if ($password == $passwordDefault && $email == $emailDefault) {
        $_SESSION['auth'] = true;

        echo json_encode(['auth' => true]);
    } else {
        echo json_encode(['auth' => false]);
    }
} else {
    header('HTTP/1.0 400 Bad Request');
}
