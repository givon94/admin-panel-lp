<?php

$_POST = json_decode(file_get_contents('php://input'), true);

$jsonResult = $_POST['jsonResult'];

$file_result = "database.json";

file_put_contents($file_result, json_encode($jsonResult));

?>
