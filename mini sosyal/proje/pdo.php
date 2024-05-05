<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "raquun";

try {
    // Bağlantı oluşturma
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
  
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
} catch(PDOException $e) {
    die("Bağlantı hatası: " . $e->getMessage());
}

?>