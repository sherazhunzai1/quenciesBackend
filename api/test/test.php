<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$json = file_get_contents('php://input');

// Converts it into a PHP object
$data = json_decode($json);


echo json_encode($data->username);
?>