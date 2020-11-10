<?php

$_POST = json_decode(file_get_contents('php://input'), true);

$file = $_POST['file'];
$name = $_POST['name'];
$time = $_POST['time'];
define('BACKUP_URL', '../backups/');

if ($file && $name && $time) {
    if (file_exists(BACKUP_URL.$file)) {
        copy(BACKUP_URL.$file, $name);
        echo json_encode(['status' => 'ok', 'msg' => "Файл $name восстановлен от $time"]);
    } else {
        echo json_encode(['status' => 'error', 'msg' => 'Нет такого файла']);
    }
} else {
    header('HTTP/1.0 400 Bad Request');
}
