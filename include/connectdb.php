<?php

$host = 'localhost';
$db = 'hotel';
$user = 'root';
$password = '';

try {
$dsn = "mysql:host=$host; dbname=$db;charset=UTF8";
$pdo = new PDO($dsn, $user, $password);

// if ($pdo){
//     echo "connected successfully";
//     }

} catch (PDOException $err) {
    echo $err->getMessage();
}


?>