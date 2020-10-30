<?php

if (file_exists($_FILES['image']['tmp_name'])) {
    $fileExt = explode('/', $_FILES['image']['type'])[1];
    $fileName = uniqid().'.'.$fileExt;
    define('IMG_URL', '/');

    if (!is_dir(IMG_URL)) {
        mkdir(IMG_URL);
    }

    $isLoad = move_uploaded_file($_FILES['image']['tmp_name'], 'favicon-192.png');

    if ($isLoad) {
        echo json_encode(['status' => 'ok', 'src' => $fileName]);
    } else {
        header('HTTP/1.0 400 Bad Request');
    }
}
