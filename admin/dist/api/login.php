<?php
session_start();

require_once dirname(dirname(dirname(__FILE__))) . '/admin/config.php';

$_POST = json_decode(file_get_contents('php://input'), true);

$name = $_POST['user']['name'];
$password = $_POST['user']['key'];


if ($password) {
    if ($name === $GLOBALS['admin_name'] && $password === $GLOBALS['admin_password']) {
        $_SESSION['auth'] = true;

        echo json_encode(['auth' => true]);
    } else {
        echo json_encode(['auth' => false]);
    }
} else {
    header('HTTP/1.0 400 Bad Request');
}
