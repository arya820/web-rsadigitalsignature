<?php

// Koneksi
$host = "localhost";
$db_username = "root";
$db_password = "";
$database = "skripsi171401117";

try {
    $connect = new PDO("mysql:host=$host;dbname=$database", $db_username, $db_password);
} catch (\Throwable $th) {
    die("Terjadi masalah:" . $th->getMessage());
}
?>