<?php
$servername = 'localhost';
$username = 'root';
$password = '';

try {
    $conn = new PDO('mysql:host=localhost;dbname=ecomm_entity', $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}


function json($data) {
    return json_encode($data);
}