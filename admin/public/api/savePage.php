<?php

$_POST = json_decode(file_get_contents('php://input'), true);

$fileName = "database.json";
$newFile = $_POST['jsonResult'];

define('BACKUP_URL', '../backups/');
if (!is_dir(BACKUP_URL)) {
    mkdir(BACKUP_URL);
}
$jsonFile = BACKUP_URL.'backups.json';
$backups = json_decode(file_get_contents($jsonFile));

if (!is_array($backups)) {
    $backups = [];
}

if ($newFile && $fileName) {
    $backupFilename = uniqid().'.json';

    copy($fileName, BACKUP_URL.$backupFilename);

    if (!copy($fileName, BACKUP_URL.$backupFilename)) {
        echo "не удалось скопировать $fileName...\n";
        die;
    }

    array_push($backups, ['name' => $fileName, 'file' => $backupFilename, 'time' => date('H:i:s d.m.y')]);

    file_put_contents(BACKUP_URL.'backups.json', json_encode($backups));

    file_put_contents($fileName, json_encode($newFile));
    echo basename($fileName).' обновлён! Создан бекап '."$fileName - $backupFilename";
} else {
    header('HTTP/1.0 400 Bad Request');
}