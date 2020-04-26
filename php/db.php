<?php

$dsn = "mysql:host=localhost;dbname=BAZINGA;charset=utf8mb4";
$user = "root";
$pass =  "root" ;

try {
    $db = new PDO($dsn, $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (Exception $ex) {
    die("Connection Error.");
}
